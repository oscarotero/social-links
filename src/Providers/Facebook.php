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

    /**
     * {@inheritdoc}
     */
    public function shareCountRequestMultiple()
    {
        return static::request(
            $this->buildUrl(
                'https://graph.facebook.com/',
                array(),
                array(
                    'ids' => implode(',', $this->page->getUrls())
                )
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCountMultiple($response)
    {
        $count_array = self::jsonResponse($response);

        return array_map(function ($count) {
            return isset($count['share']['share_count']) ? intval($count['share']['share_count']) : 0;
        }, $count_array);
    }
}
