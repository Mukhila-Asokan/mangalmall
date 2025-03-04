<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuestContact;
use DB;

class GuestController extends Controller
{
    public function getGuestContacts(){
        $getGuestContacts = GuestContact::whereNull('deleted_at')->where('created_by', auth()->user()->id)->get();
        return view('guest.index', compact('getGuestContacts'));
    }

    public function storeGuest(Request $request){
        DB::beginTransaction();
        try{
            $storeGuest = new GuestContact();
            $storeGuest->name = $request->name;
            $storeGuest->location = $request->location;
            $storeGuest->whatsapp_number = $request->whatsapp_number;
            $storeGuest->mobile_number = $request->mobile_number;
            $storeGuest->email = $request->email;
            $storeGuest->company = $request->company;
            $storeGuest->designation = $request->designation;
            $storeGuest->notes = $request->notes;
            $storeGuest->created_by = auth()->user()->id;
            $storeGuest->save();
            DB::commit();
            return redirect()->back()->with('success', 'Guest Contact added successfully');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function editGuest(Request $request){
        try{
            $editGuest = GuestContact::where('id', $request->id)->first();
            return response()->json([
                'status' => 'success',
                'data' => $editGuest
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function updateGuest(Request $request){
        DB::beginTransaction();
        try{
            $updateGuest = GuestContact::where('id', $request->contact_id)->first();
            $updateGuest->name = $request->edit_name;
            $updateGuest->location = $request->edit_location;
            $updateGuest->whatsapp_number = $request->edit_whatsapp_number;
            $updateGuest->mobile_number = $request->edit_mobile_number;
            $updateGuest->email = $request->edit_email;
            $updateGuest->company = $request->edit_company;
            $updateGuest->designation = $request->edit_designation;
            $updateGuest->notes = $request->edit_notes;
            $updateGuest->created_by = auth()->user()->id;
            $updateGuest->save();
            DB::commit();
            return redirect()->back()->with('success', 'Guest Contact updated successfully');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
