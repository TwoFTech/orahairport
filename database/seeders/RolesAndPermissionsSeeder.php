<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles
            $manager = Role::create(['name' => 'manager']);
            $dev = Role::create(['name' => 'dev']);
            $account = Role::create(['name' => 'account-manager']);
            $admin = Role::create(['name' => 'admin-vente']);
            $resa = Role::create(['name' => 'resa']);
            $customer = Role::create(['name' => 'customer-manager']);
            $admin2 = Role::create(['name' => 'admin']);
            $marketing = Role::create(['name' => 'marketing']);
            $merchant = Role::create(['name' => 'merchant']);
            $passenger = Role::create(['name' => 'passenger']);
            $support = Role::create(['name' => 'support']);

        // create permissions
            // 1 - Sur Utilisateur
                Permission::create(['name' => 'create user']);
                Permission::create(['name' => 'show user']);
                Permission::create(['name' => 'edit user']);
                Permission::create(['name' => 'delete user']);
                Permission::create(['name' => 'active user']);

            // 2 - Sur le stand
                Permission::create(['name' => 'ask stand']);
                Permission::create(['name' => 'show stand']);
                Permission::create(['name' => 'edit stand']);
                Permission::create(['name' => 'delete stand']);
                Permission::create(['name' => 'validate stand']);
                Permission::create(['name' => 'active stand']);
                Permission::create(['name' => 'subscribe stand']);
                Permission::create(['name' => 'resubscribe stand']);

            // 3 - Sur la réservation
                Permission::create(['name' => 'ticket resa request']);
                Permission::create(['name' => 'show ticket resa']);
                Permission::create(['name' => 'edit ticket resa']);
                Permission::create(['name' => 'delete ticket resa']);
                Permission::create(['name' => 'pay ticket resa']);
                Permission::create(['name' => 'validate ticket resa']);
                Permission::create(['name' => 'cancel ticket resa']);

            // 4 - systems
                Permission::create(['name' => 'setting system']);
                Permission::create(['name' => 'autorize country']);
                Permission::create(['name' => 'edit amount']);
                Permission::create(['name' => 'role manager']);
                Permission::create(['name' => 'manage superAdmin']);
                Permission::create(['name' => 'manage dev']);

            // 5 - Clients & Contacts
                Permission::create(['name' => 'send mail']);
                Permission::create(['name' => 'show merchant']);
                Permission::create(['name' => 'show client']);

            // 6 - Centres & Villes
            $a = [

                Permission::create(['name' => 'create city']),
                Permission::create(['name' => 'edit city']),
                Permission::create(['name' => 'active city']),
                Permission::create(['name' => 'create center']),
                Permission::create(['name' => 'edit center']),
                Permission::create(['name' => 'active center']),
            ];

            // 7 - Fournisseurs & Partenaire
                Permission::create(['name' => 'create prestataire']);
                Permission::create(['name' => 'edit prestataire']);
                Permission::create(['name' => 'active prestataire']);

                Permission::create(['name' => 'create partner']);
                Permission::create(['name' => 'edit partner']);
                Permission::create(['name' => 'active partner']);
                Permission::create(['name' => 'delete partner']);

        // givePermissionTo Roles
            $dev->givePermissionTo(Permission::all());
            $manager->givePermissionTo(Permission::all());

        // Assign Role To Users

        $dev1 = User::where('id', 1)->first();
        $dev1->assignRole('dev');

        $dev2 = User::where('id', 2)->first();
        $dev2->assignRole('dev');

        $superAdmin = User::where('id', 3)->first();
        $superAdmin->assignRole('manager');

        // $accountUser = User::where('id', 4)->first();
        // $accountUser->assignRole('account-manager');

        // $resaUser = User::where('id', 5)->first();
        // $resaUser->assignRole('resa');

        // $admin = User::where('id', 6)->first();
        // $admin->assignRole('admin');

        // $merchantUser = User::where('id', 7)->first();
        // $merchantUser->assignRole('merchant');
    }
}
