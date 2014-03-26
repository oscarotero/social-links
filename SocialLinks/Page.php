<?php
namespace SocialLinks;

class Page {
    protected $providers = [];
    protected $info = [
        'url' => null,
        'title' => null
    ];

    public function __construct($url)
    {
        $this->setUrl($url);
    }

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
    }

    public function setUrl($url)
    {
        $this->info['url'] = $url;
    }

    public function getUrl()
    {
        return $this->info['url'];
    }

    public function set(array $info)
    {
        if (isset($info['url'])) {
            $this->setUrl($info['url']);
            unset($info['url']);
        }

        $this->info = array_replace($this->info, $info);
    }

    public function get(array $info = null)
    {
        if ($info === null) {
            return $this->info;
        }

        $data = [];

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

    public function count(array $providers)
    {
        $total = 0;

        foreach ($providers as $provider) {
            $total = $this->__get($provider)->countShares();
        }

        return $total;
    }
}
