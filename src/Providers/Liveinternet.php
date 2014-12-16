<?php

namespace SocialLinks\Providers;


class Liveinternet extends ProviderBase implements ProviderInterface
{

	/**
     * {@inheritDoc}
     */
	public function shareUrl()
	{
		//http://www.liveinternet.ru/journal_post.php?
		//action=n_add&cnurl=Ссылка&
		//cntitle=Заголовок' target='_blank'>
		return $this->buildUrl('http://www.liveinternet.ru/journal_post.php',
			[
				'url' => 'cnurl',
				'title' => 'cntitle',
			],
			[
				'action' => 'n_add',
			]
		);
	}

	/**
	 * Not supported
	 *
     * {@inheritDoc}
     */
	public function shareCount()
	{
		return 0;
	}
}