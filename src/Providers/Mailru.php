<?php

namespace SocialLinks\Providers;

/**
 * MailRu and Odnoklassniki are different social networks, but they share an owner and parts of API.
 */
class Mailru extends Odnoklassniki
{
    protected $countField = 'share_mm';

    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        return $this->buildUrl('http://connect.mail.ru/share',
            array(
                'url',
                'title',
                'text' => 'description',
                'image' => 'imageurl',
            )
        );
    }
}
