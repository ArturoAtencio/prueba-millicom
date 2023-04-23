<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();

        User::truncate();

        User::insert([
            'name' => 'Arturo Atencio', 'email' => 'arturo.a.atencio@gmail.com', 'password' => password_hash("87654321", PASSWORD_DEFAULT),
        ]);

        \Schema::enableForeignKeyConstraints();
    }
}
