<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sidebar;
use Illuminate\Support\Str;

class SidebarController extends Controller
{
    public function index()
    {
        $sidebars = Sidebar::with('children.children')->whereNull('parent_id')->get();
        return view('admin.sidebar.index', compact('sidebars'));
    }

    // app/Http/Controllers/Admin/SidebarController.php

    public function create()
    {
        $parents = Sidebar::all();

        // fetch top-level sidebars for sidebar display
        $sidebars = Sidebar::with('children.children')
                        ->whereNull('parent_id')
                        ->get();

        return view('admin.sidebar.create', compact('parents', 'sidebars'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:sidebars,id',
            'icon' => 'nullable|string|max:255'
        ]);

        $level = 1;
        if ($request->parent_id) {
            $parent = Sidebar::find($request->parent_id);
            $level = $parent->level + 1;
        }

        Sidebar::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'icon' => $request->icon,
            'parent_id' => $request->parent_id,
            'level' => $level,
        ]);

        return redirect()->route('sidebar.index')->with('success', 'Sidebar item created successfully.');
    }
}
