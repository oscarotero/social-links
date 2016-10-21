<?php

namespace SocialLinks\Providers;

class Facebook extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.facebook.com/sharer/sharer.php',
            array(
                'url' => 'u',
                'title' => 't',
            ),
            array(
                'display' => 'popup',
                'redirect_uri' => 'http://www.facebook.com',
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
                'https://graph.facebook.com/',
                array(),
                array(
                    'id' => $this->page->getUrl(),
                )
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCount($response)
    {
        $count = self::jsonResponse($response);

        return isset($count['share']['share_count']) ? intval($count['share']['share_count']) : 0;
    }
}
