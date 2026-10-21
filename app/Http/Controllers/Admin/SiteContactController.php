<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteContactController extends Controller
{
    public function edit()
    {
        $contact = SiteContact::current();
        return view('admin.site-contacts.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'address_1' => ['nullable', 'string', 'max:255'],
            'address_2' => ['nullable', 'string', 'max:255'],
            'address_3' => ['nullable', 'string', 'max:255'],
            'phone_1'   => ['nullable', 'string', 'max:255'],
            'phone_2'   => ['nullable', 'string', 'max:255'],
            'email'     => ['nullable', 'email', 'max:255'],
            'whatsapp_number'  => ['nullable', 'string', 'max:30'],
            'whatsapp_enabled' => ['boolean'],
            'logo_light'      => ['nullable', 'image', 'max:2048'],
            'logo_dark'       => ['nullable', 'image', 'max:2048'],
            'email_signature' => ['nullable', 'image', 'max:2048'],
        ]);

        $contact = SiteContact::current();
        $contact->update(collect($validated)->except(['logo_light', 'logo_dark', 'email_signature'])->all());

        $this->handleLogoUploads($request, $contact);

        return back()->with('success', 'Coordonnées mises à jour.');
    }

    private function handleLogoUploads(Request $request, SiteContact $contact): void
    {
        $logoFields = [
            'logo_light'      => 'logo_light_path',
            'logo_dark'       => 'logo_dark_path',
            'email_signature' => 'email_signature_path',
        ];

        foreach ($logoFields as $input => $column) {
            if ($request->hasFile($input)) {
                $old = $contact->$column;
                $contact->$column = $request->file($input)->store('site-branding', 'public');
                if ($old) Storage::disk('public')->delete($old);
            } elseif ($request->boolean('remove_' . $input) && $contact->$column) {
                Storage::disk('public')->delete($contact->$column);
                $contact->$column = null;
            }
        }

        $contact->save();
    }
}
