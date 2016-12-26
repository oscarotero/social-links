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
            'https://partners.viadeo.com/share',
            array(
                'url',
                'title' => 'comment',
            )
        );
    }
}
