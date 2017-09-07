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
        'users','profiles','roles','role_user', 'partner_user','companies','countries','permissions','permission_user'
    ];
    private $permissions = [
        'view_all_trans_company' => 'View all company transactions',
        'view_cxp' => 'View Cxp',
        'do_trans_nac' => 'do national transactions',
        'do_trans_reg'  => 'do regional transactions', 
        'do_trans_int'  => 'do international transactions',
        'do_trans_glo'  => 'do global transactions',
        'do_trans_priv'  => 'do private transactions'
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
        $profile = factory(Profile::class, 1)->create([
            'user_id' => $partner->id,
            
        ]);
        $company = factory(Company::class, 1)->create([
            'user_id' => $partner->id,
            
        ]);

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
            'user_id' => $user->id,
            
        ]);
        
        $country = factory(Country::class, 1)->create([
            'name' => 'Costa Rica',
            'code' => 'CR'
            
        ]);

        foreach ($this->permissions as $permission) {
           
            \DB::table('permissions')->insert(
                ['name' => $permission->name, 'label' => $permission->label]
            );
        }
        


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
