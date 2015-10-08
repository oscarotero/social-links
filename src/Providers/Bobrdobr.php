<?php

namespace SocialLinks\Providers;

/**
 * BobrDobr is a Russian clone of delicio.us.
 */
class Bobrdobr extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'http://bobrdobr.ru/addext.html',
            array(
                'url',
                'title',
                'text' => 'desc',
            )
        );
    }
}
