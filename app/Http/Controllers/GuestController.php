<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{GuestContact, GuestGroup, GuestGroupContact, GuestCaretaker};
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuestImport;
use DB;
use Carbon\Carbon;
use App\Models\Caretaker;

class GuestController extends Controller
{
    public function getGuestContacts(){
        $guests = GuestContact::whereNull('deleted_at')->where('created_by', auth()->user()->id)->orderBy('created_at', 'desc');
        $getGuestContacts = $guests->take(30)->get();
        $guests = $guests->get();
        $caretakers = Caretaker::where('created_by', auth()->user()->id)->get();
        $groups = GuestGroup::where('created_by', auth()->user()->id)->get();
        $assignedGuestIds = GuestCaretaker::where('created_by', auth()->user()->id)->pluck('guest_id')->toArray();
        $unAssignedGuests = GuestContact::whereNotIn('id', $assignedGuestIds)->where('created_by', auth()->user()->id)->get();
        return view('guest.index', compact('getGuestContacts', 'caretakers', 'guests', 'groups', 'unAssignedGuests'));
    }

    public function getGuestContactsAjax(Request $request){
        $getGuestContacts = GuestContact::whereNull('deleted_at')->where('created_by', auth()->user()->id)->skip($request->count)->take(30)->get();
        return response()->json([
            'status' => 'success',
            'data' => $getGuestContacts
        ]);
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
            $storeGuest->relationship = $request->relationship;
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
            $updateGuest->relationship = $request->edit_relationship;
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

    public function deleteGuest(Request $request){
        DB::beginTransaction();
        try{
            $deleteGuest = GuestContact::where('id', $request->id)->first();
            $deleteGuest->deleted_at = Carbon::now();
            $deleteGuest->save();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Guest Contact deleted successfully'
            ]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function searchGuest(Request $request){
        $search = $request->value;
        try{
            $getGuestContacts = GuestContact::where('name', 'LIKE', "%{$search}%")
                    ->orWhere('mobile_number', 'LIKE', "%{$search}%")
                    ->orWhere('whatsapp_number', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%")
                    ->orderBy('created_at', 'desc')
                    ->get();
            return response()->json([
                'status' => 'success',
                'html' => view('guest.guest_list', compact('getGuestContacts'))->render()
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function downloadGuestFormat(){
        return response()->download(public_path('/guest/guest_format.xlsx'));
    }

    public function uploadGuestContacts(Request $request){
        DB::beginTransaction();
        try{
            Excel::import(new GuestImport, $request->file('upload_guest_details'));
            DB::commit();
            return redirect()->back()->with('success', 'Guest Contact uploaded successfully');
        }
        catch(\Exception $ex){
            DB::rollback();
            \Log::info($ex);
            return response()->json(['data'=>'Some error has occur.',400]);

        }
    }

    public function getGuestGroupContacts(){
        $id = auth()->user()->id;
        $guestGroups = GuestGroup::where('created_by', $id)->orderBy('created_at', 'desc')->take(30)->get();
        return view('guest.group.index', compact('guestGroups'));
    }

    public function createGuestGroup(Request $request){
        DB::beginTransaction();
        try{
            if($request->group_name == 'add new'){
                $createGroup = new GuestGroup;
                $createGroup->group_name = $request->new_group_name;
                $createGroup->group_description = $request->group_description;
                $createGroup->created_by = auth()->user()->id;
                $createGroup->save();

                foreach($request->guest_lists as $data){
                    $createGroupContact = new GuestGroupContact();
                    $createGroupContact->group_id = $createGroup->id;
                    $createGroupContact->guest_id = $data;
                    $createGroupContact->created_by = auth()->user()->id;
                    $createGroupContact->save();
                }
            }
            else{
                $createGroup = GuestGroup::where('id', $request->group_name)->first();
                $createdGuests = GuestGroupContact::where('group_id', $createGroup->id)->pluck('guest_id')->toArray();
                foreach($request->guest_lists as $data){
                    if(!in_array($data, $createdGuests)){
                        $createGroupContact = new GuestGroupContact();
                        $createGroupContact->group_id = $createGroup->id;
                        $createGroupContact->guest_id = $data;
                        $createGroupContact->created_by = auth()->user()->id;
                        $createGroupContact->save();
                    }
                }
            }
            DB::commit();
            return redirect()->route('guest.group.index')->with('success', 'Group Created Successfully');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function editGuestGroup($id){
        $guestGroup = GuestGroup::where('id', $id)->first();
        $guestIds = GuestGroupContact::with('contact')->where('group_id', $id)->pluck('guest_id')->toArray();
        $guestGroupContacts = GuestContact::whereNull('deleted_at')->where('created_by', auth()->user()->id)->whereIn('id', $guestIds)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'guestGroup' => $guestGroup,
            'guestGroupContacts' => $guestGroupContacts,
        ]);
    }

    public function updateGuestGroup(Request $request){
        DB::beginTransaction();
        try{
            // $guestIds = GuestGroupContact::with('contact')->where('group_id', $request->id)->count();
            // if($guestIds == $request->length){
            //     $deleteGroupContacts = GuestGroupContact::where('group_id', $id)->delete();
            // }
            $deleteGroupContacts = GuestGroupContact::where('group_id', $request->id)->whereIn('guest_id', $request['selected_guests'])->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Group updated successfully'
            ]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function updateGuestGroupText(Request $request){
        DB::beginTransaction();
        try{
            $guestGroup = GuestGroup::where('id', $request->id)->first();
            $guestGroup->group_name = $request->name;
            $guestGroup->group_description = $request->desc;
            $guestGroup->save();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Group updated successfully'
            ]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function searchGuestGroup(Request $request){
        $search = $request->value;
        try{
            $guestGroups = GuestGroup::where('group_name', 'LIKE', "%{$search}%")
                    ->orWhere('group_description', 'LIKE', "%{$search}%")
                    ->orderBy('created_at', 'desc')
                    ->get();
            return response()->json([
                'status' => 'success',
                'html' => view('guest.group.group_list', compact('guestGroups'))->render()
            ]);
        }
        catch(\Exception $e){
            dd($e);
            return response()->json([
                'status' => 'error',
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function getNewGroupGuest(Request $request){
        $id = $request->id;
        $guestIds = GuestGroupContact::with('contact')->where('group_id', $id)->pluck('guest_id')->toArray();
        $guestNewContacts = GuestContact::whereNull('deleted_at')->where('created_by', auth()->user()->id)->whereNotIn('id', $guestIds)->orderBy('created_at', 'desc')->take(30)->get();
        return response()->json($guestNewContacts);
    }

    public function addGuestInGroup(Request $request){
        DB::beginTransaction();
        try{
            $group = GuestGroup::where('id', $request->groupId)->first();
            if($group){
                foreach($request->selectedGuests as $data){
                    $createGroupContact = new GuestGroupContact();
                    $createGroupContact->group_id = $group->id;
                    $createGroupContact->guest_id = $data;
                    $createGroupContact->created_by = auth()->user()->id;
                    $createGroupContact->save();
                }
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Group updated successfully'
            ]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function deleteGuestGroup(Request $request){
        DB::beginTransaction();
        try{
            $groupGuestDelete = GuestGroupContact::where('group_id', $request->id)->delete();
            $groupDelete = GuestGroup::where('id', $request->id)->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Group deleted successfully'
            ]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function getGuestGroupAjax(Request $request){
        $getGuestContacts = GuestGroup::where('created_by', auth()->user()->id)->orderBy('created_at', 'desc')->skip($request->count)->take(30)->get();
        return response()->json([
            'status' => 'success',
            'data' => $getGuestContacts
        ]);
    }

    public function checkUniqueGuests(Request $request){
        if($request->id){
            $exists = GuestContact::where($request->field, $request->value)->where('id', '!=', $request->id)->exists();
        }
        else{
            $exists = GuestContact::where($request->field, $request->value)->exists();
        }
        return response()->json(['exists' => $exists]);
    }

    public function checkUniqueGroup(Request $request){
        $exists = GuestGroup::where($request->field, $request->value)->exists();
        return response()->json(['exists' => $exists]);
    }
}
