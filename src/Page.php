<?php
namespace SocialLinks;

class Page
{
    protected $providers = array();
    protected $info = array(
        'url' => null,
        'title' => null,
        'text' => null,
        'image' => null,
        'twitterUser' => null,
    );

    /**
     * Constructor.
     *
     * @param array $info The page info. Only url, title, text, image and twitterUser fields are available
     */
    public function __construct(array $info)
    {
        if (array_diff_key($info, $this->info)) {
            throw new \Exception("Only the following fields are available:".implode(',', array_keys($this->info)));
        }

        $this->info = $info + $this->info;
    }

    /**
     * Magic method to instantiate and return providers in lazy mode.
     *
     * @param string $key The provider name
     *
     * @throws Exception if the provider does not exists
     *
     * @return Providers\ProviderInterface
     */
    public function __get($key)
    {
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
     * Gets the page url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->info['url'];
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
}
