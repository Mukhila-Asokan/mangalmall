<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{GuestCaretaker, Caretaker, GuestContact, GuestGroup};
use App\Rules\CaretakerCheck;
use Illuminate\Support\Facades\Validator;
use App\Mail\CaretakerCreateMail;
use Illuminate\Support\Facades\Mail;
use DB;

class CaretakerController extends Controller
{
    public function createCaretaker(Request $request){
        DB::beginTransaction();
        try{
            $validator = Validator::make($request->all(), [
                'selected_guests' => ['required', new CaretakerCheck($request->selected_guests)],
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if($request->caretaker_id == 'add new'){
                $caretaker = new Caretaker;
                $caretaker->name = $request->caretaker_name;
                $caretaker->email = $request->caretaker_email;
                $caretaker->mobile_number = $request->caretaker_mobile;
                $caretaker->created_by = auth()->user()->id;
                $caretaker->save();
            }
            else{
                $caretaker = Caretaker::where('id', $request->caretaker_id)->first();
            }
            $guestIds = $request->selected_guests;
            foreach($guestIds as $guestId){
                $guestCaretaker = new GuestCaretaker;
                $guestCaretaker->caretaker_id = $caretaker->id;
                $guestCaretaker->guest_id = $guestId;
                $guestCaretaker->created_by = auth()->user()->id;
                $guestCaretaker->save();
            }
            $this->mailGenerate('add', $caretaker->id);
            DB::Commit();
            return redirect()->route('list.caretaker')->with('success', 'Guests assigned to caretaker successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function createCaretakerGuests(Request $request){
        DB::beginTransaction();
        try{
            $validator = Validator::make($request->all(), [
                'selected_contacts' => ['required', new CaretakerCheck(json_decode($request->selected_contacts))],
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $caretaker = Caretaker::where('id', $request->caretaker_id)->first();
            foreach($request->selected_contacts as $guestId){
                $guestCaretaker = new GuestCaretaker;
                $guestCaretaker->caretaker_id = $caretaker->id;
                $guestCaretaker->guest_id = $guestId;
                $guestCaretaker->created_by = auth()->user()->id;
                $guestCaretaker->save();
            }
            $this->mailGenerate('update', $caretaker->id);
            DB::commit();
            return redirect()->back()->with('success', 'Guests assigned to caretaker successfully');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function listCaretaker(){
        $caretakers = Caretaker::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->limit(30)->get();
        return view('guest.caretaker.list', compact('caretakers'));
    }

    public function listGuestCaretaker(){
        try{
            $caretakerGuests = GuestCaretaker::where('created_by', auth()->user()->id)->pluck('guest_id')->toArray();
            $guestList = GuestContact::where('created_by', auth()->user()->id)->whereNotIn('id', $caretakerGuests)->orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'guestList' => $guestList
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function editCaretaker($id){
        $caretaker = Caretaker::where('created_by', auth()->user()->id)->where('id', $id)->first();
        $guestCaretakers = GuestCaretaker::with('contact')->where('created_by', auth()->user()->id)->where('caretaker_id', $id)->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'guestCaretakers' => $guestCaretakers,
            'caretaker' => $caretaker
        ]);
    }

    public function updateCaretaker(Request $request){
        DB::beginTransaction();
        try{
            $deleteGroupContacts = GuestCaretaker::where('caretaker_id', $request->id)->whereIn('guest_id', $request['selected_guests'])->delete();
            $this->mailGenerate('update', $caretaker->id);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => "Caretaker's details updated successfully'"
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

    public function deleteCaretaker(Request $request){
        DB::beginTransaction();
        try{
            $deleteGuests = GuestCaretaker::where('caretaker_id', $request->id)->where('created_by', auth()->user()->id)->delete();
            $deleteCaretaker = Caretaker::where('id', $request->id)->where('created_by', auth()->user()->id)->delete();
            DB::Commit();
            return response()->json([
                'status' => 'success',
                'message' => "Caretaker's deleted successfully"
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

    public function listCaretakerAjax(Request $request){
        $caretakers = Caretaker::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->skip($request->count)->take(30)->get();
        return response()->json([
            'status' => 'success',
            'caretakers' => $caretakers
        ]);
    }

    public function searchCaretaker(Request $request){
        $search = $request->value;
        try{
            $caretakers = Caretaker::where('created_by', auth()->user()->id)
                                ->where(function($query) use ($search) {
                                    $query->where('name', 'LIKE', "%{$search}%")
                                        ->orWhere('mobile_number', 'LIKE', "%{$search}%")
                                        ->orWhere('email', 'LIKE', "%{$search}%");
                                })
                                ->orderBy('created_at', 'desc')
                                ->get();
            return response()->json([
                'status' => 'success',
                'html' => view('guest.caretaker.caretaker_list', compact('caretakers'))->render()
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function mailGenerate($action, $caretakerId){
        $caretaker = Caretaker::where('id', $caretakerId)->first();
        $guestCaretakers = GuestCaretaker::with('contact')->where('caretaker_id', $caretakerId)->where('created_by', auth()->user()->id)->get();
        return Mail::to($caretaker->email)->send(new CaretakerCreateMail($caretaker, $guestCaretakers, $action));
    }

    public function viewDetails(){
        $guests = GuestContact::whereNull('deleted_at')->where('created_by', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('guest.view', compact('guests'));
    }
}
