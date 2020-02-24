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
    'icon' => 'http://mypage.com/favicon.png',
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
```

## Preload share counters

When you use, for example `$page->facebook->shareCount`, a request to facebook API is executed. This means that if you need also `$page->linkedin->shareCount` and `$page->plus->shareCount`, three requests are required. To improve performance, you can execute all these requests in parallel. Example:

```php
$page = newPage(['url' => 'http://page.com']);

//Preload the counters
$page->shareCount(['linkedin', 'facebook', 'plus']);

//Use them
echo $page->facebook->shareCount;
echo $page->linkedin->shareCount;
echo $page->plus->shareCount;
```

### Providers supported

Name            | Counter
----------------|--------
blogger         |  -
bobrdobr        |  -
cabozo          |  -
chuza           | YES
classroom       |  -
delicious       |  -
digg            |  -
email           |  -
evernote        |  -
facebook        | YES
line            |  -
linkedin        | YES
liveinternet    |  -
livejournal     |  -
mailru          | YES
meneame         | YES
odnoklassniki   | YES
pinterest       |  -
plus            | YES
pocket          |  -
reddit          | YES
scoopit         | YES
sms             |  -
stumbleupon     | YES
telegram        |  -
tumblr          |  -
twitter         |  -
viadeo          |  -
vk              |  -
whatsapp        |  -
xing            | YES


## Generate social meta tags

You can use this library to generate also the tags for opengraph, twitter cards, etc. Example:

```php
//$page is the same variable than the example above

//Use magic methods (instead magic properties) to get the objects with specific metas:
$card = $page->twitterCard();

//The object is traversable:
foreach($card as $tag) {
    echo $tag;
}

//You can get each tag by it's name (without prefix)
echo $card['card']; //<meta property="twitter:card" content="Summary">

//Add/edit more metas
$card->addMeta('author', '@the_author'); //<meta property="twitter:author" content="@the_autor">
```

### Meta supported

* html
* openGraph
* twitterCard
* schema

## Usage in Symfony

There is a Symfony bundle available here: https://github.com/astina/AstinaSocialLinksBundle

## Online demo

http://oscarotero.com/social-links/demo/index.php

## Contributions

* All code must be PSR-1 and PSR-2 compilance. You can use this [php cs-fixer](http://cs.sensiolabs.org/)
* The providers class names must be in lowercase starting by uppercase. For example `Linkedin` instead `LinkedIn`.
* Add the new providers to demo/index.php

Thanks to:

* [peric](https://github.com/peric) For adding Email provider and some fixes
* [eusonlito](https://github.com/eusonlito) For some fixes
* [perk](https://github.com/perk11) for adding new providers
