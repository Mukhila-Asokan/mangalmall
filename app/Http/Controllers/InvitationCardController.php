<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OccasionType;
use App\Models\InvitationCardSize;
use Svg\Tag\Rect;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTemplate;
use App\Models\UserImage;
use App\Models\ThemeSetting;
use Modules\Invitation\Models\CardTemplate;

class InvitationCardController extends Controller
{
    public function index()
    {
        $occasionTypes  = OccasionType::where('delete_status','0')->get();  
        $invitationCardSizes = InvitationCardSize::where('delete_status','0')->get();
        return view('invitation.card.index',compact('occasionTypes','invitationCardSizes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'template_name' => 'required',
            'cat_id' => 'required',
            'template_size' => 'required',         
        ]);

        $userID = Auth::user()->id;
     
        
        $themeSettings = ThemeSetting::all();
        $suggestionCategories = OccasionType::all();

        $usertemplate = new UserTemplate();
        $usertemplate->template_name = $request->template_name;
        $usertemplate->campaign_id = 1;
        $usertemplate->user_id = $userID;
        $usertemplate->occasion_id = (int)$request->cat_id;
        $usertemplate->template_size = $request->template_size;
        $usertemplate->datetime = now()->toDateTimeString();
        $usertemplate->modifydate = now()->toDateTimeString();
        $usertemplate->status = 1;
        $usertemplate->template_custom_size = $request->template_custom_size ?? null;
        
        // Missing required columns
        $usertemplate->template_data = $request->template_data ?? '';
        $usertemplate->gradient_background = $request->gradient_background ?? '';
        $usertemplate->thumb = $request->thumb ?? '';
        $usertemplate->save_as_template = $request->save_as_template ?? 0;
        $usertemplate->access_level = $request->access_level ?? 0;
        $usertemplate->template_access_leavel = $request->template_access_leavel ?? 0;
        
        $usertemplate->save();


        $template_id = $usertemplate->id;
        $campaign_id = 1;
        $template = CardTemplate::where('id', $template_id)->first();
        $images = UserImage::where('user_id', $userID)->orderBy('id', 'DESC')->limit(21)->get();
        return view('cardeditior.index', compact('images', 'template', 'themeSettings', 'suggestionCategories', 'template_id', 'campaign_id'));
      
    }
}
