<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;
class VenueTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "Venue Category";
         $pageroot = "Venue";
         return view('venue::venuetype.list', compact('pagetitle','pageroot','username'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "Venue Category";
         $pageroot = "Venue";
        return view('venue::venuetype.create',compact('pagetitle','pageroot','username'));
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
    public function show()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Category";
        $pageroot = "Venue";
       
        return view('venue::venuetype.show',compact('pagetitle','pageroot','username'));
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
