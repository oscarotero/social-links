<?php
namespace SocialLinks\Providers;

class Plus extends ProviderBase implements ProviderInterface {
    public function shareUrl()
    {
        return $this->buildUrl('https://plus.google.com/share', ['url']);
    }

    public function shareCount()
    {
        $url = $this->page->getUrl();

    	$count = $this->getJson('https://clients6.google.com/rpc', [], [], json_encode([
            ['method' => 'pos.plusones.get',
            'id' => 'p',
            'params' => [
                'nolog' => true,
                'id' => $url,
                'source' => 'widget',
                'userId' => '@viewer',
                'groupId' => '@self'
            ],
            'jsonrpc' => '2.0',
            'key' => 'p',
            'apiVersion' => 'v1'
            ]
        ]), ['Content-type: application/json']);

        return isset($count[0]['result']['metadata']['globalCounts']['count']) ? intval($count[0]['result']['metadata']['globalCounts']['count']) : 0;
    }
}
