<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // public pages
    }

    public function show($page = 'home')
{
    $allowedPages = ['home','about','services','contact','terms','privacy','cancellation','operations'];

    if (!in_array($page, $allowedPages)) {
        abort(404);
    }

    if (request()->ajax()) {
        // Return only the section content for AJAX
        return view("front.$page")->renderSections()['content'] ?? '';
    }

    return view("front.$page"); // normal page load
}

}
