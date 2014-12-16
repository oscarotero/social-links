<?php
namespace SocialLinks\Providers;

class Linkedin extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl('https://www.linkedin.com/shareArticle', ['url', 'title', 'text' => 'summary'], ['mini' => true]);
    }

    /**
     * {@inheritDoc}
     */
    public function shareCount()
    {
        $count = $this->getJson('https://www.linkedin.com/countserv/count/share', ['url'], ['format' => 'json']);

        return isset($count['count']) ? intval($count['count']) : 0;
    }
}
