<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $collection = collect([
            'users',
            'roles',
            'permissions',
            'brands',
            'lines',
            'products',
            'reviews',
            'banners',
            'coupons',
            'orders',
            'categories',
            'subcategories',
            'addresses',
        ]);

        $collection->each(function ($item, $key) {
            Permission::firstOrCreate(['group' => $item, 'name' => 'view ' . $item]);
            Permission::firstOrCreate(['group' => $item, 'name' => 'view own ' . $item]);
            Permission::firstOrCreate(['group' => $item, 'name' => 'manage ' . $item]);
            Permission::firstOrCreate(['group' => $item, 'name' => 'manage own ' . $item]);
            Permission::firstOrCreate(['group' => $item, 'name' => 'restore ' . $item]);
            Permission::firstOrCreate(['group' => $item, 'name' => 'forceDelete ' . $item]);
        });

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $user = App\User::whereEmail('admin@doctorproffi.ru')->first();
        $user->assignRole('admin');
    }
}
