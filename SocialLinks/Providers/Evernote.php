<?php


namespace SocialLinks\Providers;

/**
 * Create an Evernote Clip of a page
 */
class Evernote extends ProviderBase implements ProviderInterface
{
	/**
	 * Returns the share url
	 *
	 * @return string|null
	 */
	public function shareUrl()
	{
		return $this->buildUrl('https://www.evernote.com/clip.action',
			[
				'url',
				'title',
				'text' => 'body'
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