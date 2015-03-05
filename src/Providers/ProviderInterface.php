<?php
namespace SocialLinks\Providers;

interface ProviderInterface
{
    /**
     * Returns the share url.
     *
     * @return string|null
     */
    public function shareUrl();

    /**
     * Returns the share count.
     *
     * @return integer|null
     */
    public function shareCount();
}
