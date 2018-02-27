<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Country;
use App\Company;
use App\Role;
use App\Sector;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Mail\NewUserActivate;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('authByRole:admin');
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        if (!auth()->user()->hasPermission('create_users')) {
            return redirect('/');
        }

        $search['q'] = request('q');

        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'partner')
             ->orWhere('name', 'admin')
             ->orWhere('name', 'user');
        });

        $users = $users->whereHas('countries', function ($q) {
            $q->where('id', auth()->user()->countries->first()->id);
        });

        $users = $users->search($search['q'])->paginate(10);

        return view('admin.users.index', compact('users', 'search'));
    }

    public function create()
    {
        if (!auth()->user()->hasPermission('create_users')) {
            return redirect('/');
        }

        $roles = Role::where(function ($q) {
            $q->where('name', 'admin');
        })->get();

        $permissions = Permission::where(function ($q) {
            $q->where('name', 'view_commissions')
                ->orWhere('name', 'view_all_trans_company')
                ->orWhere('name', 'create_users');
        })->get();

        return view('admin.users.create', compact('roles', 'permissions'));
    }

    public function store()
    {
        $this->validate(request(), [
            'applicant_name' => 'required|string|max:255',
            'first_surname' => 'required|string|max:255',
            'second_surname' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required|string|min:6',
            'role' => 'required',
        ]);
        $data = request()->all();
        $data['role'] = Role::where('id', $data['role'])->first();
        $data['country'] = auth()->user()->countries->first()->id;

        $user = $this->userRepo->store($data);

        $user->permissions()->sync(request('permissions'));

        flash('User Saved', 'success');

        return redirect('/admin/users');
    }

    /**
    * Mostrar vista de editar informacion basica del medico
    */
    public function edit(User $user)
    {
        if (!auth()->user()->hasPermission('create_users')) {
            return redirect('/');
        }

        if ($user->countries->first()->id != auth()->user()->countries->first()->id) { //si el usuario a editar no es del mismo pais que el admin del pais sacarlo
            return Redirect('/admin/users');
        }

        $roles = Role::where(function ($q) {
            $q->where('name', 'partner')
              ->orWhere('name', 'user');
        })->get();

        $permissions = Permission::where(function ($q) {
            $q->where('name', 'view_commissions')
                ->orWhere('name', 'view_all_trans_company')
                ->orWhere('name', 'create_users');
        })->get();

        $sectors = Sector::get()->toTree();

        return view('admin.users.edit', compact('user', 'roles', 'sectors', 'permissions'));
    }

    public function update($id)
    {
        $this->validate(
             request(),
             [
             'applicant_name' => 'required|string|max:255',
             'first_surname' => 'required|string|max:255',
             'second_surname' => 'required|string|max:255',
             //'position_held' => 'required|string|max:255',
             'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
             'role' => 'required',
         ]
      );

        $user = $this->userRepo->update($id, request()->all());

        flash('User Updated', 'success');

        return Redirect('/admin/users');
    }

    /**
     * Actualizar informacion basica del medico
     */
    public function updatePermissions(User $user)
    {
        $user->permissions()->sync(request('permissions'));

        flash('Cuenta Actualizada', 'success');

        return back();
    }

    public function updateCompany(Company $company)
    {
        $this->validate(
             request(),
             [
                     'activity' => 'required',
                     'phones' => 'required|string|max:255',
                     'physical_address' => 'required|string|max:255',
                     'country' => 'required',
                     'towns' => 'required|string|max:255',
                     'web_address' => 'required|string|max:255',
                     'legal_name' => 'required|string|max:255',
                     'legal_first_surname' => 'required|string|max:255',
                     'legal_second_surname' => 'required|string|max:255',
                     'legal_email' => 'required|string|email|max:255',
                 ]
             );

        $data = request()->all();
        $company->fill($data);
        $company->save();

        $company->countries()->sync($data['country']);
        if (isset($data['sectors'])) {
            $company->sectors()->sync($data['sectors']);
        }

        flash('Company Updated', 'success');

        return redirect()->back();
    }

    /**
     * Active a user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function active(User $user)
    {
        $user->active = 1;
        $user->save();
        // $this->userRepo->update_active($id, 1);
        try {
            \Mail::to($user)->send(new NewUserActivate($user));
        } catch (\Swift_TransportException $e) {  //Swift_RfcComplianceException
            \Log::error($e->getMessage());
        }

        return Redirect('/admin/users');
    }

    /**
     * Inactive a user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function inactive(User $user)
    {
        $user->active = 0;
        $user->save();

        return Redirect('/admin/users');
    }

    /**
     * Eliminar consulta(cita)
     */
    public function delete($id)
    {
        $user = $this->userRepo->destroy($id);

        flash('User Deleted', 'success');

        return back();
    }
}
