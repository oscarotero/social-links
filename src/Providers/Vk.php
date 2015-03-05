<?php

namespace SocialLinks\Providers;

/**
 * VK.con or Vkontakte is the most popular social network in Russia and some other countries.
 */
class Vk extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl('http://vk.com/share.php',
            array(
                'url',
                'text' => 'description',
                'image',
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function shareCount()
    {
        // This returns something like:
        // VK.Share.count(0, 59);
        $countText = $this->getText(
            'https://vk.com/share.php',
            array('url'),
            array('act' => 'count')
        );

        $counts = explode(',', $countText);

        if (!isset($counts[1])) {
            return 0;
        }

        $count = trim($counts[1]); // it's now "59);",

        return (int) $count;
    }
}
