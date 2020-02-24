<?php

namespace SocialLinks\Providers;

class Line extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://social-plugins.line.me/lineit/share',
            array('url')
        );
    }
}
