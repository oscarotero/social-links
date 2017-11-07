<?php

namespace SocialLinks;

use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\PhpFileCache;

/**
 * @method html()
 * @method openGraph()
 * @method schema()
 * @method twitterCard()
 */
class Page
{
    private $cache;
    protected $config = array(
        'useCache' => TRUE,
        'cacheDuration' => 3600,
    );
    protected $providers = array();
    protected $metas = array();
    protected $info = array(
        'url' => null,
        'urls' => array(),
        'title' => null,
        'text' => null,
        'image' => null,
        'icon' => null,
        'twitterUser' => null,
    );

    /**
     * Constructor.
     *
     * @param array $info   The page info. Only url, title, text, image, icon and twitterUser fields are available
     * @param array $config Configuration options
     * @param Cache $cache Doctrine Cache instance, defaults to a new PhpFileCache
     */
    public function __construct(array $info, array $config = array(), Cache $cache = NULL)
    {
        $cache = $cache ?: new PhpFileCache(sys_get_temp_dir());

        if (array_diff_key($info, $this->info)) {
            throw new \Exception('Only the following fields are available:'.implode(',', array_keys($this->info)));
        }

        $this->info = array_map('static::normalize', $info + $this->info);

        $this->config = array_map('static::normalize', $config + $this->config);
        $this->cache = $cache;
    }

    /**
     * Normalize value before save it:
     * - remove html tags
     * - remove line-ending and multiple spaces
     * - remove spaces around
     * - decode escaped html entities.
     *
     * @param string
     *
     * @return string
     */
    protected static function normalize($value)
    {
        if (is_array($value)) {
            return array_map(function ($v) {
                return trim(strip_tags(htmlspecialchars_decode(preg_replace('/\s+/', ' ', $v))));
            }, $value);
        }
        else {
            return trim(strip_tags(htmlspecialchars_decode(preg_replace('/\s+/', ' ', $value))));
        }
    }

    /**
     * Magic method to check if a provider exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        $key = strtolower($key);

        if (isset($this->providers[$key])) {
            return true;
        }

        $class = 'SocialLinks\\Providers\\'.ucfirst($key);

        return class_exists($class);
    }

    /**
     * Magic method to instantiate and return providers in lazy mode.
     *
     * @param string $key The provider name
     *
     * @throws \Exception if the provider does not exists
     *
     * @return Providers\ProviderInterface
     */
    public function __get($key)
    {
        if ($key == 'cache') {
            return $this->cache;
        }

        $key = strtolower($key);

        if (isset($this->providers[$key])) {
            return $this->providers[$key];
        }

        $class = 'SocialLinks\\Providers\\'.ucfirst($key);

        if (class_exists($class)) {
            return $this->providers[$key] = new $class($this);
        }

        throw new \Exception("The provider $key does not exists");
    }

    /**
     * Magic method to instantiate and return metas in lazy mode.
     *
     * @param string $key       The meta collection name
     * @param array  $arguments The arguments passed to the method
     *
     * @throws \Exception if the meta does not exists
     *
     * @return Metas\MetaInterface
     */
    public function __call($key, $arguments)
    {
        $key = strtolower($key);

        if (isset($this->metas[$key])) {
            return $this->metas[$key];
        }

        $class = 'SocialLinks\\Metas\\'.ucfirst($key);

        if (class_exists($class)) {
            return $this->metas[$key] = new $class($this);
        }

        throw new \Exception("The meta $key does not exists");
    }

