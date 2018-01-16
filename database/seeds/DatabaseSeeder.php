<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Company;
use App\Country;
use App\User;
use App\Profile;
use App\Sector;
use App\CreditDays;
use App\GlobalSetting;
class DatabaseSeeder extends Seeder
{
    private $tables = [
        'users','profiles','roles','role_user', 'company_user','companies','company_country','countries','country_user','permissions','permission_user','sectors','company_sector','quotation_requests','quotations','purchase_orders','credit_days'
    ];
    private $creditDays = [
        ['days'=> 30],
        ['days'=> 45],
        ['days'=> 60]
    ];
    private $permissions = [
        [
         'name' =>'View_all_trans_company',
         'label' => 'View all company transactions',
         'label_es' => 'Ver todas las trasacciones de la compañia'
        ],
        [
            'name' =>'view_commisions',
            'label' => 'View Commissions',
            'label_es' => 'Ver Comisiones'
        ],
        [
            'name' =>'do_trans_nac',
            'label' => 'Do national transactions',
            'label_es' => 'Hacer transacciones nacionales'
        ],
        [
            'name' =>'do_trans_reg',
            'label' => 'Do regional transactions',
            'label_es' => 'Hacer transacciones regionales'
        ],
        [
            'name' =>'do_trans_int',
            'label' => 'Do international transactions',
            'label_es' => 'Hacer transacciones internacionales'
        ],
        [
            'name' =>'do_trans_glo',
            'label' => 'Do global transactions',
            'label_es' => 'Hacer transacciones globales'
        ],
        [
            'name' =>'do_trans_priv',
            'label' => 'Do private transactions',
            'label_es' => 'Hacer transacciones privadas'
        ],
        [
            'name' => 'create_countries',
            'label' => 'Create countries',
            'label_es' => 'Crear paises'
        ],
        [
            'name' => 'create_users',
            'label' => 'Create users',
            'label_es' => 'Crear usuarios'
        ],
        [
            'name' => 'global_settings',
            'label' => 'Global settings',
            'label_es' => 'Opciones globales'
        ],
       
    ];
    private $sectorsSubsectors = [
        [
            'name' => 'Food & Beverage',
        
            'children' => [
                [
                    'name' => 'Foods',
        
                    'children' => [
                        [ 'name' => 'Food warehouse' ],
                        [ 'name' => 'Seafood' ],
                        [ 'name' => 'Meats' ],
                        [ 'name' => 'Chicken' ],
                        [ 'name' => 'Sausages' ],
                        [ 'name' => 'Dairy products' ],
                        [ 'name' => 'Fruits and vegetables' ],
                        [ 'name' => 'Canned products' ],
                        [ 'name' => 'Poultry foods' ],
                        

                    ],
                ],
                [
                    'name' => 'Beverages',
        
                    'children' => [
                        [ 'name' => 'Liquor store' ],
                        [ 'name' => 'Seafood' ],
                        [ 'name' => 'Wines' ],
                        [ 'name' => 'Beers' ],
                        [ 'name' => 'Non-alcoholic beverages' ],
                        [ 'name' => 'Bottled water' ],
                    
                        

                    ],
                ],
            ],
        ],
        [
            'name' => 'Goods',
        
            'children' => [
                [ 'name' => 'Amenities, tablecloths, towels, sheets' ],
                [ 'name' => 'Bath Amenities: Soap, Shampoo, Cream' ],
                [ 'name' => 'Hardware store' ],
                [ 'name' => 'Hotel equipment and utensils' ],
                [ 'name' => 'Refrigerating Equipment' ],
                [ 'name' => 'Air Conditioning Equipment' ],
                [ 'name' => 'Pool & Jacuzzis Equipment' ],
                [ 'name' => 'Sewage treatment plants equipment' ],
                [ 'name' => 'Electric generators' ],
                [ 'name' => 'Electrical Devices' ],
                [ 'name' => 'Sound Equipment' ],
                [ 'name' => 'Office Equipment' ],
                [ 'name' => 'Cleaning and disinfection chemicals' ],
                [ 'name' => 'Laundry Chemicals' ],
                [ 'name' => 'Chemicals for Kitchen' ],
                [ 'name' => 'Pool Chemist' ],
                

            ],
        ],
        [
            'name' => 'Services',
        
            'children' => [
                [ 'name' => 'Consultancies' ],
                [ 'name' => 'Training' ],
                [ 'name' => 'Touristic tour' ],
                [ 'name' => 'Advertising services: graphic art, printing, business cards' ],
                [ 'name' => 'Repair and Maintenance of Equipment' ],
                [ 'name' => 'Construction and remodeling' ],
                [ 'name' => 'Decoration and Painting' ],
                [ 'name' => 'Systems and telecommunications' ],
                [ 'name' => 'Microbiological Laboratories' ],
                [ 'name' => 'Wastewater treatment plants: Operation' ],
                [ 'name' => 'Artists: Music Bands, Dance Group' ],
                [ 'name' => 'Security (fire, cameras, guards)' ],
                [ 'name' => 'Real estate' ],
                [ 'name' => 'Tourist and personnel transport' ],
                [ 'name' => 'Taxi Service' ],
                [ 'name' => 'Equipment and tools rent' ],
                [ 'name' => 'Fuel: LPG, Gasoline, Diesel' ],
                [ 'name' => 'Cable TV & closed circuit service' ],
                

            ],
        ],
        [
            'name' => 'Services',
        
            'children' => [
                [ 
                  'name' => 'Shipping Services',
                  'children' => [
                        [ 'name' => 'Local Shipments' ],
                        [ 'name' => 'National shipments' ],
                        [ 'name' => 'International Shipments' ],
                       
                    ]
                ],
                [ 
                    'name' => 'Financial Services',
                    'children' => [
                          [ 'name' => 'Thirty days financing' ],
                          [ 'name' => 'Forty five days financing' ],
                          [ 'name' => 'Sixty days financing' ],
                          [ 'name' => 'Advertising services: graphic art, printing, business cards' ],
                          [ 'name' => 'Repair and Maintenance of Equipment' ],
                          [ 'name' => 'Construction and remodeling' ],
                          [ 'name' => 'Decoration and Painting' ],
                      ]
                  ],
                  [ 
                    'name' => 'Contracts',
                    'children' => [
                          [ 'name' => 'Annual Contracts' ],
                          [ 'name' => 'Temporary Contract' ],
                          [ 'name' => 'Outsourcing' ],
                          [ 'name' => 'Professional Services' ],
                          
                      ]
                  ],
                
                

            ],
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

        $country = factory(Country::class, 1)->create([
            'name' => 'Costa Rica',
            'code' => 'CR',
            'currency' => 'CRC',
            'currency_symbol' => '₡',
            'currency_exchange' => 560
            
        ])->first();

        factory(GlobalSetting::class, 1)->create();
        
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
        factory(Role::class, 1)->create([ //shipping
            'name' => 'shipping',
        ]);
        factory(Role::class, 1)->create([ //credit
            'name' => 'credit',
        ]);

        foreach ($this->permissions as $permission) {

            \DB::table('permissions')->insert(
                ['name' => $permission['name'], 'label' => $permission['label'], 'label_es' => $permission['label_es']]
            );
        }
        
        
        $superadmin = factory(User::class, 1)->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
            'active' => 1,
        ])->first();

