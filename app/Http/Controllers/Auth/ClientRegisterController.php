<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\AdminNotification;
use App\Models\Currency;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

/**
 * Ouverture de compte en libre-service depuis le site public,
 * sans passer par une demande de prêt.
 */
class ClientRegisterController extends Controller
{
    private const OTP_TTL = 600;

    public function show()
    {
        return view('auth.register-client');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:255|unique:users,email',
            'phone'    => 'nullable|string|max:50',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'terms'    => 'accepted',
        ]);

        $locale = app()->getLocale();
        if (! in_array($locale, Language::enabledCodes())) {
            $locale = 'fr';
        }

        $user = User::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'] ?? null,
            'password'   => Hash::make($data['password']),
            'type'       => 'client',
            'gender'     => 'N',
            'created_by' => null, // un super-admin pourra l'attribuer à un conseiller
            'currency'   => Currency::default(),
            'locale'     => $locale,
        ]);
        $user->assignRole('client');

        $this->notifySuperAdmins($user);

        // Même parcours que la connexion : un code OTP envoyé par email
        // valide l'adresse et connecte le client.
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        Cache::put('otp_' . $user->id, Hash::make($otp), self::OTP_TTL);

        $request->session()->put('otp_user_id', $user->id);
        $request->session()->put('otp_remember', false);
        $request->session()->put('otp_flow', 'client');

        try {
            Mail::to($user->email)->send(new OtpMail($otp, $user));
        } catch (\Throwable $e) {
            Log::error('ClientRegisterController: échec envoi OTP', ['user_id' => $user->id, 'message' => $e->getMessage()]);
            return redirect()->route('login')
                ->withErrors(['identifier' => __('auth.register_otp_failed')]);
        }

        return redirect()->route('otp.show');
    }

    private function notifySuperAdmins(User $client): void
    {
        try {
            User::role('super-admin')->get()->each(function (User $admin) use ($client) {
                AdminNotification::forAdmin(
                    $admin->id,
                    'system',
                    'Nouveau compte client',
                    "{$client->name} ({$client->email}) a ouvert un compte depuis le site. Pensez à lui attribuer un conseiller.",
                    ['client_id' => $client->id]
                );
            });
        } catch (\Throwable $e) {
            Log::warning('ClientRegisterController: notification super-admin impossible', ['message' => $e->getMessage()]);
        }
    }
}
