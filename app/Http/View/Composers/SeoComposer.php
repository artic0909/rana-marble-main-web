<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class SeoComposer
{
    public function compose(View $view): void
    {
        $view->with('seo', Setting::getMany([
            'store_name',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'og_image',
        ]));
    }
}