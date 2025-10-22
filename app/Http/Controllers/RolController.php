<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RolController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Role::query())
                ->addColumn('action', function ($rol) {
                    $editUrl = route('roles.edit', $rol->id);
                    $deleteUrl = route('roles.destroy', $rol->id);

                    return '
                        <a href="' . $editUrl . '" class="btn btn-sm btn-info me-1"><i class="fas fa-edit me-1"></i>Editar</a>
                        <button id="delet" class="btn btn-sm btn-danger eliminar" data-id="' . $rol->id . '"><i class="fas fa-trash me-1"></i>Eliminar</button>
                        
                    ';
                })
                ->editColumn('created_at', function($row){
                    $date = Carbon::parse($row->created_at)->format('d/m/Y');
                    return $date;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        
        return redirect()->route('roles.index');
    }

    public function create()
    {
        return view('roles.create');
    }
}
