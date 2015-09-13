<?php
namespace SocialLinks\Providers;

class Scoopit extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.scoop.it/bookmarklet',
            array('url')
        );
    }

    /**
     * {@inheritDoc}
     */
    public function shareCountRequest()
    {
        $url = $this->page->getUrl();

        return static::request(
            $this->buildUrl(
                'http://www.scoop.it/button',
                array('url'),
                array('position' => 'horizontal')
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function shareCount($response)
    {
        $document = static::htmlResponse($response);

        $count = $document->getElementById('scoopit_count');

        return (int) $count->nodeValue;
    }
}
