<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    public function blog()
    {
        return view('admin_panel.blog');
    }

    public function booking()
    {
        return view('admin_panel.booking');
    }

    public function carousel()
    {
        return view('admin_panel.carousel');
    }

    public function property()
    {
        return view('admin_panel.property');
    }

    public function team()
    {
        return view('admin_panel.team');
    }

    public function testimonial()
    {
        return view('admin_panel.testimonial');
    }
}
