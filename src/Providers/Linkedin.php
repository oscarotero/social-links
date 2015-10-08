<?php

namespace SocialLinks\Providers;

class Linkedin extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.linkedin.com/shareArticle',
            array(
                'url',
                'title',
                'text' => 'summary',
            ),
            array('mini' => true)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCountRequest()
    {
        return static::request(
            $this->buildUrl(
                'https://www.linkedin.com/countserv/count/share',
                array('url'),
                array('format' => 'json')
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCount($response)
    {
        $count = self::jsonResponse($response);

        return isset($count['count']) ? intval($count['count']) : 0;
    }
}
