<?php

namespace Database\Seeders;

use Log;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = ['admin', 'user1', 'user2'];
        foreach ($users as $user) {
            $nip = rand(1111111111111111111, 999999999999999999);
            User::create([
                'fullname' => $user,
                'NIP' => $nip,
                'new_NIP' => $nip++,
                'password' => bcrypt('rahasia123'),
                'role' => $user == 'admin' ? 'admin' : 'user',
                'email' => Str::random(10) . '@gmail.com',
                'unit' => 'Unit ' . Str::upper((Str::random(1))),
            ]);
        }
    }
}
