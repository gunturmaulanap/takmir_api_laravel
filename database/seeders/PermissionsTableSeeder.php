<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //permission for users
        Permission::create(['name' => 'users.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'api']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'api']);

        //permission for categories
        Permission::create([
            'name' => 'categories.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'categories.create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'categories.edit',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'categories.delete',
            'guard_name' => 'api'
        ]);

        //permission for takmir
        Permission::create([
            'name' => 'takmir.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'takmir.create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'takmir.edit',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'takmir.delete',
            'guard_name' => 'api'
        ]);

        //permission for muadzin
        Permission::create([
            'name' => 'muadzin.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'muadzin.create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'muadzin.edit',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'muadzin.delete',
            'guard_name' => 'api'
        ]);
        //permission for imam
        Permission::create([
            'name' => 'imam.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'imam.create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'imam.edit',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'imam.delete',
            'guard_name' => 'api'
        ]);

        //permission for profil masjid
        Permission::create([
            'name' => 'profilemasjid.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'profilemasjid.edit',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'profilemasjid.delete',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'profilemasjid.create',
            'guard_name' => 'api'
        ]);


        //permission for khatib
        Permission::create([
            'name' => 'khatib.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'khatib.create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'khatib.edit',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'khatib.delete',
            'guard_name' => 'api'
        ]);

        //permission for roles
        Permission::create([
            'name' => 'roles.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'roles.create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'roles.edit',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'roles.delete',
            'guard_name' => 'api'
        ]);

        //permission for events
        Permission::create([
            'name' => 'events.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'events.create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'events.edit',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'events.delete',
            'guard_name' => 'api'
        ]);

        //permission for moduls
        Permission::create([
            'name' => 'moduls.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'moduls.create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'moduls.edit',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'moduls.delete',
            'guard_name' => 'api'
        ]);

        //permission for jamaah
        Permission::create([
            'name' => 'jamaahs.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'jamaahs.create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'jamaahs.edit',
            'guard_name' => 'api'
        ]);

        Permission::create([
            'name' => 'jamaahs.delete',
            'guard_name' => 'api'
        ]);

        //permission for asatidz
        Permission::create([
            'name' => 'asatidzs.index',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'asatidzs.create',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'asatidzs.edit',
            'guard_name' => 'api'
        ]);
        Permission::create([
            'name' => 'asatidzs.delete',
            'guard_name' => 'api'
        ]);
    }
}
