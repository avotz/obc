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
        'users','profiles','roles','role_user', 'partner_user','companies','company_country','countries','country_user','permissions','permission_user'
    ];
    private $permissions = [
        [
         'name' =>'View_all_trans_company',
         'label' => 'View all company transactions'
        ],
        [
            'name' =>'view_cxp',
            'label' => 'View Cxp'
        ],
        [
            'name' =>'do_trans_nac',
            'label' => 'Do national transactions'
        ],
        [
            'name' =>'do_trans_reg',
            'label' => 'Do regional transactions'
        ],
        [
            'name' =>'do_trans_int',
            'label' => 'Do international transactions'
        ],
        [
            'name' =>'do_trans_glo',
            'label' => 'Do global transactions'
        ],
        [
            'name' =>'do_trans_priv',
            'label' => 'Do private transactions'
        ],
       
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
            'name' => 'superadmin',
        ]);
        factory(Role::class, 1)->create([ //admin
            'name' => 'admin',
        ]);
        factory(Role::class, 1)->create(); // partner
        factory(Role::class, 1)->create([ //user
            'name' => 'user',
        ]);
               
        
        
        $superadmin = factory(User::class, 1)->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ])->first();

        $admin = factory(User::class, 1)->create([
            'email' => 'mario@admin.com',
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
            ['role_id' => 1, 'user_id' => $superadmin->id]
        );
        \DB::table('role_user')->insert(
            ['role_id' => 2, 'user_id' => $admin->id]
        );
        \DB::table('role_user')->insert(
            ['role_id' => 3, 'user_id' => $partner->id]
        );
        \DB::table('role_user')->insert(
            ['role_id' => 4, 'user_id' => $user->id]
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
                ['name' => $permission['name'], 'label' => $permission['label']]
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
