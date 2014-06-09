<?php
namespace SocialLinks\Providers;

class Cabozo extends ProviderBase implements ProviderInterface {
    public function shareUrl()
    {
        return $this->buildUrl('http://www.cabozo.com/share.php', ['url']);
    }

    public function shareCount()
    {
    	return 0;
    }
}
