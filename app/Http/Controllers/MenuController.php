<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    public function index()
    {
        return view('menus.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Menu::query())
                ->addColumn('action', function ($menu) {

                    return '
                        <button class="btn btn-sm btn-info editar" data-id="' . $menu->id . '">
                            <i class="fas fa-edit me-1"></i>Editar</button>

                        <button class="btn btn-sm btn-danger eliminar" data-id="' . $menu->id . '"><i class="fas fa-trash me-1"></i>Eliminar</button>
                        
                    ';
                })
                ->rawColumns(['action']) // Necesario para renderizar HTML en la tabla
                ->make(true);
        }

        // Si no es AJAX, redirecciona (esto evita errores en acceso directo)
        return redirect()->route('menus.index');
    }

    public function addmenu(Request $request)
    {
        try {
            Menu::create([
                'nombre' => $request->nombre,
                'tipo' => $request->tipo,
                'report_id_destock' => $request->report_id_destock,
                'report_id_movil' => $request->report_id_movil,
            ]);
            return response()->json(['status' => true, 'msg' => 'Dashboard registrado']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }        
    }

    public function getMenu($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }

    public function updateMenu(Request $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);

            $menu->nombre  = $request->nombre;
            $menu->tipo  = $request->tipo;
            $menu->report_id_destock = $request->report_id_destock;
            $menu->report_id_movil = $request->report_id_movil;

            $menu->save();

            return response()->json(['status' => true, 'msg' => 'Dashboard actualizado']);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }


    public function deleteMenu($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();

            return response()->json(['status' => true, 'msg' => 'Dashboard eliminado']);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }
}
