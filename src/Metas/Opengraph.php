<?php
namespace SocialLinks\Metas;

class Opengraph extends MetaBase implements MetaInterface
{
    protected $prefix = 'og:';

    /**
     * {@inheritDoc}
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
}
