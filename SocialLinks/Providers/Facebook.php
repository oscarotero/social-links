<?php
namespace SocialLinks\Providers;

class Facebook extends ProviderBase implements ProviderInterface {
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://www.facebook.com/sharer.php', [
                'url' => 'p[url]',
                'title' => 'p[title]',
                'text' => 'p[summary]',
                'image' => 'p[images][0]'
            ], ['s' => 100]);
    }

    public function countShares()
    {
    	$count = $this->getJson('https://api.facebook.com/restserver.php', [
            'url' => 'urls[0]'
        ], ['method' => 'links.getStats', 'format' => 'json']);

        return isset($count[0]['share_count']) ? intval($count[0]['share_count']) : 0;
    }
}
