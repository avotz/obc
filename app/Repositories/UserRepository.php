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
        $countriesArray = [];

        if(isset($data['country'])){
            
            $countriesArray = $data['country'];
            $data['country'] = json_encode($data['country']);
        }
        
        $user = $this->model->create($data);

        $role = (isset($data['role'])) ? $data['role'] : Role::whereName('user')->first();
        
        $user->assignRole($role);
        

        $user->profile()->create($data);
        
        if( $role->name == 'partner'){
            $company = $user->company()->create($data);
            $company->countries()->attach($countriesArray);
        }
       
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