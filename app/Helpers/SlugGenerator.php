<?php

namespace App\Helpers;

class SlugGenerator
{
    public function generate_slug(string $title): string
    {
        return str()->slug($title);
    }
}
