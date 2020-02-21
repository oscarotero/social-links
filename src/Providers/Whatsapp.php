<?php

namespace SocialLinks\Providers;

class Whatsapp extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        $info = $this->page->get();

        return $this->buildUrl(
            'https://wa.me/',
            null,
            array(
                'text' => $info['title'].' '.$info['url'],
            )
        );
    }
}
