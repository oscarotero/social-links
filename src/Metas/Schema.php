<?php

namespace SocialLinks\Metas;

class Schema extends MetaBase implements MetaInterface
{
    const META_ATTRIBUTE_NAME = 'itemprop';

    protected static $characterLimits = array(
        'description' => 155,
    );

    /**
     * {@inheritdoc}
     */
    protected function generateTags()
    {
        $this->addMetas($this->page->get(array(
            'title' => 'name',
            'text' => 'description',
            'image',
        )));
    }
}
