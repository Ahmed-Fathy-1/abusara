<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermessionDBSeed::class);
        $this->call(RoleDBSeed::class);
        $this->call(AdminstratorDBSeed::class);
        $this->call(SettingDBSeeder::class);
        $this->call(HomePageMetaDBSeed::class);

     /*   $this->call(UsersDBSeed::class);
        $this->call(CustomerDBSeed::class);
        $this->call(CategoryDBSeed::class);
        $this->call(bannerDBSeed::class);
        $this->call(UnitDBSeed::class);
        $this->call(ProductDBSeed::class);
        $this->call(CouponDBSeed::class);
        $this->call(CategoryMetaDBSeed::class);
        $this->call(OrderDBSeed::class);*/
    }
}
