<?php

namespace SocialLinks\Providers;

use SocialLinks\Page;
use DOMDocument;

/**
 * Base class extended by all providers.
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
                return $this->shareUrl = $this->shareUrl();

            case 'shareCount':
                $request = $this->shareCountRequest();

                if ($request !== null) {
                    $response = curl_exec($request) ?: '';
                    curl_close($request);

                    return $this->shareCount = $this->shareCount($response);
                }

                return $this->shareCount = null;
        }
    }

    /**
     * Default shareCount function for providers without count api.
     *
     * {@inheritdoc}
     */
    public function shareCount($response)
    {
        return;
    }

    /**
     * Default shareCountRequest function for providers without count api.
     *
     * {@inheritdoc}
     */
    public function shareCountRequest()
    {
        return;
    }

    /**
     * Generates a valid url.
     *
     * @param string $url
     * @param array  $pageParams parameters to be taken from page fields as $paramName  => $paramNameInTheURL
     * @param array  $getParams  extra parameters as $key => $value
     * @param int    $encoding   Type of encoding used. It can be static::RFC3986 or static::RFC1738
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

    /**
     * Build a curl request.
     *
     * @param string      $url
     * @param bool|string $post
     * @param array       $headers
     *
     * @return resource
     */
    protected static function request($url, $post = false, array $headers = null)
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

        return $connection;
    }

    /**
     * Handle JSON responses.
     *
     * @param string $content
     *
     * @return array|false
     */
    protected static function jsonResponse($content)
    {
        return json_decode($content, true);
    }

    /**
     * Handle JSONP responses.
     *
     * @param string $content
     *
     * @return array|false
     */
    protected static function jsonpResponse($content)
    {
        preg_match("/^\w+\((.*)\)$/", $content, $matches);

        return json_decode($matches[1], true);
    }

    /**
     * Handle HTML responses.
     *
     * @param string $content
     *
     * @return DOMDocument
     */
    protected static function htmlResponse($content)
    {
        $errors = libxml_use_internal_errors(true);
        $document = new DOMDocument();
        $document->loadHTML($content);
        libxml_use_internal_errors($errors);

        return $document;
    }
}
