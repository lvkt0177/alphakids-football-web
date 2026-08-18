<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class ProgramController extends Controller
{
    public function index()
    {
        $images = [
            'program_banner' => Setting::get('program_banner'),
            'program_roadmap_1' => Setting::get('program_roadmap_1'),
            'program_roadmap_2' => Setting::get('program_roadmap_2'),
            'program_roadmap_3' => Setting::get('program_roadmap_3'),
            'program_roadmap_4' => Setting::get('program_roadmap_4'),
            'program_roadmap_5' => Setting::get('program_roadmap_5'),
            'program_roadmap_6' => Setting::get('program_roadmap_6'),
            'program_structure_warmup' => Setting::get('program_structure_warmup'),
            'program_structure_technique' => Setting::get('program_structure_technique'),
            'program_structure_match' => Setting::get('program_structure_match'),
            'program_age_toddler' => Setting::get('program_age_toddler'),
            'program_age_primary' => Setting::get('program_age_primary'),
            'program_age_teen' => Setting::get('program_age_teen'),
            'program_closing_cta_photo' => Setting::get('program_closing_cta_photo'),
        ];

        $ogImage = $images['program_banner'] ? asset('storage/' . $images['program_banner']) : null;

        return view('client.program', compact('images', 'ogImage'));
    }
}