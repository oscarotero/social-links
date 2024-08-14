<?php

namespace SocialLinks\Providers;

class Threads extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        $data = $this->page->get(array('title'));
        $text = isset($data['title']) ? trim($data['title']) : '';

        return $this->buildUrl(
            'https://threads.net/intent/post',
            array('url'),
            array('text' => $text)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCountRequest()
    {
        return static::request(
            $this->buildUrl(
                'https://graph.threads.net/v1.0/insights',
                array(),
                array(
                    'metric' => 'likes',
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

        return isset($count['share']['like_count']) ? intval($count['share']['like_count']) : 0;
    }
}
