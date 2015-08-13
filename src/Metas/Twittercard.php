<?php
namespace SocialLinks\Metas;

class Twittercard extends MetaBase implements MetaInterface
{
    /**
     * {@inheritDoc}
     */
    protected function generateTags()
    {
        $this->addMeta('twitter:card', 'summary');

        $data = $this->page->get(array(
            'title',
            'image',
            'text' => 'description',
            'twitterUser' => 'site',
        ));

        foreach ($data as $property => $content) {
            if (!empty($content)) {
                $this->addMeta('twitter:'.$property, $content);
            }
        }
    }
}
