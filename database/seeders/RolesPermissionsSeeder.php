<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abilities = ['create', 'read', 'update', 'delete'];

        $modules = [
            'siswa',
            'guru',
            'kelas',
            'pelajaran',
            'mengajar',
            'materi',
            'tugas',
            'laporan',
            'user',
        ];

        foreach ($modules as $module) {
            foreach ($abilities as $ability) {
                Permission::firstOrCreate(['name' => "$ability $module"]);
            }
        }

        $permissions_by_role = [
            'admin' => $modules,
            'kepala sekolah' => ['laporan', 'guru', 'kelas', 'pelajaran', 'siswa'],
            'guru' => ['siswa', 'kelas', 'materi', 'tugas', 'laporan'],
            'siswa' => ['materi', 'tugas'],
        ];

        foreach ($permissions_by_role as $role => $allowed_modules) {
            $permissions = [];
            foreach ($allowed_modules as $module) {
                foreach ($abilities as $ability) {
                    $permissions[] = "$ability $module";
                }
            }

            Role::firstOrCreate(['name' => $role])
                ->syncPermissions($permissions);
        }

        User::find(1)?->assignRole('admin');
        User::find(2)?->assignRole('kepala sekolah');
        User::find(3)?->assignRole('guru');
        User::find(4)?->assignRole('siswa');
    }
}
