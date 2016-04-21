<?php

namespace SocialLinks\Metas;

class Opengraph extends MetaBase implements MetaInterface
{
    protected $prefix = 'og:';

    protected $characterLimits = [
        'title' => 65,
        'description' => 156,
    ];

    /**
     * {@inheritdoc}
     */
    protected function generateTags()
    {
        $this->addMeta('type', 'website');

        $data = $this->page->get(array(
            'title',
            'image',
            'url',
            'text' => 'description',
        ));

        foreach ($data as $property => $content) {
            if (!empty($content)) {
                $this->addMeta($property, $content);
            }
        }
    }

    /**
     * OpenGraph uses the attribute "property" instead the standard "name".
     *
     * {@inheritdoc}
     */
    public function addMeta($property, $content)
    {
        $content = $this->filterAttribute($property, $content);

        $this[$property] = '<meta property="'.$this->prefix.static::escape($property).'" content="'.static::escape($content).'">';
    }
}
