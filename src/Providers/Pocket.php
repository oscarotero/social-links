<?php

namespace SocialLinks\Providers;

class Pocket extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://getpocket.com/edit',
            array('url')
        );
    }
}
