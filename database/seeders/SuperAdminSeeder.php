<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Donne l'accès super-administrateur à UN compte, sans toucher au reste des données.
 *
 *   php artisan db:seed --class=SuperAdminSeeder --force
 *
 * - Compte existant : il devient « staff » + rôle super-admin, débloqué, e-mail vérifié.
 *   Son mot de passe et ses autres données ne changent pas.
 * - Compte absent : il est créé avec un mot de passe aléatoire affiché une seule fois
 *   (à changer ensuite via « Mot de passe oublié » de l'espace staff).
 *
 * E-mail par défaut : contact@ifismabcorp.com (modifiable avec SUPER_ADMIN_EMAIL dans .env).
 * Peut être relancé sans risque.
 */
class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = strtolower(trim((string) env('SUPER_ADMIN_EMAIL', 'contact@ifismabcorp.com')));

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Rôles nécessaires à l'espace staff (créés seulement s'ils manquent)
        $role = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $user     = User::whereRaw('LOWER(email) = ?', [$email])->first();
        $password = null;

        if (! $user) {
            $password = Str::password(16, symbols: false);
            $user = User::create([
                'name'     => 'Super Admin',
                'email'    => $email,
                'password' => Hash::make($password),
                'type'     => 'staff',
                'gender'   => 'N',
            ]);
        }

        // Accès staff : type staff, compte débloqué, e-mail vérifié (sans toucher au mot de passe)
        $user->forceFill([
            'type'              => 'staff',
            'is_blocked'        => false,
            'email_verified_at' => $user->email_verified_at ?? now(),
        ])->save();

        if (! $user->hasRole($role)) {
            $user->assignRole($role);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->command?->info("Super-admin prêt : {$user->email} (rôles : " . $user->fresh()->getRoleNames()->implode(', ') . ')');
        if ($password) {
            $this->command?->warn("Compte créé. Mot de passe provisoire : {$password}");
            $this->command?->warn('Changez-le après la première connexion (Mot de passe oublié sur /staff/login).');
        } else {
            $this->command?->info('Compte existant : mot de passe inchangé.');
        }
    }
}
