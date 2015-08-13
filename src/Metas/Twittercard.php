<?php
namespace SocialLinks\Metas;

class Twittercard extends MetaBase implements MetaInterface
{
    protected $prefix = 'twitter:';

    /**
     * {@inheritDoc}
     */
    protected function generateTags()
    {
        $this->addMeta('card', 'summary');

        $data = $this->page->get(array(
            'title',
            'image',
            'text' => 'description',
            'twitterUser' => 'site',
        ));

        foreach ($data as $property => $content) {
            if (!empty($content)) {
                $this->addMeta($property, $content);
            }
        }
    }
}
