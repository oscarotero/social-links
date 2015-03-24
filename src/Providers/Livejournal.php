<?php

namespace SocialLinks\Providers;

class Livejournal extends ProviderBase implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function shareUrl()
    {
        $titleArray = $this->page->get(array('title'));

        if (isset($titleArray['title'])) {
            $title = $titleArray['title'];
        } else {
            $title = $this->page->getUrl();
        }

        $postText = '<a href="'.$this->page->getUrl().'">'.$title.'</a>';

        return $this->buildUrl(
            'http://www.livejournal.com/update.bml',
            array('title' => 'subject'),
            array('event' => $postText)
        );
    }
}
