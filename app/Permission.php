<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    public function setNameAttribute($value)
    {
     $this->attributes['name'] = ucwords($value);
    }
    public static function defaultPermissions()
    {
        return [           
            'View Departemen',
            'Add Departemen',
            'Edit Departemen',
            'Delete Departemen',
            'View Jabatan',
            'Add Jabatan',
            'Edit Jabatan',
            'Delete Jabatan',
            'View Pegawai',
            'Add Pegawai',
            'Edit Pegawai',
            'Delete Pegawai',
            'View Proyek',
            'Add Proyek',
            'Edit Proyek',
            'Delete Proyek',
            'View Absensi',
            'Add Absensi',
            'Edit Absensi',
            'View Kasbon',
            'Add Kasbon',
            'Edit Kasbon',
            'Delete Kasbon',
            'View Gaji',
            'Add Gaji',
            'Edit Gaji',
            'Delete Gaji',
            'View Laporan',
            'View Setting',
            'View Dashboard',
        ];
    }
}
