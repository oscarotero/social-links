<?php
namespace SocialLinks\Providers;

class Plus extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://plus.google.com/share',
            array('url')
        );
    }

    /**
     * {@inheritDoc}
     */
    public function shareCount()
    {
        $url = $this->page->getUrl();

        $count = $this->getJson(
            'https://clients6.google.com/rpc',
            array(),
            array(),
            json_encode(
                array(
                    array(
                        'method' => 'pos.plusones.get',
                        'id' => 'p',
                        'params' => array(
                            'nolog' => true,
                            'id' => $url,
                            'source' => 'widget',
                            'userId' => '@viewer',
                            'groupId' => '@self',
                        ),
                        'jsonrpc' => '2.0',
                        'key' => 'p',
                        'apiVersion' => 'v1',
                    ),
                )
            ),
            array('Content-type: application/json')
        );

        return isset($count[0]['result']['metadata']['globalCounts']['count']) ? intval($count[0]['result']['metadata']['globalCounts']['count']) : 0;
    }
}
