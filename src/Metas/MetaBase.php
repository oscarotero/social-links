<?php
namespace SocialLinks\Metas;

use SocialLinks\Page;
use ArrayObject;

/**
 * Base class extended by all metas
 */
abstract class MetaBase extends ArrayObject
{
    protected $page;
    protected $prefix;

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
     * Generate all tags
     *
     * @return array
     */
    abstract protected function generateTags();

    /**
     * {@inheritdoc}
     */
    public function addMeta($property, $content)
    {
        $this[$property] = '<meta property="'.$this->prefix.static::escape($property).'" content="'.static::escape($content).'">';
    }

    /**
     * {@inheritdoc}
     */
    public function addLink($rel, $href)
    {
        $this[$rel] = '<link rel="'.$this->prefix.static::escape($rel).'" href="'.static::escape($href).'">';
    }

    /**
     * Escapes the value of an attribute
     *
     * @param string $value
     *
     * @return string
     */
    protected static function escape($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
