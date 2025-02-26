<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\UserSubscription;
use Modules\Invitation\Models\CardTemplate;
use App\Models\UserTemplate;
use App\Models\UserImage;
use App\Models\ThemeSetting;
use App\Models\SubUser;
use App\Models\OccasionType;

use Illuminate\Routing\Controller;

class CardEditorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return Redirect::route('login')->withErrors(['error' => 'User is not authenticated']);
        }

      /*  $subscription = UserSubscription::where('user_id', $user->id)
            ->where('plan_period_end', '>', now())
            ->first();

        if (!$subscription || empty($subscription->stripe_subscription_id)) {
            Auth::logout();
            return Redirect::route('subscription.plan')->withErrors(['error' => 'Subscription expired.']);
        }*/

        return redirect()->route('dashboard');
    }

    public function edit($template_id)
    {
        $campaign_id = 1; 
        $sub_user_id = 1;
        if ($template_id && $campaign_id) {
            $user = Auth::user();
            $userID = $user->id;

            if (!empty($sub_user_id)) {
                $subUser = SubUser::where('parent_user_id', $userID)->where('sub_user_id', $sub_user_id)->where('status', 1)->first();
                if ($subUser) {
                    $userID = $sub_user_id;
                }
            }

            $images = UserImage::where('user_id', $userID)->orderBy('id', 'DESC')->limit(21)->get();
            $template = CardTemplate::where('id', $template_id)->first();
            $themeSettings = ThemeSetting::all();
            $suggestionCategories = OccasionType::all();

            if (!$template) {
                return redirect()->route('dashboard');
            }

           // dd($images, $template, $themeSettings, $suggestionCategories, $template_id, $campaign_id);

            return view('cardeditior.index', compact('images', 'template', 'themeSettings', 'suggestionCategories', 'template_id', 'campaign_id'));
        }
        //return redirect()->route('dashboard');
    }

    public function uploadMedia(Request $request)
    {
        $user = Auth::user();
      
        if ($request->hasFile('mediafile')) {
            $file = $request->file('mediafile');
            $name = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/user_' . $user->id . '/images/';

            $file->storeAs($path, $name, 'public');

            $image = UserImage::create([
                'user_id' => $user->id,
                'image_url' => $path . $name,
                'thumb_url' => $path . 'thumb_' . $name
            ]);          

            return response()->json(['success' => 1, 'image_url' => Storage::url($image->image_url), 'thumb_url' => Storage::url($image->thumb_url), 'id' => $image->id]);
        }
        return response()->json(['error' => 'File upload failed'], 400);
    }

    public function deleteImage(Request $request)
    {
        $user = Auth::user();
        $image = UserImage::where('id', $request->id)->where('user_id', $user->id)->first();
        if ($image) {
            Storage::delete($image->image_url);
            Storage::delete($image->thumb_url);
            $image->delete();
            return response()->json(['result' => true]);
        }
        return response()->json(['result' => 'notexist']);
    }

    public function saveTemplate(Request $request)
    {
        $user = Auth::user();
        $templateData = $request->template_data;
        $templateID = $request->template_id;

        if ($templateID == 0) {
            $template = UserTemplate::create([
                'user_id' => $user->id,
                'template_name' => $request->template_name,
                'template_data' => $templateData,
                'thumb' => '',
                'status' => 1
            ]);
            return response()->json(['status' => 1, 'insert_id' => $template->id]);
        } else {
            $template = UserTemplate::where('id', $templateID)->where('user_id', $user->id)->first();
            if ($template) {
                $template->update(['template_data' => $templateData]);
                return response()->json(['status' => 1, 'msg' => 'Template updated successfully']);
            }
            return response()->json(['status' => 0, 'msg' => 'Template not found']);
        }
    }


    public function getObject(Request $request)
    {
    
        if ($request->has('template_id')) {            
            $template_id = $request->template_id;
            //$where = ['sub_user_id' => $userID, 'template_id' => $template_id];
            
            $template_data = CardTemplate::where('id', $template_id)->first();

            //$template_data = UserTemplate::where($where)->first(['template_data', 'gradient_background', 'sub_cat_id', 'template_size', 'template_custom_size']);

            if ($template_data) {
                $suggestion = $tips = '';
               

                $template_size = $template_data->template_size == 'create_custom_size' ? $template_data->template_custom_size : $template_data->template_size;

                return response()->json([
                    'status' => 1,
                    'data' => $template_data->template_data ?? '',
                    'gradient_background' => $template_data->gradient_background ?? '' ,
                    'suggestion' => $suggestion,
                    'tips' => $tips,
                    'size' => $template_size
                ]);
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function adminEdit($template_id = '')
    {
        if ($template_id == '') {
            return redirect()->route('admin.templates');
        }

        $user = Auth::user();
        $userID = $user->id;

        $images = UserImage::where('user_id', $userID)->orderBy('id', 'DESC')->get();
        $template = UserTemplate::where('template_id', $template_id)->first();
        $themeSettings = ThemeSetting::all();
        $apiSetting = ThemeSetting::where(['user_id' => $userID, 'data_key' => 'apiSetting'])->first();
        $api_settings = $apiSetting ? json_decode($apiSetting->data_value, true) : [];

        $pixabay_key = $api_settings['pixabay_key'] ?? "null";

        if (empty($template)) {
            return redirect()->route('dashboard');
        }

        return view('editor', compact('images', 'userID', 'template', 'template_id', 'themeSettings', 'pixabay_key'));
    }

    public function moreImages(Request $request)
    {
        if ($request->has('page')) {
            $user = Auth::user();
            $userID = $user->id;
            $page = $request->page;
            $s = 21 * $page;
            $e = $s + 21;

            $images = UserImage::where('user_id', $userID)->orderBy('id', 'DESC')->skip($s)->take(21)->get();

            if ($images->count()) {
                return response()->json(['status' => 1, 'data' => $images]);
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function openClippingEditor(Request $request)
    {
        if ($request->has('action') && $request->action == 'cls_open' && $request->has('template_id')) {
            $user = Auth::user();
            $userID = $user->id;

            $template_id = $request->template_id;
            $template_data = UserTemplate::where(['user_id' => $userID, 'template_id' => $template_id])->first();

            if ($template_data) {
                $clip_editor = route('editor.edit', ['template_id' => $template_id, 'clipping' => 'clipping']);
                if (!empty($template_data->thumb)) {
                    if ($template_data->clip_state) {
                        return response()->json(['status' => 1, 'msg' => '', 'url' => $clip_editor]);
                    } else {
                        $image_path = storage_path('app/public/' . $template_data->thumb);
                        if (!empty($template_data->clippingmagic_data)) {
                            $clipdata = json_decode($template_data->clippingmagic_data, true);
                            $cl_image_id = $clipdata['image']['id'];
                            $this->clippingmagic->delete_image($cl_image_id);
                        }
                        $result = $this->clippingmagic->upload_image($image_path);
                        if (isset($result['image']['id'])) {
                            $clipData = json_encode($result);
                            $template_data->update(['clippingmagic_data' => $clipData, 'clip_state' => 1]);
                            return response()->json(['status' => 1, 'msg' => '', 'url' => $clip_editor]);
                        } else {
                            return response()->json(['status' => 0, 'msg' => 'First create and save template.']);
                        }
                    }
                } else {
                    return response()->json(['status' => 0, 'msg' => 'First create and save template.']);
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Template not available.']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
        }
    }

    public function openBgClippingEditor(Request $request)
    {
        if ($request->has('action') && $request->action == 'cls_open' && $request->has('template_id') && $request->has('image_url')) {
            $user = Auth::user();
            $userID = $user->id;

            $apiSetting = ThemeSetting::where(['user_id' => $userID, 'data_key' => 'apiSetting'])->first();
            $access = $apiSetting ? json_decode($apiSetting->data_value, true) : [];

            if (!empty($access['BGAuthKey'])) {
                $template_id = $request->template_id;
                $image_url = $request->image_url;

                if ($image_url) {
                    $path = storage_path('app/public/uploads/user_' . $userID . '/removeBG/');
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }

                    $name = uniqid() . '.png';
                    $BgRemoveSavePath = $path . $name;

                    $result = $this->clippingmagic->ClippingMagicRemoveBG($image_url, $access['BGAuthKey'], $BgRemoveSavePath);

                    if ($result['status'] != 200) {
                        return response()->json(['status' => 0, 'msg' => $result['message']]);
                    } else {
                        if (isset($result['imageId'])) {
                            return response()->json([
                                'status' => 1,
                                'msg' => 'Successfully Remove Background',
                                'cl_image_id' => $result['imageId'],
                                'cl_secret' => $result['imageSecret'],
                                'url' => $result['url']
                            ]);
                        } else {
                            return response()->json(['status' => 0, 'msg' => 'First create and save template.']);
                        }
                    }
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Image not exists or invalid.']);
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'You have not added API key in your theme settings. First add API key in theme settings then remove background will work.']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
        }
    }

    public function downloadBgClippingImage(Request $request)
    {
        if ($request->has('action') && $request->action == 'download' && $request->has('image_id') && $request->has('secret')) {
            $user = Auth::user();
            $userID = $user->id;

            $image_id = $request->image_id;
            $secret = $request->secret;
            $imageArr = json_encode(['image_id' => $image_id, 'secret' => $secret]);

            if ($image_id) {
                $name = uniqid();
                $fileName = $name . '.png';
                $result = $this->clippingmagic->download_image($image_id, $fileName);

                if (is_array($result)) {
                    return response()->json(['status' => 0, 'msg' => $result['error']]);
                } else {
                    $img_path = 'uploads/user_' . $userID . '/transparent/' . $fileName;
                    $image_url = Storage::url($img_path);

                    UserImage::create([
                        'user_id' => $userID,
                        'name' => $name,
                        'thumb' => '',
                        'file' => $img_path,
                        'clipping_data' => $imageArr,
                        'datetime' => now(),
                        'status' => 1
                    ]);

                    return response()->json(['status' => 1, 'msg' => '', 'url' => $image_url]);
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Image has not generated.']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
        }
    }

    public function deleteClipImage(Request $request)
    {
        if ($request->has('action') && $request->action == 'delete' && $request->has('image_id')) {
            $user = Auth::user();
            $userID = $user->id;

            $image_id = $request->image_id;

            if ($image_id) {
                $this->clippingmagic->delete_image($image_id);
                return response()->json(['status' => 1, 'msg' => '']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Image id not exists.']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
        }
    }

    public function downloadClippingImage(Request $request)
    {
        if ($request->has('action') && $request->action == 'download' && $request->has('template_id')) {
            $user = Auth::user();
            $userID = $user->id;

            $template_id = $request->template_id;
            $template_data = UserTemplate::where(['user_id' => $userID, 'template_id' => $template_id])->first();

            if ($template_data) {
                if (!empty($template_data->clippingmagic_data)) {
                    $clipdata = json_decode($template_data->clippingmagic_data, true);
                    $cl_image_id = $clipdata['image']['id'];

                    $revision = $this->clippingmagic->check_resultRevision($cl_image_id);
                    if (isset($revision['image']['resultRevision']) && $revision['image']['resultRevision']) {
                        $fileName = 'image-' . $template_id . '.png';
                        $result = $this->clippingmagic->download_image($cl_image_id, $fileName);

                        if (is_array($result)) {
                            return response()->json(['status' => 0, 'msg' => $result['error']]);
                        } else {
                            $image_url = Storage::url('uploads/user_' . $userID . '/transparent/' . $fileName);
                            return response()->json(['status' => 1, 'msg' => '', 'url' => $image_url]);
                        }
                    } else {
                        return response()->json(['status' => 0, 'msg' => 'Result is not generated yet, Please open editor and save.']);
                    }
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Need to first remove background.']);
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Template not available.']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
        }
    }




    public function shape()
    {      $directory = public_path("assets/images/element/shape/basic_shapes/");
      
        $directory_images = glob($directory . "*.svg");
        $shapes = [];
        foreach ($directory_images as $img) {
            $shapes[] = asset(str_replace(public_path(), '', $img));
        }

        return view('shapes.index', compact('shapes'));
    }

    public function library()
    {
        $directory = public_path("assets/images/background/thumb/");
        $directory_images = array_merge(
            glob($directory . "*.jpg"),
            glob($directory . "*.png"),
            glob($directory . "*.svg")
        );
        $images = [];
        foreach ($directory_images as $img) {
            $images[] = asset(str_replace(public_path(), '', $img));
        }

        return view('library.index', compact('images'));
    }

    public function library_bg()
    {
        $directory = public_path("assets/images/pattern/");
        $directory_images = array_merge(
            glob($directory . "*.jpg"),
            glob($directory . "*.png"),
            glob($directory . "*.svg")
        );
        $images = [];
        foreach ($directory_images as $img) {
            $images[] = asset(str_replace(public_path(), '', $img));
        }

        return view('library_bg.index', compact('images'));
    }

    public function pattern_load()
    {
        $directory = public_path("assets/images/element/pattern/");
        $directory_images = glob($directory . "*.svg");
        $patterns = [];
        foreach ($directory_images as $img) {
            $patterns[] = asset(str_replace(public_path(), '', $img));
        }

        return view('patterns.index', compact('patterns'));
    }

    public function ai_image_generator(Request $request)
    {
        $user = Auth::user();
        $apiSetting = ThemeSetting::where('user_id', $user->id)->where('data_key', 'apiSetting')->first();
        $api_settings = $apiSetting ? json_decode($apiSetting->data_value, true) : [];

        if (!empty($api_settings['open_ai_key'])) {
            $keys_words = $request->input('key_words', '');
            $image_size = $request->input('image_size', '1024x1024');
            $ogj = str_replace(" ", "%20", $keys_words);

            if (!empty($ogj)) {
                $args = [
                    "prompt" => $ogj,
                    "n" => 1,
                    "size" => $image_size
                ];

                $data_string = json_encode($args);
                $ch = curl_init('https://api.openai.com/v1/images/generations');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Authorization: Bearer ' . $api_settings['open_ai_key'],
                    'Content-Type: application/json'
                ]);
                $result = curl_exec($ch);
                $httpcode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
                $a = json_decode($result, true);

                if (isset($a['data'])) {
                    $images = [];
                    foreach ($a['data'] as $a_child) {
                        $image_path = 'openai_images' . rand(10, 100);
                        $img = public_path('uploads/ai/' . $image_path . '.png');
                        $imgUrl = $a_child['url'];
                        file_put_contents($img, file_get_contents($imgUrl));
                        $images[] = asset('uploads/ai/' . $image_path . '.png');
                    }
                    return view('ai_images.index', compact('images'));
                } else {
                    return response()->json(['error' => $a['error']['message']], $httpcode);
                }
            } else {
                return response()->json(['error' => 'Please Enter Object Name.'], 400);
            }
        } else {
            return response()->json(['error' => 'API Key Not Available. Please Add Open AI Key In Admin Panel.'], 400);
        }
    }

    public function ai_image_generator_bg(Request $request)
    {
        $user = Auth::user();
        $apiSetting = ThemeSetting::where('user_id', $user->id)->where('data_key', 'apiSetting')->first();
        $api_settings = $apiSetting ? json_decode($apiSetting->data_value, true) : [];

        if (!empty($api_settings['open_ai_key'])) {
            $keys_words = $request->input('key_words', '');
            $image_size = $request->input('image_size', '1024x1024');
            $ogj = str_replace(" ", "%20", $keys_words);

            if (!empty($ogj)) {
                $args = [
                    "prompt" => $ogj,
                    "n" => 1,
                    "size" => $image_size
                ];

                $data_string = json_encode($args);
                $ch = curl_init('https://api.openai.com/v1/images/generations');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Authorization: Bearer ' . $api_settings['open_ai_key'],
                    'Content-Type: application/json'
                ]);
                $result = curl_exec($ch);
                $httpcode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
                $a = json_decode($result, true);

                if (isset($a['data'])) {
                    $images = [];
                    foreach ($a['data'] as $a_child) {
                        $image_path = 'openai_images' . rand(10, 100);
                        $img = public_path('uploads/ai/' . $image_path . '.png');
                        $imgUrl = $a_child['url'];
                        file_put_contents($img, file_get_contents($imgUrl));
                        $images[] = asset('uploads/ai/' . $image_path . '.png');
                    }
                    return view('ai_images_bg.index', compact('images'));
                } else {
                    return response()->json(['error' => $a['error']['message']], $httpcode);
                }
            } else {
                return response()->json(['error' => 'Please Enter Object Name.'], 400);
            }
        } else {
            return response()->json(['error' => 'API Key Not Available. Please Add Open AI Key In Admin Panel.'], 400);
        }
    }

    public function ai_text_generator(Request $request)
    {
        $user = Auth::user();
        $apiSetting = ThemeSetting::where('user_id', $user->id)->where('data_key', 'apiSetting')->first();
        $api_settings = $apiSetting ? json_decode($apiSetting->data_value, true) : [];

        if (!empty($api_settings['open_ai_key'])) {
            $search_keyword = $request->input('search_key_word', '');
            $language = 'English';
            $presence_penalty = 0.0;
            $frequency_penalty = 0.0;
            $best_of = 1;
            $top_p = 1;
            $getTemperature = 0.7;
            $getMaxTokens = 1000;
            $model_option = 'gpt-3.5-turbo-instruct';
            $header = [
                'Authorization: Bearer ' . $api_settings['open_ai_key'],
                'Content-type: application/json; charset=utf-8',
            ];
            $params = json_encode([
                'prompt' => "$language:$search_keyword",
                'model' => $model_option,
                'temperature' => (float)$getTemperature,
                'max_tokens' => (float)$getMaxTokens,
                'top_p' => (float)$top_p,
                'best_of' => (float)$best_of,
                "frequency_penalty" => (float)$frequency_penalty,
                "presence_penalty" => (float)$presence_penalty,
            ]);
            $curl = curl_init('https://api.openai.com/v1/completions');
            $options = [
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $params,
                CURLOPT_RETURNTRANSFER => true,
            ];
            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

            if (200 == $httpcode) {
                $json_array = json_decode($response, true);
                $choices = $json_array['choices'];
                $postContent = $choices[0]["text"];
                return response()->json(['status' => $httpcode, 'content_data' => trim($postContent), 'message' => 'Successfully']);
            } else {
                $json_array = json_decode($response, true);
                return response()->json(['status' => '', 'content_data' => '', 'message' => $json_array['error']['message']]);
            }
        } else {
            return response()->json(['status' => '', 'content_data' => '', 'message' => "API Key Not Available. Please Add Open AI Key In Admin Panel"]);
        }
    }

    public function embed_code_template_images($id)
    {
        $template = UserTemplate::where('template_id', base64_decode($id))->first();
        if ($template && !empty($template->thumb)) {
            return response()->json(['image' => asset($template->thumb)]);
        } else {
            return response()->json(['error' => 'Not Found!'], 404);
        }
    }

}
