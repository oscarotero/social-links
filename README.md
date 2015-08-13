# SocialLinks

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/oscarotero/social-links/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/oscarotero/social-links/?branch=master)
[![Build Status](https://travis-ci.org/oscarotero/social-links.svg?branch=master)](https://travis-ci.org/oscarotero/social-links)

Created by Oscar Otero <http://oscarotero.com> <oom@oscarotero.com>

This is a simple library to generate buttons to share an url or count the current shares using multiple providers (facebook, twitter, etc)
It also generate the appropiate meta tags to insert in the `<head>`

## Usage

```php
use SocialLinks\Page;

//Create a Page instance with the url information
$page = new Page([
	'url' => 'http://mypage.com',
	'title' => 'Page title',
	'text' => 'Extended page description',
	'image' => 'http://mypage.com/image.png',
	'twitterUser' => '@twitterUser'
]);

//Use the properties to get the providers info, for example:
$facebookProvider = $page->facebook;

//Each provider has the following info:
$page->twitter->shareUrl; //The url to share this page  (returns null if is not available)
$page->twitter->shareCount; //The number of the current shares (returns null if is not available)

//Example
$link = '<a href="%s">%s (%s)</a>';

printf($link, $page->facebook->shareUrl, 'Share in Facebook', $page->facebook->shareCount);
printf($link, $page->twitter->shareUrl, 'Share in Twitter', $page->twitter->shareCount);
printf($link, $page->plus->shareUrl, 'Share in Google Plus', $page->plus->shareCount);
printf($link, $page->pinterest->shareUrl, 'Share in Pinterest', $page->pinterest->shareCount);
printf($link, $page->linkedin->shareUrl, 'Share in Linkedin', $page->linkedin->shareCount);
printf($link, $page->stumbleupon->shareUrl, 'Share StumbleUpon', $page->stumbleupon->shareCount);

//To insert <meta> tags in the header, use the functions:
$card = $page->twitterCard();

foreach($card->getTags() as $tag) {
	echo $tag;
}

//You can get each tag by it's name
$graph = $page->openGraph();

echo $graph['og:title']; //<meta property="og:title" content="Page title">

//Or add new tags
$graph->addTag('og:site_name', 'My site name');
```

Usage in Symfony
----------------

There is a Symfony bundle available here: https://github.com/astina/AstinaSocialLinksBundle

Online demo
-----------

http://oscarotero.com/social-links/demo/index.php

Contributions
-------------

* All code must be PSR-1 and PSR-2 compilance. You can use this [php cs-fixer](http://cs.sensiolabs.org/)
* The providers class names must be in lowercase starting by uppercase. For example `Linkedin` instead `LinkedIn`.
* Add the new providers to demo/index.php

Thanks to:

* [peric](https://github.com/peric) For adding Email provider and some fixes
* [eusonlito](https://github.com/eusonlito) For some fixes
* [perk](https://github.com/perk11) for adding new providers