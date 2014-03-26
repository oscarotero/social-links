<?php
namespace SocialLinks\Providers;

class Twitter extends ProviderBase implements ProviderInterface {
    public function shareUrl()
    {
        return $this->buildUrl('https://twitter.com/intent/tweet', ['url', 'title' => 'text']);
    }

    public function countShares()
    {
    	$count = $this->getJson('https://cdn.api.twitter.com/1/urls/count.json', ['url']);

        return isset($count['count']) ? intval($count['count']) : 0;
    }
}
