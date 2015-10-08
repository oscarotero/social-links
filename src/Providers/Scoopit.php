<?php

namespace SocialLinks\Providers;

class Scoopit extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.scoop.it/bookmarklet',
            array('url')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCountRequest()
    {
        return static::request(
            $this->buildUrl(
                'http://www.scoop.it/button',
                array('url'),
                array('position' => 'horizontal')
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCount($response)
    {
        $document = static::htmlResponse($response);

        $count = $document->getElementById('scoopit_count');

        return (int) $count->nodeValue;
    }
}
