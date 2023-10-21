<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Carousel;
use App\Models\Property;
use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class RealEstateController extends Controller
{

    protected function getTemplatePath($templateName)
{
    return "$templateName";
}

// public function home()
public function home()
{
    $templateName = 'RealEstate.index';
    $templatePath = $this->getTemplatePath($templateName);

    $data = [
        'carousel' => Carousel::latest()->get(),
        // 'destinations' => Destination::latest()->limit(6)->get(),
        'properties' => Property::latest()->limit(6)->get(),
        'team' => Team::latest()->limit(3)->get(),
        'clients' => Testimonial::latest()->get(),
        'blogs' => Blog::latest()->limit(3)->get()
    ];

    return view($templatePath, $data);
}

public function about()
{
    $templateName = 'RealEstate.about';
    $templatePath = $this->getTemplatePath($templateName);

    $data = [

    ];

    return view($templatePath, $data);
}

public function agent_single()
{
    $templateName = 'RealEstate.agent_single';
    $templatePath = $this->getTemplatePath($templateName);

    $data = [

    ];

    return view($templatePath, $data);
}

public function agents_grid()
{
    $templateName = 'RealEstate.agents_grid';
    $templatePath = $this->getTemplatePath($templateName);

    $data = [

    ];

    return view($templatePath, $data);
}

public function blog_grid()
{
    $templateName = 'RealEstate.blog_grid';
    $templatePath = $this->getTemplatePath($templateName);

    $data = [
        'blogs' => Blog::latest()->limit(3)->get()
    ];

    return view($templatePath, $data);
}

public function blog_single($blog_id)
{
    $templateName = 'RealEstate.blog_single';
    $templatePath = $this->getTemplatePath($templateName);

    $data = [
        'blog' => Blog::findOrFail($blog_id)
    ];

    return view($templatePath, $data);
}

public function contact()
{
    $templateName = 'RealEstate.contact';
    $templatePath = $this->getTemplatePath($templateName);

    $data = [

    ];

    return view($templatePath, $data);
}

public function property_grid()
{
    $templateName = 'RealEstate.property_grid';
    $templatePath = $this->getTemplatePath($templateName);

    $data = [
        'properties' => Property::latest()->limit(6)->get(),

    ];

    return view($templatePath, $data);
}

public function property_single($property_id)
{
    $templateName = 'RealEstate.property_single';
    $templatePath = $this->getTemplatePath($templateName);

    $data = [
        'property' => Property::findOrFail($property_id)
    ];

    return view($templatePath, $data);
}
}
