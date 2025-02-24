<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Invitation\Models\InvitationCardThickness;
use Session;


class InvitationCardThicknessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Card Thickness";
        $cardThickness = InvitationCardThickness::where('delete_status', '0')->paginate(10);
        return view('invitation::cardthickness.index', compact('pageroot', 'username', 'pagetitle', 'cardThickness'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Card Thickness";
        return view('invitation::cardthickness.create', compact('pagetitle', 'pageroot', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cardthickness' => 'required|string|max:255|unique:invitationcardthickness',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        try {
            $cardThickness = new InvitationCardThickness();
            $cardThickness->cardthickness = $request->input('cardthickness');
            $cardThickness->status = 'Active';
            $cardThickness->delete_status = 0;
            $cardThickness->save();
            return redirect('admin/invitation/cardthickness')->with('success', 'Invitation Card Thickness created successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/cardthickness')->with('error', $e->getMessage());
        }
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
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Card Thickness";
        $cardThickness = InvitationCardThickness::find($id);
        if (!$cardThickness) {
            return redirect('admin/invitation/cardthickness')->with('error', 'Invitation Card Thickness not found.');
        }
        return view('invitation::cardthickness.edit', compact('pagetitle', 'pageroot', 'username', 'cardThickness'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cardthickness' => 'required|string|max:255|unique:invitationcardthickness,cardthickness,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        try {
            $cardThickness = InvitationCardThickness::find($id);
            if (!$cardThickness) {
            return redirect('admin/invitation/cardthickness')->with('error', 'Invitation Card Thickness not found.');
            }
            $cardThickness->cardthickness = $request->input('cardthickness');
            $cardThickness->status = 'Active';
            $cardThickness->delete_status = 0;
            $cardThickness->save();
            return redirect('admin/invitation/cardthickness')->with('success', 'Invitation Card Thickness updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/cardthickness')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cardThickness = InvitationCardThickness::find($id);
            if (!$cardThickness) {
            return redirect('admin/invitation/cardthickness')->with('error', 'Invitation Card Thickness not found.');
            }
            $cardThickness->delete_status = 1;
            $cardThickness->save();
            return redirect('admin/invitation/cardthickness')->with('success', 'Invitation Card Thickness deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/cardthickness')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $cardThickness = InvitationCardThickness::find($id);
        if (!$cardThickness) {
            return redirect('admin/invitation/cardthickness')->with('error', 'Invitation Card Thickness not found.');
        }
        $cardThickness->status = ($cardThickness->status === 'Active') ? 'Inactive' : 'Active';
        $cardThickness->save();

        return redirect('admin/invitation/cardthickness')->with('success', 'Invitation Card Thickness status successfully updated.');
    }
}
