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
            'https://www.facebook.com/sharer.php',
            array(
                'url' => 'p[url]',
                'title' => 'p[title]',
                'text' => 'p[summary]',
                'image' => 'p[images][0]'
            ),
            array(
                's' => 100
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function shareCount()
    {
        $count = $this->getJson(
            'https://api.facebook.com/restserver.php',
            array(
                'url' => 'urls[0]'
            ),
            array(
                'method' => 'links.getStats',
                'format' => 'json'
            )
        );

        return isset($count[0]['share_count']) ? intval($count[0]['share_count']) : 0;
    }
}
