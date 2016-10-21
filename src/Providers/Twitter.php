<?php

namespace SocialLinks\Providers;

class Twitter extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        $data = $this->page->get(array('title', 'twitterUser'));
        $text = isset($data['title']) ? trim($data['title']) : '';

        if (!empty($data['twitterUser']) && (strpos($text, $data['twitterUser']) === false)) {
            if (strrpos($text, '.', -1)) {
                $text = substr($text, 0, -1);
            }

            $text .= ' via '.$data['twitterUser'];
        }

        return $this->buildUrl(
            'https://twitter.com/intent/tweet',
            array('url'),
            array('text' => $text)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function _shareCountRequest()
    {
        return static::request(
            $this->buildUrl(
                'https://cdn.api.twitter.com/1/urls/count.json',
                array('url')
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function _shareCount($response)
    {
        $count = static::jsonResponse($response);

        return isset($count['count']) ? intval($count['count']) : 0;
    }
}
