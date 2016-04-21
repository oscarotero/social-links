<?php

namespace SocialLinks\Metas;

class Opengraph extends MetaBase implements MetaInterface
{
    const META_ATTRIBUTE_NAME = 'property';
    const META_NAME_PREFIX = 'og:';

    protected static $characterLimits = array(
        'title' => 65,
        'description' => 156,
    );

    /**
     * {@inheritdoc}
     */
    protected function generateTags()
    {
        $this->addMeta('type', 'website');

        $this->addMetas($this->page->get(array(
            'title',
            'image',
            'url',
            'text' => 'description',
        )));
    }
}
