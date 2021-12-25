<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);
         $this->call(AgenciesTableSeeder::class);
         $this->call(ContractsTableSeeder::class);
         $this->call(RulesTableSeeder::class);
         $this->call(PackagesTableSeeder::class);
         $this->call(DetailTableSeeder::class);
         $this->call(PackagesUserTableSeeder::class);
    }
}
