<?php

namespace SocialLinks\Providers;

/**
 * BobrDobr is a Russian clone of delicio.us
 */
class Bobrdobr extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'http://bobrdobr.ru/addext.html',
            [
                'url',
                'title',
                'text' => 'desc',
            ]
        );
    }

    /**
     * Not supported
     *
     * {@inheritDoc}
     */
    public function shareCount()
    {
        return 0;
    }
}
