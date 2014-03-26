<?php
namespace SocialLinks\Providers;

class Stumbleupon extends ProviderBase implements ProviderInterface {
    public function shareUrl()
    {
        return $this->buildUrl('https://www.stumbleupon.com/submit', ['url', 'title']);
    }

    public function countShares()
    {
    	$count = $this->getJson('http://www.stumbleupon.com/services/1.01/badge.getinfo', ['url']);

        return isset($count['result']['views']) ? intval($count['result']['views']) : 0;
    }
}
