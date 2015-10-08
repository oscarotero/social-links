<?php

namespace SocialLinks\Providers;

class Plus extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'https://plus.google.com/share',
            array('url')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCountRequest()
    {
        $url = $this->page->getUrl();

        return static::request(
            'https://clients6.google.com/rpc',
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
    }

    /**
     * {@inheritdoc}
     */
    public function shareCount($response)
    {
        $count = static::jsonResponse($response);

        return isset($count[0]['result']['metadata']['globalCounts']['count']) ? intval($count[0]['result']['metadata']['globalCounts']['count']) : 0;
    }
}
