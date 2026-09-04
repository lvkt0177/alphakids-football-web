<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Setting;

class BranchController extends Controller
{
    public function index()
    {
        $images = [
            'branch_banner' => Setting::get('branch_banner'),
            'branch_closing_cta_photo' => Setting::get('branch_closing_cta_photo'),
        ];

        $branches = Branch::active()->ordered()->get();

        $ogImage = $images['branch_banner']
            ?? $branches->first(fn (Branch $branch) => $branch->image)?->image;
        $ogImage = $ogImage ? asset('storage/'.$ogImage) : null;

        return view('client.branch.index', compact('images', 'branches', 'ogImage'));
    }
}
