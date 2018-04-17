<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@tuta.pos',
            'password' => bcrypt('admin'),
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        factory(App\User::class, 30)->create();
    }
}
