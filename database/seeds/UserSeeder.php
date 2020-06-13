<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
     

        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin')
        ]);
        $author = User::create([
            'name' => 'author',
            'email' => 'author@example.com',
            'password' => Hash::make('author')
        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user')
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($author);
        $user->roles()->attach($userRole);
    }
}
