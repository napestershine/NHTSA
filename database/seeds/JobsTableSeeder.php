<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (\Schema::hasTable('jobs')) {
            factory(App\Models\Job::class)->times(2)->create();
        }
    }
}
