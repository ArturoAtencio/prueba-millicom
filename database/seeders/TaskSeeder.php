<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::truncate();

        \Schema::disableForeignKeyConstraints();

        Task::insert([
            ['title' => 'Contestar a seguidores del canal de youtube.',     'user_id' => 1, 'completed' => false],
            ['title' => 'Usar Bootstrap para mejorar el diseño.',           'user_id' => 1, 'completed' => false],
            ['title' => 'Revisar el twitter y los repost que ha generado.', 'user_id' => 1, 'completed' => true],
        ]);

        \Schema::enableForeignKeyConstraints();
    }
}
