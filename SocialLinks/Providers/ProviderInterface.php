<?php
namespace SocialLinks\Providers;

interface ProviderInterface {
    public function shareApp();

    public function shareUrl();

    public function shareCount();
}