<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanSetting;
use Illuminate\Http\Request;

class LoanSettingController extends Controller
{
    public function edit()
    {
        $setting = LoanSetting::current();
        return view('admin.loan-settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'annual_rate'         => ['required', 'numeric', 'min:0', 'max:100'],
            'min_amount'          => ['required', 'numeric', 'min:0'],
            'max_amount'          => ['required', 'numeric', 'gt:min_amount'],
            'notification_email'  => ['required', 'email'],
        ], [
            'max_amount.gt' => 'Le montant maximum doit être supérieur au montant minimum.',
        ]);

        LoanSetting::current()->update($validated);

        return back()->with('success', 'Paramètres de prêt mis à jour.');
    }
}
