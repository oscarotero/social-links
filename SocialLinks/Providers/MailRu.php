<?php

namespace SocialLinks\Providers;

/**
 * MailRu and Odnoklassniki are different social networks, but they share an owner and parts of API
 */
Class MailRu extends Odnoklassniki
{
	protected $countField = 'share_mm';

	public function shareUrl()
	{
		return $this->buildUrl('http://connect.mail.ru/share',
			[
				'url',
				'title',
				'text' => 'description',
				'image' => 'imageurl',
			]
		);

	}

}