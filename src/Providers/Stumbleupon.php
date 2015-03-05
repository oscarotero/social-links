<?php
namespace SocialLinks\Providers;

class Stumbleupon extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.stumbleupon.com/submit',
            array(
                'url',
                'title'
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function shareCount()
    {
        $count = $this->getJson(
            'http://www.stumbleupon.com/services/1.01/badge.getinfo',
            array('url')
        );

        return isset($count['result']['views']) ? intval($count['result']['views']) : 0;
    }
}
