<?php

namespace SocialLinks\Metas;

class Html extends MetaBase implements MetaInterface
{
    protected static $characterLimits = array(
        'title' => 55,
        'description' => 155,
    );

    /**
     * {@inheritdoc}
     */
    protected function generateTags()
    {
        $this->addMetas($this->page->get(array(
            'title',
            'text' => 'description',
        )));

        $this->addLinks($this->page->get(array(
            'image' => 'image_src',
            'url' => 'canonical',
        )));
    }
}
