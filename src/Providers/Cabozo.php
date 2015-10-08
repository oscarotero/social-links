<?php

namespace SocialLinks\Providers;

/**
 * Cabozo is a galician social network.
 */
class Cabozo extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl(
            'http://www.cabozo.com/share.php',
            array('url')
        );
    }
}
