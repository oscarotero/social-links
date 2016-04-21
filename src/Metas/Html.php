<?php

namespace SocialLinks\Metas;

class Html extends MetaBase implements MetaInterface
{
    protected static $characterLimits = [
        'title' => 55,
        'description' => 155,
    ];

    /**
     * {@inheritdoc}
     */
    protected function generateTags()
    {
        $data = $this->page->get();

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
