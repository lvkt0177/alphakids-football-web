<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Faq;
use App\Models\ProofPoint;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $images = [
            'home_banner' => Setting::get('home_banner'),
            'home_banner_desktop' => Setting::get('home_banner_desktop'),
            'home_banner_mobile' => Setting::get('home_banner_mobile'),
            'home_club_intro' => Setting::get('home_club_intro'),
            'home_video_thumbnail' => Setting::get('home_video_thumbnail'),
            'home_pillar_photo' => Setting::get('home_pillar_photo'),
            'home_pillar_photo_2' => Setting::get('home_pillar_photo_2'),
            'home_pillar_photo_3' => Setting::get('home_pillar_photo_3'),
            'home_pillar_photo_4' => Setting::get('home_pillar_photo_4'),
            'home_care_photo_1' => Setting::get('home_care_photo_1'),
            'home_care_photo_2' => Setting::get('home_care_photo_2'),
            'home_class_toddler' => Setting::get('home_class_toddler'),
            'home_class_primary' => Setting::get('home_class_primary'),
            'home_class_teen' => Setting::get('home_class_teen'),
            'home_closing_cta_photo' => Setting::get('home_closing_cta_photo'),
        ];

        $videoMode = Setting::get('video_mode', 'youtube');
        $videoYoutubeUrl = Setting::get('video_youtube_url');
        $videoFile = Setting::get('video_file');

        $featuredActivities = Activity::active()->featured()->get();
        $proofPoints = ProofPoint::active()->ordered()->get();
        $homeFaqs = Faq::active()->showOnHome()->ordered()->get();

        return view('client.home', compact(
            'images',
            'videoMode',
            'videoYoutubeUrl',
            'videoFile',
            'featuredActivities',
            'proofPoints',
            'homeFaqs'
        ));
    }
}
