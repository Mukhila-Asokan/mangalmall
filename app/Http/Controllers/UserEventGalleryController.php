<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{UserEventGallery, UserOccasion, EventItinerary, EventCollaborator, EventShare};
use App\Mail\{CollaborateMail, ShareMail};
use Illuminate\Support\Facades\Mail;
use App\Models\GuestContact;
use App\Models\GuestGroup;
use App\Models\GuestGroupContact;

class UserEventGalleryController extends Controller
{
    public function index(){
        try{
            $events = UserOccasion::with('occasionGallery')->where('userid', auth()->user()->id)->get();
            return view('admin.layouts.event.index_gallery', compact('events'));
        }
        catch(\Exception $e){
            dd($e);
        }
    }

    public function add($eventId){
        $event = UserOccasion::where('id', $eventId)->first();
        $eventGallery = UserEventGallery::where('event_id', $eventId)->get();
        return view('admin.layouts.event.add', compact('event', 'eventGallery', 'eventId'));
    }

    public function create(Request $request){
        try{
            $request->validate([
                'id' => 'required|exists:user_occasions,id',
                'images' => 'required',
                'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);

            if(isset($request->images)){
                foreach($request->file('images') as $file){
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = \Storage::disk('public_uploads')->putFileAs('gallery', $file, $fileName);

                    $gallery = new UserEventGallery();
                    $gallery->event_id = $request->id;
                    $gallery->gallery_image = $filePath;
                    $gallery->save();
                }
                return redirect()->route('home.event.gallery')->with('success', 'Gallery Created Successfully!');
            }
            else{
                return redirect()->back()->with('error', 'Please upload file');
            }
        }
        catch(\Exception $e){
            dd($e);
        }
    }

    public function delete(Request $request){
        $deleteImage = UserEventGallery::where('id', $request->id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Image deleted successfully!'
        ]);
    }

    public function itineraryList(){
        $events = UserOccasion::with(['occasionItinerary', 'occasionItinerary'])->get();
        return view('itinerary.list', compact('events'));
    }

    public function itineraryStore(Request $request)
    {
        try{
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'date' => 'required|date',
                'start_time' => 'required',
                'start_ampm' => 'required|string|in:AM,PM',
                'end_time' => 'required',
                'end_ampm' => 'required|string|in:AM,PM',
            ]);

            $itinerary = EventItinerary::create([
                'event_id' => $request->event_id,
                'label' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'start_time_value' => $request->start_time,
                'start_time_label' => $request->start_ampm,
                'end_time_value' => $request->end_time,
                'end_time_label' => $request->end_ampm,
            ]);

            return response()->json(['success' => true, 'itinerary' => $itinerary]);
        }
        catch(\Exception $e){
            dd($e);
        }
    }

    public function itineraryDelete($id)
    {
        $itinerary = EventItinerary::findOrFail($id);
        $itinerary->delete();

        return response()->json(['success' => true]);
    }

    public function collaborate(Request $request){
        $request->validate([
            'event_id' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|string',
            'mobile_number' => 'required'
        ]);

        $collaborate = new EventCollaborator;
        $collaborate->user_id = auth()->user()->id;
        $collaborate->event_id = $request->event_id;
        $collaborate->name = $request->name;
        $collaborate->email = $request->email;
        $collaborate->mobile_number = $request->mobile_number;
        $collaborate->save();

        $event = UserOccasion::where('id', $request->event_id)->first();

        Mail::to($collaborate->email)->send(new CollaborateMail($collaborate, $event));

        return redirect()->back()->with('success', 'Collaborator Added Successfully!');
    }

    public function share(Request $request){
        try{
            $selectedGuests = explode(',',$request->selectedGuests);
            $selectedGroups = explode(',',$request->selectedGroups);
            $selectedRelations = explode(',',$request->selectedRelations);

            $eventShare = new EventShare;
            $eventShare->user_id = auth()->user()->id;
            $eventShare->event_id = $request->event_id;
            $eventShare->selected_guests = json_encode($selectedGuests);
            $eventShare->selected_groups = json_encode($selectedGroups);
            $eventShare->selected_relations = json_encode($selectedRelations);
            $eventShare->save();

            $guests = GuestContact::whereIn('id', $selectedGuests)->pluck('id')->toArray();
            $groups = GuestGroupContact::whereIn('group_id', $selectedGroups)->pluck('guest_id')->toArray();
            $relations = GuestContact::whereIn('relationship', $selectedRelations)->pluck('id')->toArray();

            $allGuestIds = array_unique(array_merge($guests, $groups, $relations));
            $allGuestIds = array_values($allGuestIds);
            $event = UserOccasion::where('id', $request->event_id)->first();
            $eventGallery = UserEventGallery::where('event_id', $request->event_id)->get();
            $eventItinerary = EventItinerary::where('event_id', $request->event_id)->get();
            $attachments = [];
            foreach ($eventGallery as $gallery) {
                $attachments[] = storage_path('app/public/' . $gallery->gallery_image);
            }

            foreach($allGuestIds as $guestId){
                $guest = GuestContact::where('id', $guestId)->first();
                Mail::to($guest->email)->send(new ShareMail($guest, $event, $eventItinerary, $attachments));
            }
            return redirect()->back()->with('success', 'Event Shared Successfully!');
        }
        catch(\Exception $e){
            dd($e);
        }
    }
}