        \DB::table('permission_user')->insert(
            ['permission_id' => 1, 'user_id' => $superadmin->id]
        );
        \DB::table('permission_user')->insert(
            ['permission_id' => 2, 'user_id' => $superadmin->id]
        );
        \DB::table('permission_user')->insert(
            ['permission_id' => 8, 'user_id' => $superadmin->id]
        );
        \DB::table('permission_user')->insert(
            ['permission_id' => 9, 'user_id' => $superadmin->id]
        );
        \DB::table('permission_user')->insert(
            ['permission_id' => 10, 'user_id' => $superadmin->id]
        );

        $profileSuperAdmin = factory(Profile::class, 1)->create([
            'user_id' => $superadmin->id,
            
        ]);

        $admin = factory(User::class, 1)->create([
            'email' => 'mario@admin.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
            'active' => 1,
        ])->first();

        \DB::table('permission_user')->insert(
            ['permission_id' => 1, 'user_id' => $admin->id]
        );
        \DB::table('permission_user')->insert(
            ['permission_id' => 2, 'user_id' => $admin->id]
        );
        \DB::table('permission_user')->insert(
            ['permission_id' => 8, 'user_id' => $admin->id]
        );
        \DB::table('permission_user')->insert(
            ['permission_id' => 9, 'user_id' => $admin->id]
        );
        \DB::table('permission_user')->insert(
            ['permission_id' => 10, 'user_id' => $admin->id]
        );


        $profileadmin = factory(Profile::class, 1)->create([
            'user_id' => $admin->id,
            
        ]);
        
        \DB::table('country_user')->insert(
            ['country_id' => $country->id, 'user_id' =>  $admin->id]
        );

        $partner = factory(User::class, 1)->create()->first(); // partner
        
        $profile = factory(Profile::class, 1)->create([
            'user_id' => $partner->id,
            
        ]);
        $company = factory(Company::class, 1)->create([
            'activity' => 2
        ])->first();

        \DB::table('company_country')->insert(
            ['country_id' => $country->id, 'company_id' =>  $company->id]
        );
        \DB::table('country_user')->insert(
            ['country_id' => $country->id, 'user_id' =>  $partner->id]
        );

       
        $user = factory(User::class, 1)->create()->first();
       
        
        $user->AddToCompany($company);

        \DB::table('country_user')->insert(
            ['country_id' => $country->id, 'user_id' =>  $user->id]
        );

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

        $partner->generatePublicCode();
        $user->generatePublicCode();

       
        $profile = factory(Profile::class, 1)->create([
            'user_id' => $user->id,
            
        ]);
        
       

     
        foreach ($this->sectorsSubsectors as $sector) {
            
            Sector::create($sector);
        }

        foreach ($this->creditDays as $credit) {
            
            CreditDays::create($credit);
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
