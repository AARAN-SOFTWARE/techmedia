<?php

namespace Aaran\Assets\Helper;

class SlideQuotes
{
    public static function all()
    {
        return [
            [
                'h1' => 'High-Performance <keyword>Laptops</keyword> for Every Need.',
                'p' => [
                    'From students to professionals,',
                    'get the right laptop with the right specs — at the right price.',
                ],
                'color' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-500', 'fill' => 'fill-blue-400/70'],
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8',
            ],
            [
                'h1' => 'Reliable and Customizable <keyword>Desktops</keyword>.',
                'p' => [
                    'Workstations built for speed and power,',
                    'tailored to your personal or business requirements.',
                ],
                'color' => ['bg' => 'bg-red-50','text' => 'text-red-500', 'fill' => 'fill-red-400/70'],
                'image' => 'https://images.unsplash.com/photo-1587202372775-e4d9ae4e270b',
            ],
            [
                'h1' => 'Enterprise-Grade <keyword>Servers</keyword> and Storage.',
                'p' => [
                    'Scalable server solutions for growing businesses,',
                    'with setup, support, and maintenance included.',
                ],
                'color' => ['bg' => 'bg-green-50','text' => 'text-green-500', 'fill' => 'fill-green-400/70'],
                'image' => 'https://images.unsplash.com/photo-1581090700227-1e8e7b1e5b26',
            ],
            [
                'h1' => 'End-to-End <keyword>Networking Solutions</keyword>.',
                'p' => [
                    'Structured cabling, routers, switches, and Wi-Fi setups —',
                    'we make your network fast, secure, and reliable.',
                ],
                'color' => ['bg' => 'bg-purple-50','text' => 'text-purple-500', 'fill' => 'fill-purple-400/70'],
                'image' => 'https://images.unsplash.com/photo-1580910051071-06cb3be7ab4a',
            ],
            [
                'h1' => 'Advanced <keyword>CCTV and Surveillance Systems</keyword>.',
                'p' => [
                    'Protect your home or business with smart cameras,',
                    'remote access, and professional installation.',
                ],
                'color' => ['bg' => 'bg-pink-50','text' => 'text-pink-500', 'fill' => 'fill-pink-400/70'],
                'image' => 'https://images.unsplash.com/photo-1581092918295-6a91a0dcd77e',
            ],
            [
                'h1' => '<keyword>Annual Maintenance Contracts</keyword> (AMC) for Peace of Mind.',
                'p' => [
                    'Timely service, priority support, and expert care',
                    'to keep your systems running smoothly year-round.',
                ],
                'color' => ['bg' => 'bg-yellow-50','text' => 'text-yellow-500', 'fill' => 'fill-yellow-400/70'],
                'image' => 'https://images.unsplash.com/photo-1604152135912-04a022e2366b',
            ],
            [
                'h1' => 'Expert <keyword>IT Consultation</keyword> and Deployment.',
                'p' => [
                    'Whether upgrading or setting up from scratch,',
                    'our team delivers tailor-made tech solutions.',
                ],
                'color' => ['bg' => 'bg-indigo-50','text' => 'text-indigo-500', 'fill' => 'fill-indigo-400/70'],
                'image' => 'https://images.unsplash.com/photo-1559027615-2f112a1a7421',
            ],
            [
                'h1' => 'Smart <keyword>Peripheral Devices</keyword> & Accessories.',
                'p' => [
                    'Find everything from keyboards and printers to webcams,',
                    'backed by top brands and great deals.',
                ],
                'color' => ['bg' => 'bg-teal-50','text' => 'text-teal-500', 'fill' => 'fill-teal-400/70'],
                'image' => 'https://images.unsplash.com/photo-1600185365225-6e4e89e2d86b',
            ],
            [
                'h1' => 'All-in-One <keyword>Business IT Solutions</keyword>.',
                'p' => [
                    'From procurement to deployment,',
                    'we cover hardware, software, and support under one roof.',
                ],
                'color' => ['bg' => 'bg-orange-50','text' => 'text-orange-500', 'fill' => 'fill-orange-400/70'],
                'image' => 'https://images.unsplash.com/photo-1573497019410-ebd9a7a3f3f9',
            ],
            [
                'h1' => '<keyword>Home & Office Setups</keyword> Made Simple.',
                'p' => [
                    'Complete PC setups with ergonomic furniture,',
                    'clean cable management, and optimized workflow.',
                ],
                'color' => ['bg' => 'bg-rose-50','text' => 'text-rose-500', 'fill' => 'fill-rose-400/70'],
                'image' => 'https://images.unsplash.com/photo-1616627454279-29b3c1e4c323',
            ],
        ];
    }


    public static function highlightKeyword($text, $color)
    {
        return preg_replace_callback('/<keyword>(.*?)<\/keyword>/i', function ($matches) use ($color) {
            $keyword = $matches[1];
            return <<<HTML
                <span class="relative whitespace-nowrap {$color['text']}">

                  <svg aria-hidden="true"
                                     viewBox="0 0 418 42"
                                     class="absolute top-2/3 left-0 h-[0.58em] w-full {$color['fill']}"
                                     preserveAspectRatio="none"><path
                                        d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z"></path>
                  </svg>

                    <span class="relative">{$keyword}</span>
                </span>
            HTML;
        }, $text);
    }
}
