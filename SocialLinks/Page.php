<?php
namespace SocialLinks;

class Page {
    protected $providers = [];
    protected $info = [
        'url' => null,
        'title' => null
    ];

    public function __construct(array $info)
    {
        $this->info = $info;
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

    public function getUrl()
    {
        return $this->info['url'];
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
}
