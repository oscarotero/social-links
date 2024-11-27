<?php

namespace SocialLinks\Providers;

class Bluesky extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        $data = $this->page->get(array('title', 'url'));
        $text = isset($data['url']) ? trim($data['url']) : (isset($data['title']) ? trim($data['title']) : '');

        return $this->buildUrl(
            'https://bsky.app/intent/compose',
            null,
            array('text' => $text)
        );
    }
}
