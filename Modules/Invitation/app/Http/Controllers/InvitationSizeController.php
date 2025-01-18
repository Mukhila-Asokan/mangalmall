<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invitation\Models\InvitationSize;

class InvitationSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Model";
        $invitationsize = InvitationSize::where('delete_status','0')->paginate(10);
        return view('invitation::invitationsize.index', compact('pagetitle','pageroot','invitationsize','username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invitation::create');
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
        return view('invitation::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('invitation::edit');
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
