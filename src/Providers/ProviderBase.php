<?php
namespace SocialLinks\Providers;

use SocialLinks\Page;

/**
 * Base class extended by all providers
 * 
 * @property string   $shareUrl
 * @property null|int $shareCount
 */
abstract class ProviderBase
{
    protected $page;

    const RFC1738 = 1;
    const RFC3986 = 2;

    /**
     * Constructor.
     *
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Magic method to calculate and store the properties.
     */
    public function __get($key)
    {
        switch ($key) {
            case 'shareUrl':
            case 'shareCount':
                return $this->$key = $this->$key();
        }
    }

    /**
     * Default shareCount function for providers without count api
     * 
     * {@inheritdoc}
     */
    public function shareCount()
    {
        return;
    }

    /**
     * Executes a request and return the response.
     *
     * @param string         $url
     * @param boolean|string $post
     * @param array          $headers
     *
     * @return string
     */
    protected static function executeRequest($url, $post = false, array $headers = null)
    {
        $connection = curl_init();

        curl_setopt_array($connection, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 20,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_AUTOREFERER => true,
            CURLOPT_USERAGENT => 'SocialLinks PHP Library',
        ));

        if (!empty($post)) {
            curl_setopt($connection, CURLOPT_POST, true);

            if (is_string($post)) {
                curl_setopt($connection, CURLOPT_POSTFIELDS, $post);
            }
        }

        if (!empty($headers)) {
            curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        }

        $content = curl_exec($connection) ?: '';

        curl_close($connection);

        return $content;
    }

    /**
     * Execute and returns a request.
     *
     * @param string         $url
     * @param array          $pageParams
     * @param array          $getParams
     * @param boolean|string $post
     * @param array          $headers
     *
     * @return string|false
     */
    protected function getText($url, array $pageParams = null, array $getParams = array(), $post = false, array $headers = null)
    {
        return self::executeRequest($this->buildUrl($url, $pageParams, $getParams), $post, $headers);
    }

    /**
     * Execute and returns a json request.
     *
     * @param string         $url
     * @param array          $pageParams
     * @param array          $getParams
     * @param boolean|string $post
     * @param array          $headers
     *
     * @return array|false
     */
    protected function getJson($url, array $pageParams = null, array $getParams = array(), $post = false, array $headers = null)
    {
        return json_decode(self::executeRequest($this->buildUrl($url, $pageParams, $getParams), $post, $headers), true);
    }

    /**
     * Execute and returns a jsonp request.
     *
     * @param string         $url
     * @param array          $pageParams
     * @param array          $getParams
     * @param boolean|string $post
     * @param array          $headers
     *
     * @return array|false
     */
    protected function getJsonp($url, array $pageParams = null, array $getParams = array(), $post = false, array $headers = null)
    {
        preg_match("/^\w+\((.*)\)$/", static::executeRequest($this->buildUrl($url, $pageParams, $getParams), $post, $headers), $matches);

        return json_decode($matches[1], true);
    }

    /**
     * Generates a valid url.
     *
     * @param string  $url
     * @param array   $pageParams parameters to be taken from page fields as $paramName  => $paramNameInTheURL
     * @param array   $getParams  extra parameters as $key => $value
     * @param integer $encoding   Type of encoding used. It can be static::RFC3986 or static::RFC1738
     */
    protected function buildUrl($url, array $pageParams = null, array $getParams = array(), $encoding = self::RFC1738)
    {
        if ($pageParams) {
            $getParams += $this->page->get($pageParams);
        }

        if (empty($getParams)) {
            return $url;
        }

        if ($encoding === static::RFC1738) {
            return $url.'?'.http_build_query($getParams);
        }

        $get = array();

        foreach ($getParams as $name => $value) {
            $get[] = $name.'='.rawurlencode($value);
        }

        return $url.'?'.implode(ini_get('arg_separator.output'), $get);
    }
}
