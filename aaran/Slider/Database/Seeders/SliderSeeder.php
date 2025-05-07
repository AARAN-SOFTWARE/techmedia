<?php

namespace Aaran\Slider\Database\Seeders;

use Aaran\Slider\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        Slider::create([
            'name' => 'Slider 1',
            'link_name' => 'Test link',
            'link_to' => 'Test link to',
            'active_id' => true,
        ]);
    }
}
