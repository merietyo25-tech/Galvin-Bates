<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LanguageController extends Controller
{
    public function index(Request $request)
    {
        $languages = Language::orderBy('sort_order')->paginate(20)->appends($request->query());

        return view('admin.languages.index', compact('languages'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'languages'                 => 'required|array',
            'languages.*.sort_order'    => 'nullable|integer|min:0',
        ]);

        $rows = $request->input('languages', []);

        $visibleCount = 0;
        foreach (array_keys($rows) as $id) {
            if ($request->boolean("languages.$id.is_visible")) {
                $visibleCount++;
            }
        }

        if ($visibleCount === 0) {
            return back()
                ->withErrors(['languages' => 'Au moins une langue doit rester visible.'])
                ->withInput();
        }

        DB::transaction(function () use ($request, $rows) {
            foreach ($rows as $id => $data) {
                Language::whereKey($id)->update([
                    'is_visible' => $request->boolean("languages.$id.is_visible"),
                    'sort_order' => $data['sort_order'] ?? 0,
                ]);
            }
        });

        return redirect()->route('admin.languages.index')
                         ->with('success', 'Langues mises à jour.');
    }
}
