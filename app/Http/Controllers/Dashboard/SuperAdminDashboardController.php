<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LoanRequest;
use App\Models\User;
use Database\Seeders\ExceptionalPermissionsSeeder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'    => User::count(),
            'total_clients'  => User::where('type', 'client')->count(),
            'total_staff'    => User::where('type', 'staff')->count(),
            'total_loans'    => LoanRequest::count(),
            'pending_loans'  => LoanRequest::whereIn('status', [null, 'pending'])->count(),
            'approved_loans' => LoanRequest::where('status', 'approved')->count(),
            'rejected_loans' => LoanRequest::where('status', 'rejected')->count(),
            'review_loans'   => LoanRequest::where('status', 'review')->count(),
            'total_amount'   => LoanRequest::sum('amount'),
            'month_loans'    => LoanRequest::whereMonth('created_at', now()->month)
                                           ->whereYear('created_at', now()->year)->count(),
        ];

        $recentUsers = User::latest()->take(8)->get();
        $recentLoans = LoanRequest::latest()->take(8)->get();

        return view('dashboard.super-admin.index', compact('stats', 'recentUsers', 'recentLoans'));
    }

    public function roles()
    {
        $roles           = Role::withCount('users')->get();
        $users           = User::with('roles')->latest()->paginate(20);
        $adminUsers      = User::role('admin')->orderBy('name')->get();
        $exceptionalPerms = ExceptionalPermissionsSeeder::PERMISSIONS;

        return view('dashboard.super-admin.roles', compact('roles', 'users', 'adminUsers', 'exceptionalPerms'));
    }

    public function assignRole(User $user)
    {
        request()->validate(['role' => 'required|string|exists:roles,name']);
        $role = request('role');

        if ($role === 'super-admin' || $role === 'admin') {
            $user->update(['type' => 'staff']);
        } else {
            $user->update(['type' => 'client']);
        }

        $user->syncRoles([$role]);
        return back()->with('success', "Rôle « {$role} » attribué à {$user->name}.");
    }

    /**
     * Accorde/révoque des permissions exceptionnelles à un admin classique,
     * lui donnant accès à une zone habituellement réservée au super-admin
     * sans changer son rôle.
     */
    public function updatePermissions(Request $request, User $user)
    {
        abort_unless($user->hasRole('admin'), 422, 'Les permissions exceptionnelles ne concernent que les admins classiques.');

        $data = $request->validate([
            'permissions'   => 'nullable|array',
            'permissions.*' => 'string|in:' . implode(',', array_keys(ExceptionalPermissionsSeeder::PERMISSIONS)),
        ]);

        $user->syncPermissions($data['permissions'] ?? []);

        return back()->with('success', "Permissions exceptionnelles mises à jour pour {$user->name}.");
    }
}
