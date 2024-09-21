<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function Options()
    {
        // Fetch all options in a single query
        $options = Option::whereIn('key', [
            'name',
            'phone',
            'apikey',
            'privacy_policy',
            'tos',
            'heading',
            'sub_heading',
            'description',
            'ad_img',  // Image key
            'btn_text'  // Button text field
        ])->get()->keyBy('key');

        // Extract individual options or set default values if not found
        $name = $options['name']->value ?? '';
        $phone_no = $options['phone']->value ?? '';
        $apikey = $options['apikey']->value ?? '';
        $privacyPolicyContent = $options['privacy_policy']->value ?? '';
        $tosContent = $options['tos']->value ?? '';
        $heading = $options['heading']->value ?? '';
        $sub_heading = $options['sub_heading']->value ?? '';
        $description = $options['description']->value ?? '';
        $btn_text = $options['btn_text']->value ?? '';

        // Fetch the image URL from the media collection
        $ad_img_url = isset($options['ad_img'])
            ? $options['ad_img']->getFirstMediaUrl('info_img')
            : null;

        return view('admin.all-options', compact(
            'privacyPolicyContent',
            'tosContent',
            'name',
            'phone_no',
            'apikey',
            'heading',
            'sub_heading',
            'description',
            'btn_text',  // Pass btn_text to the view
            'ad_img_url'  // Pass image URL to the view
        ));
    }

    public function saveInfo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'apikey' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'sub_heading' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'btn_text' => 'required|string|max:255',
            'ad_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
        ]);

        // Prepare the titles and subtitles array
        $titles = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'apikey' => $validated['apikey'],
            'heading' => $validated['heading'],
            'sub_heading' => $validated['sub_heading'],
            'description' => $validated['description'],
            'btn_text' => $validated['btn_text'],
        ];
        foreach ($titles as $key => $value) {
            Option::updateOrCreate(
                ['key' => $key], // Match based on the key
                ['value' => $value] // Update or insert the value
            );
        }

        if ($request->hasFile('ad_img')) {
            $ad_img = $request->file('ad_img');
            $option = Option::updateOrCreate(
                ['key' => 'ad_img'],
                ['value' => 'ad_img']
            );

            $option->clearMediaCollection('info_img');
            $option->addMedia($ad_img)
                ->toMediaCollection('info_img');
        }
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Titles and images saved successfully',
        ]);
    }

    public function saveOptions(Request $request)
    {
        $request->validate([
            'privacy_policy' => 'required',
            'tos' => 'required',
        ]);

        // Save the content to the database or file system
        Option::updateOrCreate(
            ['key' => 'privacy_policy'],
            ['value' => $request->input('privacy_policy')]
        );

        Option::updateOrCreate(
            ['key' => 'tos'],
            ['value' => $request->input('tos')]
        );

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Options saved successfully',
        ]);
    }

    public function getOptions()
    {
        // Fetch all options in a single query
        $options = Option::whereIn('key', [
            'name',
            'phone',
            'apikey',
            'privacy_policy',
            'tos',
            'heading',
            'sub_heading',
            'description',
            'ad_img',  // Image key
            'btn_text'  // Button text field
        ])->get()->keyBy('key');

        // Extract individual options or set default values if not found
        $name = $options['name']->value ?? '';
        $phone_no = $options['phone']->value ?? '';
        $apikey = $options['apikey']->value ?? '';
        $privacyPolicyContent = $options['privacy_policy']->value ?? '';
        $tosContent = $options['tos']->value ?? '';
        $heading = $options['heading']->value ?? '';
        $sub_heading = $options['sub_heading']->value ?? '';
        $description = $options['description']->value ?? '';
        $btn_text = $options['btn_text']->value ?? '';

        // Safely check for ad_img and get its media URL
        $ad_img_url = isset($options['ad_img'])
            ? $options['ad_img']->getFirstMediaUrl('info_img')
            : null;

        // Return the content as JSON
        return response()->json([
            'name' => $name,
            'phone' => $phone_no,
            'apikey' => $apikey,
            'privacy_policy' => $privacyPolicyContent,
            'tos' => $tosContent,
            'heading' => $heading,
            'sub_heading' => $sub_heading,
            'description' => $description,
            'btn_text' => $btn_text,
            'ad_img_url' => $ad_img_url
        ]);
    }

    public function ad()
    {
        $options = Option::whereIn('key', [
            'ad_img_1',
            'ad_link_1',
            'ad_time_1',
            'ad_img_2',
            'ad_link_2',
            'ad_img_3',
            'ad_link_3',
        ])->get()->keyBy('key');

        $ad_img_1_url = isset($options['ad_img_1'])
            ? $options['ad_img_1']->getFirstMediaUrl('info_img')
            : null;
        $ad_link_1 = $options['ad_link_1']->value ?? '';
        $ad_time_1 = $options['ad_time_1']->value ?? '';

        $ad_img_2_url = isset($options['ad_img_2'])
            ? $options['ad_img_2']->getFirstMediaUrl('info_img')
            : null;
        $ad_link_2 = $options['ad_link_2']->value ?? '';

        $ad_img_3_url = isset($options['ad_img_3'])
            ? $options['ad_img_3']->getFirstMediaUrl('info_img')
            : null;
        $ad_link_3 = $options['ad_link_3']->value ?? '';

        return view('admin.ad-settings', compact(
            'ad_img_1_url',
            'ad_link_1',
            'ad_time_1',
            'ad_img_2_url',
            'ad_link_2',
            'ad_img_3_url',
            'ad_link_3'
        ));
    }

    public function saveAd(Request $request)
    {
        $request->validate([
            'ad_img_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'ad_link_1' => 'required|string|max:255',
            'ad_time_1' => 'required',
            'ad_img_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'ad_link_2' => 'required|string|max:255',
            'ad_img_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'ad_link_3' => 'required|string|max:255',
        ]);

        Option::updateOrCreate(
            ['key' => 'ad_link_1'],
            ['value' => $request->input('ad_link_1')]
        );
        Option::updateOrCreate(
            ['key' => 'ad_time_1'],
            ['value' => $request->input('ad_time_1')]
        );
        Option::updateOrCreate(
            ['key' => 'ad_link_2'],
            ['value' => $request->input('ad_link_2')]
        );
        Option::updateOrCreate(
            ['key' => 'ad_link_3'],
            ['value' => $request->input('ad_link_3')]
        );
        if ($request->hasFile('ad_img_1')) {
            $ad_img_1 = $request->file('ad_img_1');
            $option1 = Option::updateOrCreate(
                ['key' => 'ad_img_1'],
                ['value' => 'ad_img_1']  // Or any other relevant value to store
            );

            // Clear previous media and add new image
            $option1->clearMediaCollection('info_img');
            $option1->addMedia($ad_img_1)->toMediaCollection('info_img');
        }

        // Handling ad_img_2
        if ($request->hasFile('ad_img_2')) {
            $ad_img_2 = $request->file('ad_img_2');
            $option2 = Option::updateOrCreate(
                ['key' => 'ad_img_2'],
                ['value' => 'ad_img_2']  // Or any other relevant value to store
            );

            // Clear previous media and add new image
            $option2->clearMediaCollection('info_img');
            $option2->addMedia($ad_img_2)->toMediaCollection('info_img');
        }

        // Handling ad_img_3
        if ($request->hasFile('ad_img_3')) {
            $ad_img_3 = $request->file('ad_img_3');
            $option3 = Option::updateOrCreate(
                ['key' => 'ad_img_3'],
                ['value' => 'ad_img_3']
            );

            // Clear previous media and add new image
            $option3->clearMediaCollection('info_img');
            $option3->addMedia($ad_img_3)->toMediaCollection('info_img');
        }

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Ads saved successfully',
        ]);
    }
}
