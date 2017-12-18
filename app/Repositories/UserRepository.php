<?php namespace App\Repositories;


use App\Role;
use App\User;


class UserRepository extends DbRepository{


    /**
     * Construct
     * @param User $model
     */
    function __construct(User $model)
    {
        $this->model = $model;
        $this->limit = 10;
    }

    /**
     * save a user
     * @param $data
     */
    public function store($data)
    {
        
        $data = $this->prepareData($data);
        
        $user = $this->model->create($data);

        $role = (isset($data['role'])) ? $data['role'] : Role::whereName('user')->first();
        
        $user->assignRole($role);
        

        $user->profile()->create($data);
        
        if( $role->name == 'partner'){
            $company = $user->companies()->create($data);
            $company->countries()->attach($data['country']);
           
            
            if(isset($data['sectors'])){
                
                $company->sectors()->sync($data['sectors']);

                $shippingSectors = array_where($data['sectors'], function ($value, $key) {
                    return $value == 56 || $value == 57 || $value == 58 || $value == 59;
                });
                $creditSectors = array_where($data['sectors'], function ($value, $key) {
                    return $value == 60 || $value == 61 || $value == 62 || $value == 63;
                });

              

                if($shippingSectors){

                    $roleShipping =  Role::whereName('shipping')->first();
                    $user->assignRole($roleShipping);
                }

                 if($creditSectors){

                    $roleCredit =  Role::whereName('credit')->first();
                    $user->assignRole($roleCredit);
                    $company->generateDefaultInterests();

                }
        
               
               
            }

            $company->generatePublicCode();
        }

        if(isset($data['country']))
            $user->countries()->attach($data['country']);

        
        $user->generatePublicCode();
       
        return $user;
    }

   

    /**
     * Update a user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function update($id, $data)
    {
        $user = $this->model->findOrFail($id);
        $data = $this->prepareData($data);
  
        $user->fill($data);

        $user->save();

        $user->profile->fill($data);
        $user->profile->save();


       if(isset($data['role']))
            $user->assignRole($data['role']);

       if(isset($data['country']))
           $user->countries()->sync($data['country']);
            
        $user->generatePublicCode();

        return $user;
    }


    private function prepareData($data)
    {
        
        if(empty($data['password']))
           return $data = array_except($data, array('password'));

        $data['password'] = bcrypt($data['password']);


        return $data;
    }


}