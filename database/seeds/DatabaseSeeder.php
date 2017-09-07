<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Company;
use App\Country;
use App\User;
use App\Profile;
class DatabaseSeeder extends Seeder
{
    private $tables = [
        'users','profiles','roles','role_user', 'partner_user','companies','countries'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();
        
        factory(Role::class, 1)->create([ //superadmin
            'name' => 'admin',
        ]);
        factory(Role::class, 1)->create(); // partner
        factory(Role::class, 1)->create([ //user
            'name' => 'user',
        ]);
               
        
        
        $admin1 = factory(User::class, 1)->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ])->first();
        $partner = factory(User::class, 1)->create()->first(); // partner
        $user = factory(User::class, 1)->create([
            'activity' => 2,
            
        ])->first();
        
        $user->AddPartner($partner);

        \DB::table('role_user')->insert(
            ['role_id' => 1, 'user_id' => $admin1->id]
        );
        \DB::table('role_user')->insert(
            ['role_id' => 2, 'user_id' => $partner->id]
        );
        \DB::table('role_user')->insert(
            ['role_id' => 3, 'user_id' => $user->id]
        );

        $profile = factory(Profile::class, 1)->create([
            'user_id' => $partner->id,
            
        ]);
        $profile = factory(Profile::class, 1)->create([
            'user_id' => $user->id,
            
        ]);
        $company = factory(Company::class, 1)->create([
            'user_id' => $partner->id,
            
        ]);
        $country = factory(Country::class, 1)->create([
            'name' => 'Costa Rica',
            'code' => 'CRC'
            
        ]);
        


    }
    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $tablename) {
            DB::table($tablename)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
