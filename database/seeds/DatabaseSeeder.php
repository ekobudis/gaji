<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Confirmation to insall fresh copy of database
        if ($this->command->confirm('Do you want to install fresh Database before Seeding, it will drop previous database schema as well as data ?')) {
            $this->command->call('migrate:fresh');
            $this->command->warn("All tables Droped, starting from fresh database.");
        }
        // Here we are seeding default permissions. 
        $permissions = Permission::defaultPermissions();
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $this->command->info('Default Permissions Successfully Added!');
        // Ask the user to confirm to assign roles as he wish
        if ($this->command->confirm('Default is Admin and User, Are you agree? [Y/N]', true)) {
            // User can enter Roles here.
            $roles = $this->command->ask('Enter Roles with comma separate format', 'Admin,User');
            // Now we Explode the roles
            $rolesArray = explode(',', $roles);
            // Add roles in the database...
            foreach($rolesArray as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);
                if( $role->name == 'Admin' ) {
                    // Assign all permissions to admin role
                    $role->permissions()->sync(Permission::all());
                    $this->command->info('Admin will have all Permissions');
                } else {
                    // Here we allow others only view access
                    $role->permissions()->sync(Permission::where('name', 'LIKE', 'view_%')->get());
                }
                // create one user for each role
                // Here we create one user for each role, which we have store previously
                $this->createUser($role);
            }
            $this->command->info('Roles ' . $roles . ' added successfully!');
        } else {
            Role::firstOrCreate(['name' => 'User']);
            $this->command->info('By default, User Role Added.');
        }
        //$this->call(UserTableSeeder::class);
    }

    private function createUser($role)
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);
        if( $role->name == 'Admin' ) {
            $this->command->info('Admin Login Details:');
            $this->command->warn('Username : '.$user->email);
            $this->command->warn('Password : "123456"');
        }
    }

}
