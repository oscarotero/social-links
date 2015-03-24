<?php

namespace SocialLinks\Providers;

class Blogger extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.blogger.com/blog-this.g',
            array(
                'url' => 'u',
                'title' => 'n',
            )
        );
    }
}
