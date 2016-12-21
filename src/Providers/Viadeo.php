<?php

namespace SocialLinks\Providers;

class Viadeo extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'http://www.viadeo.com/shareit/share/',
            array(
                'url',
                'title',
            )
        );
    }
}
