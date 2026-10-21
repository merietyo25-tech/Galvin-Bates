<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index(Request $request)
    {
        $links = SocialLink::orderBy('sort_order')->paginate(20)->appends($request->query());

        return view('admin.social-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform'   => 'required|string|max:50',
            'label'      => 'required|string|max:50',
            'icon_class' => 'required|string|max:100',
            'url'        => 'required|string|max:255',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        SocialLink::create([
            'platform'   => $validated['platform'],
            'label'      => $validated['label'],
            'icon_class' => $validated['icon_class'],
            'url'        => $validated['url'],
            'is_visible' => $request->boolean('is_visible'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.social-links.index')
                         ->with('success', 'Réseau social ajouté.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', ['link' => $socialLink]);
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform'   => 'required|string|max:50',
            'label'      => 'required|string|max:50',
            'icon_class' => 'required|string|max:100',
            'url'        => 'required|string|max:255',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $socialLink->update([
            'platform'   => $validated['platform'],
            'label'      => $validated['label'],
            'icon_class' => $validated['icon_class'],
            'url'        => $validated['url'],
            'is_visible' => $request->boolean('is_visible'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.social-links.index')
                         ->with('success', 'Réseau social mis à jour.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return back()->with('success', 'Réseau social supprimé.');
    }
}
