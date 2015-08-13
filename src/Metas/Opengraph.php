<?php
namespace SocialLinks\Metas;

class Opengraph extends MetaBase implements MetaInterface
{
    /**
     * {@inheritDoc}
     */
    protected function generateTags()
    {
        $this->addMeta('og:type', 'website');

        $data = $this->page->get(array(
            'title',
            'image',
            'url',
            'text' => 'description',
        ));

        foreach ($data as $property => $content) {
            if (!empty($content)) {
                $this->addMeta('og:'.$property, $content);
            }
        }
    }
}
