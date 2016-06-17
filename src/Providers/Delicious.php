<?php

namespace SocialLinks\Providers;

class Delicious extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://delicious.com/save',
            array('url', 'title')
        );
    }
}
