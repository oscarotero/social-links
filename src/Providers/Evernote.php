<?php

namespace SocialLinks\Providers;

/**
 * Create an Evernote Clip of a page.
 */
class Evernote extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.evernote.com/clip.action',
            array(
                'url',
                'title',
                'text' => 'body',
            )
        );
    }

    /**
     * Not supported.
     *
     * {@inheritDoc}
     */
    public function shareCount()
    {
        return 0;
    }
}
