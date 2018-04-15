<?php

namespace SocialLinks\Providers;

/**
 * VK.con or Vkontakte is the most popular social network in Russia and some other countries.
 */
class Vk extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl('http://vk.com/share.php',
            array(
                'url',
                'title',
                'image',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCountRequest()
    {
        static::request(
            $this->buildUrl(
                'https://vk.com/share.php',
                array('url'),
                array('act' => 'count')
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shareCount($response)
    {
        // This returns something like:
        // VK.Share.count(0, 59);
        $counts = explode(',', $response);

        if (!isset($counts[1])) {
            return 0;
        }

        $count = trim($counts[1]); // it's now "59);",

        return (int) $count;
    }
}
