<?php

namespace SocialLinks\Providers;

class Bluesky extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        $data = $this->page->get(array('title'));
        $text = isset($data['title']) ? trim($data['title']) : '';

        return $this->buildUrl(
            'https://bsky.app/intent/compose',
            array('text' => $data['url'])
        );
    }
}
