<?php

namespace SocialLinks\Providers;

class Classroom extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://classroom.google.com/share',
            array('url', 'title')
        );
    }
}
