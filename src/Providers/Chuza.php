<?php

namespace SocialLinks\Providers;

/**
 * Chuza is a galician network.
 * It has the same api than meneame, only changes the domain.
 */
class Chuza extends Meneame implements ProviderInterface
{
    protected $domain = 'http://chuza.gl';
}
