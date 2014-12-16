<?php

namespace SocialLinks\Providers;


class LiveJournal extends ProviderBase implements ProviderInterface
{
	/**
	 * Returns the share url
	 *
	 * @return string|null
	 */
	public function shareUrl()
	{
		$titleArray = $this->page->get(['title']);
		if (isset($titleArray['title'])) {
			$title = $titleArray['title'];
		} else {
			$title = $this->page->getUrl();
		}
		$postText = '<a href="' . $this->page->getUrl() . '">' . $title . '</a>';

		return $this->buildUrl('http://www.livejournal.com/update.bml',
			[
				'title' => 'subject',
			],
			[
				'event' => $postText,
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