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
     * @param string $response Request response body
     *
     * @return int|null
     */
    public function shareCount($response);

    /**
     * Returns a curl resource used to count the share.
     *
     * @return resource|null
     */
    public function shareCountRequest();
}
