<?php

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
        $this->call(SettingsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(CommunesTableSeeder::class);
        $this->call(SpecialtiesTableSeeder::class);
        $this->call(StudiesTableSeeder::class);
        $this->call(InsurersTableSeeder::class);
        $this->call(ProfessionsTableSeeder::class);
        $this->call(DiseasesTableSeeder::class);
        $this->call(OperationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(DoctorspecialtiesTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(CategorynewsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(CategoryexamsTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        // $this->call(VisitsTableSeeder::class);
    }
}
