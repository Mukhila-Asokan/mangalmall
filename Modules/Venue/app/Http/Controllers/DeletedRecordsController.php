<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Modules\Venue\Models\Menu;
class DeletedRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagetitle = "Deleted Records";
        $pageroot = "Venue";
        $deletedMenus = Menu::where('delete_status', 0)->paginate(20);
        return view('venue::deletedrecords.index', compact('pagetitle', 'pageroot', 'deletedMenus'));      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venue::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        return view('venue::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
