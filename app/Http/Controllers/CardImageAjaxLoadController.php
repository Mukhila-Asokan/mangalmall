<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
Use Illuminate\Support\Facades\Log;
Use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Session;
Use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Facades\File;
Use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
Use App\Models\ThemeSetting;    
class CardImageAjaxLoadController extends Controller
{
    public function shape(Request $request)
    {
    
            try {
                $shapes = [
                    'basic_shapes' => $this->getImages('assets/images/element/shape/basic_shapes/'),
                    'dividers' => $this->getImages('assets/images/element/shape/dividers/'),
                    'abstract_shapes' => $this->getImages('assets/images/element/shape/abstract_shapes/'),
                    'badges' => $this->getImages('assets/images/element/shape/badges/'),
                    'ecommerce' => $this->getImages('assets/images/element/shape/ecommerce/'),
                    'arrow' => $this->getImages('assets/images/element/shape/arrow/'),
                    'banners' => $this->getImages('assets/images/element/shape/banners/'),
                    'holiday' => $this->getImages('assets/images/element/shape/holiday/'),
                    'button' => $this->getImages('assets/images/element/shape/button/'),
                    'social' => $this->getImages('assets/images/element/shape/social/'),
                    'emoji' => $this->getImages('assets/images/element/shape/emoji/'),
                    'object' => $this->getImages('assets/images/element/shape/object/'),
                    'seasonal' => $this->getImages('assets/images/element/shape/seasonal/')
                ];
        
                // If the request is an AJAX request, return the rendered HTML
                if ($request->ajax()) {
                    return view('cardeditior.shape', $shapes)->render();
                }
        
                // If it's a normal request, return the full Blade view
                return view('cardeditior.shape', $shapes);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
    }
        
    
    

    private function getImages($directory)
    {
        return array_map(function ($img) {
            return [
                'src' => asset($img),
                'alt' => __('ltr_images_loads_shape_msg')
            ];
        }, glob($directory . "*.svg"));
    }


    public function library(Request $request)
    {
       
        try {
            // If the request is an AJAX request, return the rendered HTML
            if ($request->ajax()) {
            return response()->json([
                'html' => view('cardeditior.library')->render()
            ]);
            }

            // If it's a normal request, return the full Blade view
            return view('cardeditior.library');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function library_bg(Request $request){

        try {
            // If the request is an AJAX request, return the rendered HTML
            if ($request->ajax()) {
                return response()->json([
                    'html' => view('cardeditior.library_bg')->render()
                ]);
            }

            // If it's a normal request, return the full Blade view
            return view('cardeditior.library_bg');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function pattern_load(Request $request){

        try {
            $patterns = $this->getImages('assets/images/element/patterns/');

            // If the request is an AJAX request, return the rendered HTML
            if ($request->ajax()) {
                return response()->json([
                    'html' => view('cardeditior.patterns', ['patterns' => $patterns])->render()
                ]);
            }

            // If it's a normal request, return the full Blade view
            return view('cardeditior.patterns', ['patterns' => $patterns]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function ai_image_generator(Request $request)
    {  
        $apiSetting = ThemeSetting::where('data_key', 'apiSetting')
            ->first();
            
        $api_settings = isset($apiSetting) && !empty($apiSetting->data_value) ? json_decode($apiSetting->data_value, true) : [];

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
                    foreach ($a['data'] as $a_child) {
                        $image_path = 'openai_images' . rand(10, 100);
                        $img = public_path('uploads/ai/' . $image_path . '.png');
                        $imgUrl = $a_child['url'];
                        file_put_contents($img, file_get_contents($imgUrl));
                        $img_url = asset('uploads/ai/' . $image_path . '.png');
                        echo '<div class="ed_image pg_canvas_add_image" data-url="' . $img_url . '"><img src="' . $img_url . '" alt="AI IMAGES"></div>';
                    }
                } else {
                    echo '<p style="color:red;">' . $a['error']['message'] . '</p>';
                }
            } else {
                echo '<p style="color:red;">Please Enter Object Name.</p>';
            }
        } else {
            echo '<p style="color:red;">API Key Not Available Please Add Open AI Key In Admin Panel</p>';
        }
    }

   
    public function ai_text_generator(Request $request)
    {
        $apiSetting = ThemeSetting::where('data_key', 'apiSetting')->first();
        $api_settings = isset($apiSetting) && !empty($apiSetting->data_value) ? json_decode($apiSetting->data_value, true) : [];
    
        if (!empty($api_settings['open_ai_key'])) {
            $search_keyword = $request->input('search_key_word', '');
            $language = 'English';
            $model_option = 'gpt-3.5-turbo'; // gpt-3.5-turbo, curie, babbage, ada, davinci, davinci-codex
            $maxTokens = 1000;
            $temperature = 0.7;
            $top_p = 1;
    
            // API request payload
            $params = [
                'model' => $model_option,
                'messages' => [
                    ['role' => 'system', 'content' => "You are a helpful AI assistant."],
                    ['role' => 'user', 'content' => "$search_keyword"]
                ],
                'temperature' => (float) $temperature,
                'max_tokens' => (int) $maxTokens,
                'top_p' => (float) $top_p,
            ];
    
            // Send API request using Laravel's HTTP client
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $api_settings['open_ai_key'],
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/completions', $params);
    
            // Handle response
            if ($response->successful()) {
                $json_array = $response->json();
                $postContent = $json_array['choices'][0]['message']['content'] ?? '';
    
                return response()->json([
                    'status' => 200,
                    'content_data' => trim($postContent),
                    'message' => 'Successfully generated AI response',
                ]);
            } else {
                return response()->json([
                    'status' => $response->status(),
                    'content_data' => '',
                    'message' => $response->json()['error']['message'] ?? 'API Request Failed',
                ]);
            }
        }
    
        return response()->json([
            'status' => '',
            'content_data' => '',
            'message' => "API Key Not Available. Please add OpenAI API Key in Admin Panel.",
        ]);
    }
    


        

        /**
         * AI IMAGE GENERATOR BG
         */
        public function ai_image_generator_bg(Request $request)
        {
            $apiSetting = ThemeSetting::where('data_key', 'apiSetting')->first();
            $api_settings = isset($apiSetting) && !empty($apiSetting->data_value) ? json_decode($apiSetting->data_value, true) : [];

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
                        foreach ($a['data'] as $a_child) {
                            $image_path = 'openai_images' . rand(10, 100);
                            $img = public_path('uploads/ai/' . $image_path . '.png');
                            $imgUrl = $a_child['url'];
                            file_put_contents($img, file_get_contents($imgUrl));
                            $img_url = asset('uploads/ai/' . $image_path . '.png');
                            echo '<div class="ed_image pg_canvas_bg_image" data-url="' . $img_url . '"><img src="' . $img_url . '" alt="AI IMAGES"></div>';
                        }
                    } else {
                        echo '<p style="color:red;">' . $a['error']['message'] . '</p>';
                    }
                } else {
                    echo '<p style="color:red;">Please Enter Object Name.</p>';
                }
            } else {
                echo '<p style="color:red;">API Key Not Available Please Add Open AI Key In Admin Panel</p>';
            }
        }

        /**
         * Embed Code Template Images
         */
        public function embed_code_template_images($id)
        {
            $template = DB::table('user_templates')->where('template_id', base64_decode($id))->first();

            if (!empty($template->thumb)) {
                echo "<img src='" . asset($template->thumb) . "' alt='" . $template->template_name . "'>";
            } else {
                echo "Not Found !";
            }
        }













    }









