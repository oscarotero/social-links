<?php

namespace SocialLinks\Metas;

use SocialLinks\Page;
use ArrayObject;

/**
 * Base class extended by all metas.
 */
abstract class MetaBase extends ArrayObject
{
    const META_ATTRIBUTE_NAME = 'name';
    const META_NAME_PREFIX = '';

    protected $page;
    protected static $characterLimits = array();

    /**
     * Constructor.
     *
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
        $this->generateTags();
    }

    /**
     * Generate all tags.
     *
     * @return array
     */
    abstract protected function generateTags();

    /**
     * {@inheritdoc}
     */
    public function addMeta($name, $content)
    {
        $content = $this->trim($name, $content);

        $this[$name] = '<meta '.static::META_ATTRIBUTE_NAME.'="'.static::META_NAME_PREFIX.static::escape($name).'" content="'.static::escape($content).'">';
    }

    /**
     * {@inheritdoc}
     */
    public function addLink($rel, $href)
    {
        $this[$rel] = '<link rel="'.static::escape($rel).'" href="'.static::escape($href).'">';
    }

    /**
     * Adds an array of metas.
     * 
     * @param array $metas
     */
    protected function addMetas(array $metas)
    {
        foreach ($metas as $name => $content) {
            if (!empty($content)) {
                $this->addMeta($name, $content);
            }
        }
    }

    /**
     * Adds an array of links.
     * 
     * @param array $links
     */
    protected function addLinks(array $links)
    {
        foreach ($links as $rel => $href) {
            if (!empty($href)) {
                $this->addLink($rel, $href);
            }
        }
    }

    /**
     * Escapes the value of an attribute.
     *
     * @param string $value
     *
     * @return string
     */
    protected static function escape($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Filters attribute values to trim by length.
     *
     * @param string $name
     * @param string $content
     *
     * @return string
     */
    protected static function trim($name, $content)
    {
        $limit = isset(static::$characterLimits[$name]) ? static::$characterLimits[$name] : null;

        if ($limit && strlen($content) > $limit) {
            $content = substr($content, 0, $limit - 3).'...';
        }

        return $content;
    }
}
