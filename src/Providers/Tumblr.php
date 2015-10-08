<?php

namespace SocialLinks\Providers;

class Tumblr extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.tumblr.com/share',
            array(
                'url' => 'u',
                'title' => 't',
            ),
            array(
                'v' => 3,
            )
        );
    }
}
