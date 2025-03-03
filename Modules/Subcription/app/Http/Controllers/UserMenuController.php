<?php

namespace Modules\Subcription\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Subcription\Models\UserMenu;
use Illuminate\Support\Facades\Validator;
use Session;

class UserMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "UserMenu";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "User Menu";
        $usermenu = UserMenu::where('delete_status', '0')->paginate(10);
        return view('subcription::usermenu.index', compact('pagetitle', 'pageroot', 'usermenu', 'username'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "UserMenu";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "User Menu";
        $menus = UserMenu::where('delete_status', '0')->get();
        return view('subcription::usermenu.create', compact('pagetitle', 'pageroot', 'username', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menuname' => 'required|unique:usermenu',          
            'sortorder' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $usermenu = new UserMenu();
            $usermenu->menuname = $request->menuname;
            $usermenu->icon = $request->icon;
            $usermenu->parentid = $request->parentid ?? 0;
            $usermenu->sortorder = $request->sortorder;
            $usermenu->status = 'Active';
            $usermenu->delete_status = 0;
            $usermenu->save();
            return redirect('admin/subscription/usermenu')->with('success', 'User Menu added successfully.');
        } catch (\Exception $e) {
            return redirect('admin/subscription/usermenu')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('subcription::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageroot = "UserMenu";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Edit User Menu";
        $menus = UserMenu::where('delete_status', '0')->get();
        $usermenu = UserMenu::findOrFail($id);
        return view('subcription::usermenu.edit', compact('pagetitle', 'pageroot', 'username', 'menus', 'usermenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'menuname' => 'required|unique:usermenu,menuname,' . $id,          
            'sortorder' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $usermenu = UserMenu::findOrFail($id);
            $usermenu->menuname = $request->menuname;
            $usermenu->icon = $request->icon;
            $usermenu->parentid = $request->parentid ?? 0;
            $usermenu->sortorder = $request->sortorder;
            $usermenu->status = 'Active';
            $usermenu->delete_status = 0;
            $usermenu->save();
            return redirect('admin/subscription/usermenu')->with('success', 'User Menu updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/subscription/usermenu')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $usermenu = UserMenu::find($id);
            $usermenu->delete_status = 1;
            $usermenu->save();
            return redirect('admin/subscription/usermenu')->with('success', 'User Menu deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/subscription/usermenu')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $usermenu = UserMenu::find($id);
        if (!$usermenu) {
            return redirect('admin/subscription/usermenu')->with('error', 'User Menu not found.');
        }
        $usermenu->status = ($usermenu->status === 'Active') ? 'Inactive' : 'Active';
        $usermenu->save();

        return redirect('admin/subscription/usermenu')->with('success', 'User Menu status successfully updated.');
    }
}
