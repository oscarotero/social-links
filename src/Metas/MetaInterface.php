<?php

namespace SocialLinks\Metas;

use IteratorAggregate;
use ArrayAccess;
use Serializable;
use Countable;

interface MetaInterface extends IteratorAggregate, ArrayAccess, Serializable, Countable
{
    /**
     * Add a meta tag.
     *
     * @param string       $property
     * @param string|array $content
     *
     * @return self
     */
    public function addMeta($property, $content);

    /**
     * Generate a link tag.
     *
     * @param string       $rel
     * @param string|array $href
     *
     * @return string
     */
    public function addLink($rel, $href);
}
