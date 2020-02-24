<?php

namespace SocialLinks;

use SocialLinks\Page;
use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase
{
    public function testPage()
    {
        $info = array(
            'url' => 'http://mypage.com   ',
            'title' => "Page \n  <strong>title</strong>\n",
            'text' => 'Extended <strong>page description</strong> &amp; ',
            'image' => 'http://mypage.com/image.png',
            'twitterUser' => '@twitterUser',
            'icon' => 'http://mypage.com/favicon.png'
        );

        $infoNormalized = array(
            'url' => 'http://mypage.com',
            'title' => 'Page title',
            'text' => 'Extended page description &',
            'image' => 'http://mypage.com/image.png',
            'twitterUser' => '@twitterUser',
            'icon' => 'http://mypage.com/favicon.png'
        );

        $page = new Page($info);

        $this->assertEquals($infoNormalized['url'], $page->getUrl());
        $this->assertEquals($infoNormalized['title'], $page->getTitle());
        $this->assertEquals($infoNormalized['text'], $page->getText());
        $this->assertEquals($infoNormalized['image'], $page->getImage());
        $this->assertEquals($infoNormalized['twitterUser'], $page->getTwitterUser());
        $this->assertEquals($infoNormalized, $page->get());

        return $page;
    }

    /**
     * @depends testPage
     */
    public function testProviders(Page $page)
    {
        $this->assertEquals($page->blogger->shareUrl, 'https://www.blogger.com/blog-this.g?u=http%3A%2F%2Fmypage.com&n=Page+title');
        $this->assertEquals($page->bobrdobr->shareUrl, 'http://bobrdobr.ru/addext.html?url=http%3A%2F%2Fmypage.com&title=Page+title&desc=Extended+page+description+%26');
        $this->assertEquals($page->cabozo->shareUrl, 'http://www.cabozo.com/share.php?url=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->chuza->shareUrl, 'http://chuza.gl/submit.php?url=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->delicious->shareUrl, 'https://delicious.com/save?url=http%3A%2F%2Fmypage.com&title=Page+title');
        $this->assertEquals($page->digg->shareUrl, 'https://digg.com/submit?url=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->email->shareUrl, 'mailto:?subject=Page%20title&body=Extended%20page%20description%20%26%0Ahttp%3A%2F%2Fmypage.com');
        $this->assertEquals($page->evernote->shareUrl, 'https://www.evernote.com/clip.action?url=http%3A%2F%2Fmypage.com&title=Page+title&body=Extended+page+description+%26');
        $this->assertEquals($page->facebook->shareUrl, 'https://www.facebook.com/sharer/sharer.php?display=popup&redirect_uri=http%3A%2F%2Fwww.facebook.com&u=http%3A%2F%2Fmypage.com&t=Page+title');
        $this->assertEquals($page->line->shareUrl, 'https://social-plugins.line.me/lineit/share?url=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->linkedin->shareUrl, 'https://www.linkedin.com/shareArticle?mini=1&url=http%3A%2F%2Fmypage.com&title=Page+title&summary=Extended+page+description+%26');
        $this->assertEquals($page->liveinternet->shareUrl, 'http://www.liveinternet.ru/journal_post.php?action=n_add&cnurl=http%3A%2F%2Fmypage.com&cntitle=Page+title');
        $this->assertEquals($page->livejournal->shareUrl, 'http://www.livejournal.com/update.bml?event=%3Ca+href%3D%22http%3A%2F%2Fmypage.com%22%3EPage+title%3C%2Fa%3E&subject=Page+title');
        $this->assertEquals($page->mailru->shareUrl, 'http://connect.mail.ru/share?url=http%3A%2F%2Fmypage.com&title=Page+title&description=Extended+page+description+%26&imageurl=http%3A%2F%2Fmypage.com%2Fimage.png');
        $this->assertEquals($page->meneame->shareUrl, 'http://meneame.net/submit.php?url=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->odnoklassniki->shareUrl, 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->pinterest->shareUrl, 'https://www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fmypage.com&description=Page+title&media=http%3A%2F%2Fmypage.com%2Fimage.png');
        $this->assertEquals($page->plus->shareUrl, 'https://plus.google.com/share?url=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->pocket->shareUrl, 'https://getpocket.com/edit?url=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->scoopit->shareUrl, 'https://www.scoop.it/bookmarklet?url=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->sms->shareUrl, 'sms:?&body=Page%20title%20http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->stumbleupon->shareUrl, 'https://www.stumbleupon.com/submit?url=http%3A%2F%2Fmypage.com&title=Page+title');
        $this->assertEquals($page->reddit->shareUrl, 'https://www.reddit.com/submit?url=http%3A%2F%2Fmypage.com&title=Page+title');
        $this->assertEquals($page->tumblr->shareUrl, 'https://www.tumblr.com/share?v=3&u=http%3A%2F%2Fmypage.com&t=Page+title');
        $this->assertEquals($page->twitter->shareUrl, 'https://twitter.com/intent/tweet?text=Page+title+via+%40twitterUser&url=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->vk->shareUrl, 'http://vk.com/share.php?url=http%3A%2F%2Fmypage.com&title=Page+title&image=http%3A%2F%2Fmypage.com%2Fimage.png');
        $this->assertEquals($page->whatsapp->shareUrl, 'https://wa.me/?text=Page+title+http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->telegram->shareUrl, 'tg://msg?text=Page+title+http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->xing->shareUrl, 'https://www.xing.com/spi/shares/new?url=http%3A%2F%2Fmypage.com');
        $this->assertEquals($page->viadeo->shareUrl, 'https://partners.viadeo.com/share?url=http%3A%2F%2Fmypage.com&comment=Page+title');
    }

    /**
     * @depends testPage
     */
    public function testMetas(Page $page)
    {
        $twitterCard = (string) $page->twitterCard();
        $openGraph = (string) $page->openGraph();
        $html = (string) $page->html();
        $schema = (string) $page->schema();

        $this->assertEquals($twitterCard, <<<EOT
<meta name="twitter:title" content="Page title">
<meta name="twitter:description" content="Extended page description &amp;">
<meta name="twitter:site" content="@twitterUser">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="http://mypage.com/image.png">
EOT
);
        $this->assertEquals($openGraph, <<<EOT
<meta property="og:type" content="website">
<meta property="og:title" content="Page title">
<meta property="og:url" content="http://mypage.com">
<meta property="og:description" content="Extended page description &amp;">
<meta property="og:image" content="http://mypage.com/image.png">
<meta property="og:image" content="http://mypage.com/favicon.png">
EOT
);
        $this->assertEquals($html, <<<EOT
<meta name="title" content="Page title">
<meta name="description" content="Extended page description &amp;">
<link rel="image_src" href="http://mypage.com/image.png">
<link rel="canonical" href="http://mypage.com">
EOT
);
        $this->assertEquals($schema, <<<EOT
<meta itemprop="name" content="Page title">
<meta itemprop="description" content="Extended page description &amp;">
<meta itemprop="image" content="http://mypage.com/image.png">
EOT
);
    }

    public function testOptions()
    {
        $info = array(
            'url' => 'http://example.com',
            'title' => 'Title',
            'text' => 'Description',
            'image' => 'http://example.com/image.png',
            'twitterUser' => '@example',
        );

        $page = new Page($info, array(
            'twitter_card_type' => 'summary_large_image'
        ));

        $twitterCard = $page->twitterCard();

        $this->assertEquals('<meta name="twitter:card" content="summary_large_image">', $twitterCard['card']);
    }
}
