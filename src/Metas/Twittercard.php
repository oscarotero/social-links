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
        $this->addMeta('card', $this->page->getConfig('twitter_card_type', 'summary'));

        $this->addMetas($this->page->get(array(
            'title',
            'image',
            'text' => 'description',
            'twitterUser' => 'site',
        )));
    }
}
