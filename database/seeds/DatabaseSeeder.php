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
        'users', 'profiles', 'roles', 'role_user', 'company_user', 'companies', 'company_country', 'countries', 'country_user', 'permissions', 'permission_user', 'sectors', 'company_sector', 'quotation_requests', 'quotations', 'purchase_orders', 'credit_days'
    ];
    private $creditDays = [
        ['days' => 30],
        ['days' => 45],
        ['days' => 60]
    ];
    private $permissions = [
        [
         'name' => 'view_all_trans_company',
         'label' => 'View all transactions',
         'label_es' => 'Ver todas las trasacciones'
        ],
        [
            'name' => 'view_commissions',
            'label' => 'View Commissions',
            'label_es' => 'Ver Comisiones'
        ],
        [
            'name' => 'do_trans_nac',
            'label' => 'Do national transactions',
            'label_es' => 'Hacer transacciones nacionales'
        ],
        [
            'name' => 'do_trans_reg',
            'label' => 'Do regional transactions',
            'label_es' => 'Hacer transacciones regionales'
        ],
        [
            'name' => 'do_trans_int',
            'label' => 'Do international transactions',
            'label_es' => 'Hacer transacciones internacionales'
        ],
        [
            'name' => 'do_trans_glo',
            'label' => 'Do global transactions',
            'label_es' => 'Hacer transacciones globales'
        ],
        [
            'name' => 'do_trans_priv',
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
            'name_es' => 'Alimentos y Bebidas',
            'children' => [
                [
                    'name' => 'Foods',
                    'name_es' => 'Alimentos',
                    'children' => [
                        ['name' => 'Food warehouse', 'name_es' => 'Almacén de Alimentos'],
                        ['name' => 'Seafood', 'name_es' => 'Mariscos'],
                        ['name' => 'Meats', 'name_es' => 'Carnes'],
                        ['name' => 'Chicken', 'name_es' => 'Pollo'],
                        ['name' => 'Sausages', 'name_es' => 'Embutidos'],
                        ['name' => 'Dairy products', 'name_es' => 'Productos lácteos'],
                        ['name' => 'Fruits and vegetables', 'name_es' => 'Frutas y vegetales'],
                        ['name' => 'Canned products', 'name_es' => 'Productos enlatados'],
                        ['name' => 'Poultry foods', 'name_es' => 'Alimentos avícolas'],
                    ],
                ],
                [
                    'name' => 'Beverages',
                    'name_es' => 'Bebidas',
                    'children' => [
                        ['name' => 'Liquor store', 'name_es' => 'Tienda de licores'],
                        ['name' => 'Wines', 'name_es' => 'Vinos'],
                        ['name' => 'Beers', 'name_es' => 'Productos lácteos'],
                        ['name' => 'Non-alcoholic beverages', 'name_es' => 'Bebidas no alcohólicas'],
                        ['name' => 'Bottled water', 'name_es' => 'Agua embotellada'],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Goods',
            'name_es' => 'Bienes',
            'children' => [
                ['name' => 'Amenities, tablecloths, towels, sheets', 'name_es' => 'Amenidades, manteles, toallas, sabanas'],
                ['name' => 'Bath Amenities: Soap, Shampoo, Cream', 'name_es' => 'Amenidades de Baño: Jabón, Shampoo, Crema'],
                ['name' => 'Hardware store', 'name_es' => 'Ferretería'],
                ['name' => 'Hotel equipment and utensils', 'name_es' => 'Equipos y utensilios hoteleros'],
                ['name' => 'Refrigerating Equipment', 'name_es' => 'Equipos Frigoríficos'],
                ['name' => 'Air Conditioning Equipment', 'name_es' => 'Equipos de Climatización'],
                ['name' => 'Pool & Jacuzzis Equipment', 'name_es' => 'Equipos para Piscina y Jacuzzis'],
                ['name' => 'Sewage treatment plants equipment', 'name_es' => 'Equipos para plantas de tratamiento'],
                ['name' => 'Electric generators', 'name_es' => 'Generadores eléctricos'],
                ['name' => 'Electrical Devices', 'name_es' => 'Dispositivos Eléctricos'],
                ['name' => 'Sound Equipment', 'name_es' => 'Equipos de Sonido'],
                ['name' => 'Office Equipment', 'name_es' => 'Equipos de oficina'],
                ['name' => 'Cleaning and disinfection chemicals', 'name_es' => 'Químicos para limpieza y desinfección'],
                ['name' => 'Laundry Chemicals', 'name_es' => 'Químicos para lavandería'],
                ['name' => 'Chemicals for Kitchen', 'name_es' => 'Químicos para Cocina'],
                ['name' => 'Pool Chemist', 'name_es' => 'Químico de piscina'],
            ],
        ],
        [
            'name' => 'Services',
            'name_es' => 'Servicios',
            'children' => [
                ['name' => 'Consultancies', 'name_es' => 'Asesorías'],
                ['name' => 'Training', 'name_es' => 'Capacitación'],
                ['name' => 'Touristic tour', 'name_es' => 'Tour turístico'],
                ['name' => 'Advertising services: graphic art, printing, business cards', 'name_es' => 'Servicios publicitarios: arte grafica, imprenta, tarjetas de presentación'],
                ['name' => 'Repair and Maintenance of Equipment', 'name_es' => 'Reparación y Mantenimiento de Equipos'],
                ['name' => 'Construction and remodeling', 'name_es' => 'Construcción y remodelaciones'],
                ['name' => 'Decoration and Painting', 'name_es' => 'Decoración y Pintura'],
                ['name' => 'Systems and telecommunications', 'name_es' => 'Sistemas y telecomunicaciones'],
                ['name' => 'Microbiological Laboratories', 'name_es' => 'Laboratorios Microbiológicos'],
                ['name' => 'Wastewater treatment plants: Operation', 'name_es' => 'Operación de Plantas de Tratamiento'],
                ['name' => 'Artists: Music Bands, Dance Group', 'name_es' => 'Artistas: Bandas musicales, Grupo de baile'],
                ['name' => 'Security (fire, cameras, guards)', 'name_es' => 'Seguridad (Incendio, cámaras, guardias)'],
                ['name' => 'Real estate', 'name_es' => 'Bienes Raíces'],
                ['name' => 'Tourist and personnel transport', 'name_es' => 'Transporte turístico y de personal'],
                ['name' => 'Taxi Service', 'name_es' => 'Servicio de Taxis'],
                ['name' => 'Equipment and tools rent', 'name_es' => 'Renta de Equipos y herramientas'],
                ['name' => 'Fuel: LPG, Gasoline, Diesel', 'name_es' => 'Combustible: Gas LP, Gasolina, Diesel'],
                ['name' => 'Cable TV & closed circuit service', 'name_es' => 'Servicio de cable y circuito cerrado'],
            ],
        ],
        [
            'name' => 'Complementary Services',
            'name_es' => 'Servicios Complementarios',
            'children' => [
                [
                  'name' => 'Shipping Services',
                  'name_es' => 'Servicios de Envíos',
                  'children' => [
                        ['name' => 'Local Shipments', 'name_es' => 'Envíos Locales'],
                        ['name' => 'National shipments', 'name_es' => 'Envíos Nacionales'],
                        ['name' => 'International Shipments', 'name_es' => 'Envíos Internacionales'],
                    ]
                ],
                [
                    'name' => 'Financial Services',
                    'name_es' => 'Servicios Financieros',
                    'children' => [
                          ['name' => 'Financial Services', 'name_es' => 'Servicios Financieros']
                      ]
                  ],
                  [
                    'name' => 'Contracts',
                    'name_es' => 'Contratos',
                    'children' => [
                          ['name' => 'Annual Contracts', 'name_es' => 'Contratos Anuales'],
                          ['name' => 'Temporary Contract', 'name_es' => 'Contratos temporales'],
                          ['name' => 'Outsourcing', 'name_es' => 'Sub-contratos'],
                          ['name' => 'Professional Services', 'name_es' => 'Servicios Profesionales'],
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
        factory(Role::class, 1)->create([ //subadmin
            'name' => 'subadmin',
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
            'pending' => 0,
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
            'pending' => 0,
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
            ['country_id' => $country->id, 'user_id' => $admin->id]
        );

        $partner = factory(User::class, 1)->create()->first(); // partner

        $profile = factory(Profile::class, 1)->create([
            'user_id' => $partner->id,
        ]);
        $company = factory(Company::class, 1)->create([
            'activity' => 2
        ])->first();

        \DB::table('company_country')->insert(
            ['country_id' => $country->id, 'company_id' => $company->id]
        );
        \DB::table('country_user')->insert(
            ['country_id' => $country->id, 'user_id' => $partner->id]
        );

        $user = factory(User::class, 1)->create()->first();

        $user->AddToCompany($company);
        $partner->AddToCompany($company);

        \DB::table('country_user')->insert(
            ['country_id' => $country->id, 'user_id' => $user->id]
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
