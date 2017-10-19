<?php

use App\Field;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateTheFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::whereEmail('fekri.m@icloud.com')->first()) {
            $user = new User([
                'first_name' => 'محمدرسول',
                'last_name' => 'فکری',
                'email' => 'fekri.m@icloud.com',
                'field_id' => Field::first()->value('id'),
            ]);
            $user->password = Hash::make('secret');
            $user->save();
        }
    }
}
