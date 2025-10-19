<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use Str;

class CMSPageController extends Controller
{
    public function index()
    {
        $pages = CmsPage::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:cms_pages,title',
            'content' => 'required',
        ]);

        CmsPage::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('cms.index')->with('success', 'Page created successfully.');
    }

    public function edit(CmsPage $cmsPage)
    {
        return view('cms.edit', compact('cmsPage'));
    }

    public function update(Request $request, CmsPage $cmsPage)
    {
        $request->validate([
            'title' => 'required|unique:cms_pages,title,' . $cmsPage->id,
            'content' => 'required',
        ]);

        $cmsPage->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('cms.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(CmsPage $cmsPage)
    {
        $cmsPage->delete();
        return back()->with('success', 'Page deleted successfully.');
    }
}

