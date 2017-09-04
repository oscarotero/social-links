<?php

namespace SocialLinks\Metas;

class Twittercard extends MetaBase implements MetaInterface
{
    const META_NAME_PREFIX = 'twitter:';

    protected static $characterLimits = array(
        'title' => 65,
        'description' => 200,
    );

    /**
     * {@inheritdoc}
     */
    protected function generateTags()
    {
        $this->addMetas($this->page->get(array(
            'title',
            'text' => 'description',
            'twitterUser' => 'site',
        )));

        if ($this->page->getImage()) {
            $this->addMeta('card', 'summary_large_image');
            $this->addMeta('image', $this->page->getImage());
        } else {
            $this->addMeta('card', 'summary');
            $this->addMeta('image', $this->page->getIcon());
        }
    }
}
