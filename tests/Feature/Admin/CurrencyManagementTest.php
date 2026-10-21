<?php

namespace Tests\Feature\Admin;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CurrencyManagementTest extends TestCase
{
    use RefreshDatabase;

    private function superAdmin(): User
    {
        $user = User::factory()->create();
        Role::findOrCreate('super-admin');
        $user->assignRole('super-admin');

        return $user;
    }

    private function plainAdmin(): User
    {
        $user = User::factory()->create();
        Role::findOrCreate('admin');
        $user->assignRole('admin');

        return $user;
    }

    public function test_plain_admin_without_permission_cannot_access_currencies(): void
    {
        $this->actingAs($this->plainAdmin())
            ->get('/admin/currencies')
            ->assertForbidden();
    }

    public function test_super_admin_can_access_currencies(): void
    {
        $this->actingAs($this->superAdmin())
            ->get('/admin/currencies')
            ->assertOk();
    }

    public function test_bulk_update_persists_active_default_and_order(): void
    {
        $eur = Currency::create(['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€', 'is_default' => true, 'is_active' => true, 'sort_order' => 1]);
        $gbp = Currency::create(['code' => 'GBP', 'name' => 'Livre sterling', 'symbol' => '£', 'is_default' => false, 'is_active' => true, 'sort_order' => 2]);

        $this->actingAs($this->superAdmin())
            ->put('/admin/currencies', [
                'default_id' => $gbp->id,
                'currencies' => [
                    $eur->id => ['name' => 'Euro', 'symbol' => '€', 'exchange_rate' => 1, 'sort_order' => 2, 'is_active' => '1'],
                    $gbp->id => ['name' => 'Livre sterling', 'symbol' => '£', 'exchange_rate' => 0.85, 'sort_order' => 1, 'is_active' => '1'],
                ],
            ])
            ->assertRedirect(route('admin.currencies.index'));

        $this->assertTrue($gbp->fresh()->is_default);
        $this->assertFalse($eur->fresh()->is_default);
        $this->assertEquals(1, $gbp->fresh()->sort_order);
    }

    public function test_cannot_deactivate_last_active_currency(): void
    {
        $eur = Currency::create(['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€', 'is_default' => true, 'is_active' => true, 'sort_order' => 1]);

        $this->actingAs($this->superAdmin())
            ->put('/admin/currencies', [
                'default_id' => $eur->id,
                'currencies' => [
                    $eur->id => ['name' => 'Euro', 'symbol' => '€', 'exchange_rate' => 1, 'sort_order' => 1, 'is_active' => '0'],
                ],
            ])
            ->assertSessionHasErrors('currencies');

        $this->assertTrue($eur->fresh()->is_active);
    }

    public function test_cannot_delete_default_currency(): void
    {
        $eur = Currency::create(['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€', 'is_default' => true, 'is_active' => true, 'sort_order' => 1]);

        $this->actingAs($this->superAdmin())
            ->delete("/admin/currencies/{$eur->id}")
            ->assertSessionHasErrors('currency');

        $this->assertNotNull($eur->fresh());
    }

    public function test_cannot_delete_currency_referenced_by_existing_user(): void
    {
        $eur = Currency::create(['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€', 'is_default' => true, 'is_active' => true, 'sort_order' => 1]);
        $gbp = Currency::create(['code' => 'GBP', 'name' => 'Livre sterling', 'symbol' => '£', 'is_default' => false, 'is_active' => true, 'sort_order' => 2]);

        User::factory()->create(['currency' => 'GBP']);

        $this->actingAs($this->superAdmin())
            ->delete("/admin/currencies/{$gbp->id}")
            ->assertSessionHasErrors('currency');

        $this->assertNotNull($gbp->fresh());
    }
}
