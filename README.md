SocialLinks
===========

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/oscarotero/social-links/badges/quality-score.png?s=297eaeb181f11caae68c961095ec67c76a57d4fa)](https://scrutinizer-ci.com/g/oscarotero/social-links/)

Created by Oscar Otero <http://oscarotero.com> <oom@oscarotero.com>

This is a simple library to generate buttons to share an url or count the current shares using multiple providers (facebook, twitter, etc)

Usage
-----

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

//Each provide has the following info:
$page->twitter->shareUrl; //The url to share this page  (returns null if is not available)
$page->twitter->shareCount; //The number of the current shares (returns 0 if is not available)

//Example
$link = '<a href="%s">%s (%s)</a>';

printf($link, $page->facebook->shareUrl, 'Share in Facebook', $page->facebook->shareCount);
printf($link, $page->twitter->shareUrl, 'Share in Twitter', $page->twitter->shareCount);
printf($link, $page->plus->shareUrl, 'Share in Google Plus', $page->plus->shareCount);
printf($link, $page->pinterest->shareUrl, 'Share in Pinterest', $page->pinterest->shareCount);
printf($link, $page->linkedin->shareUrl, 'Share in Linkedin', $page->linkedin->shareCount);
printf($link, $page->stumbleupon->shareUrl, 'Share StumbleUpon', $page->stumbleupon->shareCount);
```

Usage in Symfony
----------------

There is a Symfony bundle available here: https://github.com/astina/AstinaSocialLinksBundle

Online demo
-----------

http://oscarotero.com/social-links/test.php
