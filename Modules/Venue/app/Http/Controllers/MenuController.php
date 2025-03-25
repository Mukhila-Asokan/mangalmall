<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Modules\Venue\Models\Menu;
use Illuminate\Support\Facades\Validator;
use Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pagetitle = "Menu";
        $pageroot = "Venue Settings";
        $menus = Menu::where('delete_status', 0)->paginate(20);
        return view('admin.menu.index', compact('menus', 'pagetitle', 'pageroot'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pagetitle = "Menu";
        $pageroot = "Menu Settings";
        $menus = Menu::where('delete_status', 0)->paginate(20);
        return view('admin.menu.create', compact('pagetitle', 'pageroot', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [         
            'menuname' => 'required|unique:menu',
            'modelname' => 'required',
            'controllername' => 'required',
            'tablename' => 'required',           
            'sortorder' => 'required|integer',          
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $menu = new Menu();           
            $menu->menuname = $request->menuname;
            $menu->modelname = $request->modelname;
            $menu->controllername = $request->controllername;
            $menu->tablename = $request->tablename;
            $menu->url = $request->url ?? '';
            $menu->route = $request->route ?? '' ;
            $menu->icon = $request->icon ?? '';
            $menu->parentid = $request->parentid ? $request->parentid : 0;
            $menu->sortorder = $request->sortorder;
            $menu->status = 'Active';
            $menu->delete_status = 0;
            $menu->save();
            return redirect('admin/menu')->with('success', 'Menu added successfully.');
        } catch (\Exception $e) {
            return redirect('admin/menu')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('venue::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pagetitle = "Edit Menu";
        $pageroot = "Menu Settings";
        $menu = Menu::findOrFail($id);
        $menus = Menu::where('delete_status', 0)->paginate(20);
        return view('admin.menu.edit', compact('pagetitle', 'pageroot', 'menu', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [         
            'menuname' => 'required|unique:menu,menuname,' . $id,
            'modelname' => 'required',
            'controllername' => 'required',
            'tablename' => 'required',           
            'sortorder' => 'required|integer',          
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $menu = Menu::findOrFail($id);           
            $menu->menuname = $request->menuname;
            $menu->modelname = $request->modelname;
            $menu->controllername = $request->controllername;
            $menu->tablename = $request->tablename;
            $menu->url = $request->url ?? '';
            $menu->route = $request->route ?? '' ;
            $menu->icon = $request->icon ?? '';
            $menu->parentid = $request->parentid ? $request->parentid : 0;
            $menu->sortorder = $request->sortorder;
            $menu->status = 'Active';
            $menu->delete_status = 0;
            $menu->save();
            return redirect('admin/menu')->with('success', 'Menu updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/menu')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete_status = 1;
        $menu->save();
        return redirect('admin/menu')->with('success', 'Menu deleted successfully.');
    }
    
    public function updatestatus($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect('admin/menu')->with('error', 'Menu not found.');
        }
        $menu->status = ($menu->status === 'Active') ? 'Inactive' : 'Active';
        $menu->save();

        return redirect('admin/menu')->with('success', 'Menu status successfully updated.');
    }
}
