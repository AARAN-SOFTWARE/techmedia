<?php

namespace Aaran\Slider\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SliderQuoteSeeder extends Seeder
{
    public function run()
    {
        $sliderId = 1; // Change this to match an existing slider_id

        $quotes = [
            [
                'h1' => 'High-Performance <keyword>Laptops</keyword> for Every Need.',
                'p' => [
                    'From students to professionals,',
                    'get the right laptop with the right specs — at the right price.',
                ],
                'color' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-500', 'fill' => 'fill-blue-400/70'],
            ],
            [
                'h1' => 'Reliable and Customizable <keyword>Desktops</keyword>.',
                'p' => [
                    'Workstations built for speed and power,',
                    'tailored to your personal or business requirements.',
                ],
                'color' => ['bg' => 'bg-red-50', 'text' => 'text-red-500', 'fill' => 'fill-red-400/70'],
            ],
            [
                'h1' => 'Enterprise-Grade <keyword>Servers</keyword> and Storage.',
                'p' => [
                    'Scalable server solutions for growing businesses,',
                    'with setup, support, and maintenance included.',
                ],
                'color' => ['bg' => 'bg-green-50', 'text' => 'text-green-500', 'fill' => 'fill-green-400/70'],
                'image' => 'https://images.unsplash.com/photo-1581090700227-1e8e7b1e5b26',
            ],
            [
                'h1' => 'End-to-End <keyword>Networking Solutions</keyword>.',
                'p' => [
                    'Structured cabling, routers, switches, and Wi-Fi setups —',
                    'we make your network fast, secure, and reliable.',
                ],
                'color' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-500', 'fill' => 'fill-purple-400/70'],
                'image' => 'https://images.unsplash.com/photo-1580910051071-06cb3be7ab4a',
            ],
            [
                'h1' => 'Advanced <keyword>CCTV and Surveillance Systems</keyword>.',
                'p' => [
                    'Protect your home or business with smart cameras,',
                    'remote access, and professional installation.',
                ],
                'color' => ['bg' => 'bg-pink-50', 'text' => 'text-pink-500', 'fill' => 'fill-pink-400/70'],
                'image' => 'https://images.unsplash.com/photo-1581092918295-6a91a0dcd77e',
            ],
            [
                'h1' => '<keyword>Annual Maintenance Contracts</keyword> (AMC) for Peace of Mind.',
                'p' => [
                    'Timely service, priority support, and expert care',
                    'to keep your systems running smoothly year-round.',
                ],
                'color' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-500', 'fill' => 'fill-yellow-400/70'],
                'image' => 'https://images.unsplash.com/photo-1604152135912-04a022e2366b',
            ],
            [
                'h1' => 'Expert <keyword>IT Consultation</keyword> and Deployment.',
                'p' => [
                    'Whether upgrading or setting up from scratch,',
                    'our team delivers tailor-made tech solutions.',
                ],
                'color' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-500', 'fill' => 'fill-indigo-400/70'],
                'image' => 'https://images.unsplash.com/photo-1559027615-2f112a1a7421',
            ],
            [
                'h1' => 'Smart <keyword>Peripheral Devices</keyword> & Accessories.',
                'p' => [
                    'Find everything from keyboards and printers to webcams,',
                    'backed by top brands and great deals.',
                ],
                'color' => ['bg' => 'bg-teal-50', 'text' => 'text-teal-500', 'fill' => 'fill-teal-400/70'],
                'image' => 'https://images.unsplash.com/photo-1600185365225-6e4e89e2d86b',
            ],
            [
                'h1' => 'All-in-One <keyword>Business IT Solutions</keyword>.',
                'p' => [
                    'From procurement to deployment,',
                    'we cover hardware, software, and support under one roof.',
                ],
                'color' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-500', 'fill' => 'fill-orange-400/70'],
                'image' => 'https://images.unsplash.com/photo-1573497019410-ebd9a7a3f3f9',
            ],
            [
                'h1' => '<keyword>Home & Office Setups</keyword> Made Simple.',
                'p' => [
                    'Complete PC setups with ergonomic furniture,',
                    'clean cable management, and optimized workflow.',
                ],
                'color' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-500', 'fill' => 'fill-rose-400/70'],
                'image' => 'https://images.unsplash.com/photo-1616627454279-29b3c1e4c323',
            ],
        ];

        foreach ($quotes as $quote) {
            DB::table('slider_quotes')->insert([
                'slider_id' => $sliderId,
                'header' => $quote['h1'],
                'bg_colour' => $quote['color']['bg'],
                'txt_colour' => $quote['color']['text'],
                'fill_colour' => $quote['color']['fill'],
                'tagline' => $quote['p'][0] ?? null,
                'tagline_2' => $quote['p'][1] ?? null,
                'active_id' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
