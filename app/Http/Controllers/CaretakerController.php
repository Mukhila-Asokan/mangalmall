<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{GuestCaretaker, Caretaker, GuestContact};
use App\Rules\CaretakerCheck;
use Illuminate\Support\Facades\Validator;
use DB;

class CaretakerController extends Controller
{
    public function createCaretaker(Request $request){
        DB::beginTransaction();
        try{
            $validator = Validator::make($request->all(), [
                'selected_guests' => ['required', new CaretakerCheck(json_decode($request->selected_guests))],
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
                $caretaker = Caretaker::where('id', $request->caretaker_id);
            }
            $guestIds = json_decode($request->selected_guests);
            foreach($guestIds as $guestId){
                $guestCaretaker = new GuestCaretaker;
                $guestCaretaker->caretaker_id = $caretaker->id;
                $guestCaretaker->guest_id = $guestId;
                $guestCaretaker->created_by = auth()->user()->id;
                $guestCaretaker->save();
            }
            DB::Commit();
            return redirect()->back()->with('success', 'Guests assigned to caretaker successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function listCaretaker(){
        $caretakers = Caretaker::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->get();
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
}
