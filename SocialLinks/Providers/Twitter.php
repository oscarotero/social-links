<?php
namespace SocialLinks\Providers;

class Twitter extends ProviderBase implements ProviderInterface {
    public function shareUrl()
    {
        $data = $this->page->get(['title', 'twitterUser']);
        $text = $data['title'];

        if (!empty($data['twitterUser'])) {
            $text .= 'via '.$data['twitterUser'];
        }

        return $this->buildUrl('https://twitter.com/intent/tweet', ['url'], ['text' => $text]);
    }

    public function shareCount()
    {
    	$count = $this->getJson('https://cdn.api.twitter.com/1/urls/count.json', ['url']);

        return isset($count['count']) ? intval($count['count']) : 0;
    }
}
