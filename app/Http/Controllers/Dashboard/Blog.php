<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Blog extends Controller
{
    public function blogListing()
    {
        return view('dashboards.blog-listing', [
            'title' => 'Dashboard'
        ]);
    }
}
