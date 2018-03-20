<?php

namespace App\Http\Controllers\Superadmin;

use App\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authByRole:superadmin');
    }

    public function create()
    {
        //if (!auth()->user()->hasPermission('create_countries')) return redirect('/');
        $sectors = Sector::all();
        //Sector::withDepth()->having('depth', '=', 0)->get();
        //Sector::all();//->toTree();

        return view('superadmin.sectors.create', compact('sectors'));
    }

    public function store()
    {
        $this->validate(
            request(),
            [
            'name' => 'required|string|max:255',
        ]
        );

        $sector = Sector::create(request()->all());

        flash('Sector Saved', 'success');

        return redirect('/superadmin/sectors/create');
    }

    public function index()
    {
        //if (!auth()->user()->hasPermission('create_countries')) return redirect('/');

        $search['q'] = request('q');

        $sectors = Sector::withDepth()->search($search['q'])->defaultOrder()->paginate(10);

        return view('superadmin.sectors.index', compact('search', 'sectors'));
    }

    /**
    * Mostrar vista de editar informacion basica del medico
    */
    public function edit(Sector $sector)
    {
        //if (!auth()->user()->hasPermission('create_countries')) return redirect('/');
        $sectors = Sector::all();

        return view('superadmin.sectors.edit', compact('sector', 'sectors'));
    }

    public function update($id)
    {
        $this->validate(
            request(),
            [
            'name' => 'required|string|max:255',
        ]
        );

        $sector = Sector::find($id);
        $sector->fill(request()->all());
        $sector->save();

        flash('Sector updated', 'success');

        return redirect('/superadmin/sectors/' . $id . '/edit');
    }

    /**
     * Eliminar consulta(cita)
     */
    public function delete($id)
    {
        $sector = Sector::find($id)->delete();

        flash('Sector Deleted', 'success');

        return back();
    }
}
