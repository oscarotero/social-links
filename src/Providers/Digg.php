<?php

namespace SocialLinks\Providers;

class Digg extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://digg.com/submit',
            array('url')
        );
    }
}
