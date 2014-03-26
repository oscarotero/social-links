<?php
namespace SocialLinks\Providers;

interface ProviderInterface {
    public function shareUrl();

    public function count();
}