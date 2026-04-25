<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $pages = [
            [
                'url'      => url('/'),
                'priority' => '1.0',
                'freq'     => 'weekly',
            ],
            [
                'url'      => url('/marble-singhasan-mandir-white-gold-sun-om'),
                'priority' => '0.9',
                'freq'     => 'weekly',
            ],
            [
                'url'      => url('/about'),
                'priority' => '0.7',
                'freq'     => 'monthly',
            ],
            [
                'url'      => url('/contact'),
                'priority' => '0.7',
                'freq'     => 'monthly',
            ],
            [
                'url'      => url('/products'),
                'priority' => '0.7',
                'freq'     => 'weekly',
            ],
            [
                'url'      => url('/products/home-mandirs'),
                'priority' => '0.7',
                'freq'     => 'weekly',
            ],
            [
                'url'      => url('/premium-white-gold-marble-singhasan-sun-om-mandir-swastik-246073-inch'),
                'priority' => '0.7',
                'freq'     => 'weekly',
            ],
            [
                'url'      => url('/white-marble-multicolor-painted-singhasan-mandir-sun-om-244580'),
                'priority' => '0.7',
                'freq'     => 'weekly',
            ],
            [
                'url'      => url('/white-gold-marble-sun-om-mandir-with-swastik-large-home-temple-24-42-67-inches'),
                'priority' => '0.7',
                'freq'     => 'weekly',
            ],

        ];

        $content = view('sitemap', ['pages' => $pages])->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
