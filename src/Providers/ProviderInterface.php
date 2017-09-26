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

    /**
     * Returns the share count for multiple URLs.
     *
     * @param string $response Request response body
     *
     * @return array|null
     */
    public function shareCountMultiple($response);

    /**
     * Returns a curl resource used to count shares for multiple URLs.
     *
     * @return resource|null
     */
    public function shareCountRequestMultiple();
}
