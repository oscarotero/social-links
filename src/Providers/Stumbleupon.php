<?php

namespace SocialLinks\Providers;

class Stumbleupon extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.stumbleupon.com/submit',
            array(
                'url',
                'title',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCountRequest()
    {
        return static::request(
            $this->buildUrl(
                'http://www.stumbleupon.com/services/1.01/badge.getinfo',
                array('url')
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCount($response)
    {
        $count = static::jsonResponse($response);

        return isset($count['result']['views']) ? intval($count['result']['views']) : 0;
    }
}
