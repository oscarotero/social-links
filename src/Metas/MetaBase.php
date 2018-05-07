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
     * Convert all tags to html
     *
     * @return string
     */
    public function __toString()
    {
        $html = [];

        foreach ($this as $tag) {
            if (is_array($tag)) {
                $html = array_merge($html, $tag);
            } else {
                $html[] = $tag;
            }
        }

        return implode("\n", $html);
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
        if (is_array($content)) {
            $content = array_map(function ($content) use ($name) {
                return static::getHtmlMeta($name, $content);
            }, array_filter($content));

            if (empty($content)) {
                return;
            }
        } elseif (!empty($content)) {
            $content = static::getHtmlMeta($name, $content);
        } else {
            return;
        }

        $this[$name] = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function addLink($rel, $href)
    {
        if (is_array($href)) {
            $href = array_map(function ($href) use ($rel) {
                return static::getHtmlLink($rel, $href);
            }, array_filter($href));

            if (empty($href)) {
                return;
            }
        } elseif (!empty($href)) {
            $href = static::getHtmlLink($rel, $href);
        } else {
            return;
        }

        $this[$rel] = $href;
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
     * Generates the html code of a link
     *
     * @param string $rel
     * @param string $href
     */
    protected static function getHtmlLink($rel, $href)
    {
        return '<link rel="'.static::escape($rel).'" href="'.static::escape($href).'">';
    }

    /**
     * Generates the html code of a meta
     *
     * @param string $name
     * @param string $content
     */
    protected static function getHtmlMeta($name, $content)
    {
        $content = static::trim($name, $content);

        return '<meta '.static::META_ATTRIBUTE_NAME.'="'.static::META_NAME_PREFIX.static::escape($name).'" content="'.static::escape($content).'">';
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

        if ($limit && mb_strlen($content) > $limit) {
            $content = mb_substr($content, 0, $limit - 3).'...';
        }

        return $content;
    }
}
