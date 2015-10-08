<?php
namespace SocialLinks\Providers;

class Facebook extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
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
                'redirect_uri' => 'http://www.facebook.com'
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function shareCountRequest()
    {
        return static::request(
            $this->buildUrl(
                'https://api.facebook.com/restserver.php',
                array(
                    'url' => 'urls[0]',
                ),
                array(
                    'method' => 'links.getStats',
                    'format' => 'json',
                )
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function shareCount($response)
    {
        $count = self::jsonResponse($response);

        return isset($count[0]['share_count']) ? intval($count[0]['share_count']) : 0;
    }
}
