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
        //
        DB::table('users')->insert([
            'username' => 'tuvshoo',
            'registry_no' => 'ИГ93062414',
            'email' => 'gan.tuvshinbat@gmail.com',
            'first_name' => 'Gansukh',
            'last_name' => 'Tuvshinbat',
            'password' => bcrypt('secret'),
        ]);
    }
}
