<?php

namespace SocialLinks\Providers;

/**
 * BobrDobr is a Russian clone of delicio.us
 */
class BobrDobr extends ProviderBase implements ProviderInterface
{

	/**
	 * Returns the share url
	 *
	 * @return string|null
	 */
	public function shareUrl()
	{
		return $this->buildUrl(
			'http://bobrdobr.ru/addext.html',
			[
				'url',
				'title',
				'text' => 'desc',
			]
		);
	}

	/**
	 * Not supported
	 *
	 * @return integer
	 */
	public function shareCount()
	{
		return 0;
	}
}