<?php

namespace SocialLinks\Providers;

/**
 * Odnoklassniki is the second most popular Russian social network
 */
class Odnoklassniki extends ProviderBase implements ProviderInterface
{
    protected $countField = 'share_ok';

    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl('http://www.odnoklassniki.ru/dk',
            array(
                'description' => 'st.comments',
                'url' => 'st._surl',
            ),
            array(
                'st.cmd' => 'addShare',
                'st.s' => '1',
            )
        );
    }

    /**
     * http://api.mail.ru/docs/reference/v4/sharecount/
     * Sample answer:
     * {
     *  "share_mm": 45037, // # of shares in my.mail.ru
     *  "share_ok": 14617 // # of shares in Odnoklassniki
     * }
     *
     * {@inheritDoc}
     */
    public function shareCount()
    {
        // URLs starting with https:// seem to always return 0, so let's remove scheme from URL
        $urlParts = parse_url($this->page->getUrl());

        if (isset($urlParts['host'])) {
            $url = $urlParts['host'].(isset($urlParts['path']) ? $urlParts['path'] : '');
        } else {
            $url = $this->page->getUrl(); //fallback to original url
        }

        $result = $this->getJson('http://appsmail.ru/share/count/'.urlencode($url));

        if (isset($result->{$this->countField})) {
            return intval($result->{$this->countField});
        }

        return 0;
    }
}
