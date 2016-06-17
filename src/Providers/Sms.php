<?php

namespace SocialLinks\Providers;

class Sms extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        $info = $this->page->get();

        return 'sms:?&amp;body='.rawurlencode($info['title'].' '.$info['url']);
    }
}
