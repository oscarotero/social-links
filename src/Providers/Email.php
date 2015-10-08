<?php

namespace SocialLinks\Providers;

class Email extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        $info = $this->page->get();
        $subject = $info['title'] ?: $info['url'];

        if (empty($info['text'])) {
            $body = $info['url'];
        } else {
            $body = $info['text']."\n".$info['url'];
        }

        return $this->buildUrl(
            'mailto:',
            null,
            array(
                'subject' => $subject,
                'body' => $body,
            ),
            static::RFC3986
        );
    }
}
