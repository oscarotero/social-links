<?php
namespace SocialLinks\Providers;

class Linkedin extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function shareCount($response)
    {
        $count = self::jsonResponse($response);

        return isset($count['count']) ? intval($count['count']) : 0;
    }
}
