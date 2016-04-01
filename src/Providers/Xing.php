<?php

namespace SocialLinks\Providers;

class Xing extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {

        /*
         * alternate request url:
         * https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=YOUR-URL
         */

        return $this->buildUrl(
            'https://www.xing.com/spi/shares/new',
            array(
                'url',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCountRequest()
    {
        $url = $this->buildUrl(
            'https://www.xing-share.com/app/share',
            array('url'),
            array(
                'op' => 'get_share_button',
                'counter' => 'top',
            )
        );

        return static::request($url);
    }

    /**
     * {@inheritdoc}
     */
    public function shareCount($response)
    {
        preg_match('/xing-count(.+?)(\d+)(.*?)<\/span>/i', $response, $matches);

        return empty($matches[2]) ? 0 : (int) $matches[2];
    }
}
