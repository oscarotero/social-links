<?php
namespace SocialLinks\Providers;

class Email extends ProviderBase implements ProviderInterface {
    public function shareUrl()
    {
        $info = $this->page->get();
        $title = $info['title'];

        if (!$title) {
            $title = $info['url'];
        }

        return $this->buildUrl('mailto:', ['url' => 'body'], ['subject' => $title]);
    }

    public function shareCount()
    {
        return 0;
    }
}
