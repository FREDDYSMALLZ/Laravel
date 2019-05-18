<?php

use App\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 15)->create();
        factory('App\Company', 15)->create();
        factory('App\Job', 15)->create();

        $categories = array(

            'Technology',
            'Engineering',
            'Government',
            'Medical',
            'Construction',
            'Software',
            'Supply Chain',
            'Manufacturing',
            'Transportation',
            'Warehousing',
            'Quality Assurance',
            'Diplomat',
            'Intern Student',
            'Sales'


        );
        foreach($categories as $category){
            Category::create(['name'=>$category]);
        }

        

    }
}
