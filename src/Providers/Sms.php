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

        return 'sms:?&body='.rawurlencode(trim($info['title'].' '.$info['url']));
    }
}
