<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Remove auth if you want public pages accessible without login
        // $this->middleware('auth');
    }

    /**
     * Display the requested page.
     *
     * @param string $page
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($page = 'home')
    {
        $allowedPages = ['home', 'about', 'services', 'contact', 'terms', 'privacy', 'cancellation', 'operations'];

        if (!in_array($page, $allowedPages)) {
            abort(404);
        }

        $view = view("front.$page");

        if (request()->ajax()) {
            return $view->render();
        }

        return view('layouts.app')->with('content', $view->render());
    }

}
