<?php
namespace SocialLinks\Providers;

class Pinterest extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.pinterest.com/pin/create/button/',
            array(
                'url',
                'title' => 'description',
                'image' => 'media',
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function shareCount()
    {
        $count = $this->getJsonp(
            'https://api.pinterest.com/v1/urls/count.json',
            array('url')
        );

        return isset($count['count']) ? intval($count['count']) : 0;
    }
}
