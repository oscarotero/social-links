<?php

namespace SocialLinks\Providers;

class Reddit extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.reddit.com/submit',
            array('url', 'title')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCountRequest()
    {
        return static::request(
            $this->buildUrl(
                'https://www.reddit.com/api/info.json',
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
        $score = 0;

        if (isset($count['data']['children'][0])) {
            foreach ($count['data']['children'] as $child) {
                $score += isset($child['data']['score']) ? intval($child['data']['score']) : 0;
            }
        }

        return $score;
    }
}
