<?php

use App\Models\Group;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Group();
        $group->name = 'admin';
        $group->description = 'administrator';
        $group->is_admin = true;
        $group->save();

        $admin = User::create([
            'username'     => 'admin',
            'email'    => 'admin@estore.test',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'group_id' => $group->id,
        ]);

        $profile = Profile::create([
            'user_id' => $admin->id,
            'first_name' => 'admin',
            'last_name' => 'admin',
            'address' => 'address',
            'date_of_birth' => Carbon::now(),
            'image' => 'profile.jpg',
            'gender' => 'male',
            'phone' => '0671263237',
        ]);

    }
}
