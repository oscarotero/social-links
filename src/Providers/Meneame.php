<?php
namespace SocialLinks\Providers;

class Meneame extends ProviderBase implements ProviderInterface
{
    protected $domain = 'http://meneame.net';

    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl("{$this->domain}/submit.php", ['url']);
    }

    /**
     * {@inheritDoc}
     */
    public function shareCount()
    {
        $result = $this->getText("{$this->domain}/api/url.php", ['url']);
        $result = explode(' ', $result);

        if (isset($result[0]) && $result[0] === 'OK') {
            return intval($result[2]);
        }

        return 0;
    }
}
