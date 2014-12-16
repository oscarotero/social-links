<?php
namespace SocialLinks\Providers;

/**
 * Cabozo is a galician social network
 */

class Cabozo extends ProviderBase implements ProviderInterface {
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl('http://www.cabozo.com/share.php', ['url']);
    }

    /**
     * Not supported
     *
     * {@inheritDoc}
     */
    public function shareCount()
    {
    	return 0;
    }
}
