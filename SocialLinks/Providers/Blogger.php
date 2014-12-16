<?php


namespace SocialLinks\Providers;


class Blogger extends ProviderBase implements ProviderInterface
{

	/**
	 * Returns the share url
	 *
	 * @return string|null
	 */
	public function shareUrl()
	{
		return $this->buildUrl('https://www.blogger.com/blog-this.g',
			[
				'url' => 'u',
				'title' => 'n',
			]);
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