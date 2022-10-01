<?php

namespace Database\Seeders;

use App\Imports\Questions;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($db)
    {
        Questions::importFromGoogle($db);
    }
}
