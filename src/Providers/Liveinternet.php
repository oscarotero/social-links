<?php

namespace SocialLinks\Providers;

class Liveinternet extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function shareUrl()
    {
        //http://www.liveinternet.ru/journal_post.php?
        //action=n_add&cnurl=Ссылка&
        //cntitle=Заголовок' target='_blank'>
        return $this->buildUrl('http://www.liveinternet.ru/journal_post.php',
            array(
                'url' => 'cnurl',
                'title' => 'cntitle',
            ),
            array('action' => 'n_add')
        );
    }
}