    /**
     * Preload the counter.
     *
     * @param array $providers Array of providers - defaults to all.
     */
    public function shareCount(array $providers)
    {
        $providers = $providers ?: array_keys($this->providers);

        $connections = array();
        $curl = curl_multi_init();
        $now = time();

        foreach ($providers as $provider) {

            // Check cache, if option is set.
            if ($this->getConfig('useCache')) {
                $id = $this->getId($provider);
                if ($cachedData = $this->cache->fetch($id)) {
                    $expired = empty($cachedData[1]) || (
                        $cachedData[1] + $this->getConfig('cacheDuration') < $now
                    );

                    // If not expired, set shareCount and return.
                    if (!$expired) {
                        $this->$provider->shareCount = $cachedData[0];
                        continue;
                    }
                }
            }

            if ($this->isMultiple()) {
                $request = $this->$provider->shareCountRequestMultiple();
            }
            else {
                $request = $this->$provider->shareCountRequest();
            }

            if ($request !== null) {
                $connections[$provider] = $request;
                curl_multi_add_handle($curl, $request);
            } else {
                $this->$provider->shareCount = null;
            }
        }

        do {
            $return = curl_multi_exec($curl, $active);
        } while ($return === CURLM_CALL_MULTI_PERFORM);

        while ($active && $return === CURLM_OK) {
            if (curl_multi_select($curl) === -1) {
                usleep(100);
            }

            do {
                $return = curl_multi_exec($curl, $active);
            } while ($return === CURLM_CALL_MULTI_PERFORM);
        }

        foreach ($connections as $provider => $request) {
            if ($this->isMultiple()) {
                $this->$provider->shareCount = $this->$provider->shareCountMultiple(curl_multi_getcontent($request));
            }
            else {
                $this->$provider->shareCount = $this->$provider->shareCount(curl_multi_getcontent($request));
            }

            curl_multi_remove_handle($curl, $request);

            // Cache count.
            $id = $this->getId($provider);
            $this->cache->save($id, array($this->$provider->shareCount, $now));
        }

        curl_multi_close($curl);
    }

    /**
     * Gets the total number of shares for a given URL across given providers.
     *
     * @param array $providers
     *
     * @throws \RuntimeException
     *
     * @return int
     */
    public function getShareCountTotal(array $providers = array())
    {
        $providers = $providers ?: array_keys($this->providers);
        $this->shareCount($providers);

        $shareCountTotal = 0;
        foreach ($providers as $provider) {
            if ($this->isMultiple()) {
                $shareCountTotal += array_sum($this->$provider->shareCount);
            }
            else {
                $shareCountTotal += $this->$provider->shareCount;
            }
        }
        return $shareCountTotal;
    }

    /**
     * Gets the page url.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->info['url'];
    }

    /**
     * Gets the page url.
     *
     * @return array|null
     */
    public function getUrls()
    {
        return $this->info['urls'];
    }

    /**
     * Gets the page title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->info['title'];
    }

    /**
     * Gets the page text description.
     *
     * @return string|null
     */
    public function getText()
    {
        return $this->info['text'];
    }

    /**
     * Gets the page image.
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->info['image'];
    }

    /**
     * Gets the page icon.
     *
     * @return array|null
     */
    public function getIcon()
    {
        return $this->info['icon'];
    }

    /**
     * Gets the page twitterUser.
     *
     * @return string|null
     */
    public function getTwitterUser()
    {
        return $this->info['twitterUser'];
    }

    /**
     * Gets some page info.
     *
     * @param array|null Array with the page fields to return as $name => $rename. Set null to return all info
     *
     * @return array
     */
    public function get(array $info = null)
    {
        if ($info === null) {
            return $this->info;
        }

        $data = array();

        foreach ($info as $name => $rename) {
            if (is_int($name)) {
                $name = $rename;
            }

            if (!isset($this->info[$name])) {
                continue;
            }

            $data[$rename] = $this->info[$name];
        }

        return $data;
    }

    /**
     * Gets one or all configuration option.
     *
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function getConfig($name, $default = null)
    {
        return isset($this->config[$name]) ? $this->config[$name] : $default;
    }

    /**
     * Gets cache.
     *
     * @return object
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Gets the ID for this provider and URL.
     *
     * @param string $provider
     *
     * @return string
     */
    public function getId($provider)
    {
        return sprintf('%s_%s', $provider, $this->info['url']);
    }

    /**
     * Checks if there are multiple URLs.
     *
     * @return bool
     */
    public function isMultiple()
    {
        return !empty($this->getUrls());
    }
}
