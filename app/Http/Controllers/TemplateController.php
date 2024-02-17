<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Templates.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apiKey = 'AIzaSyC6H1NGVqEH2u0epLKZEu5wk4Oj3kd_a4Y';
        $url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . $apiKey;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);
        $data = json_decode($response, true);
        if ($data === null) {
            echo 'Error decoding JSON';
        } else {
            $fontFamilies = array_column($data['items'], 'family');
        }
        $csvfilesPath = "./csv_files/";
        $files = scandir($csvfilesPath);
        $csv_files = array_diff($files, ['.', '..']);
        $compact = compact("fontFamilies", "csv_files");
        return view('Templates.add')->with($compact);
        // ==================now code ================================
        // ==================alerady code ============================
        // $filePath = "./assets/js/font_families.json";
        // $content = file_get_contents($filePath);
        // $fontFamiliesData = json_decode($content, true);
        // $fontFamilies = $fontFamiliesData['fontFamilies'];
        // $csvfilesPath = "./csv_files/";
        // $files = scandir($csvfilesPath);
        // $csv_files = array_diff($files, ['.', '..']);
        // $compact = compact("fontFamilies", "csv_files");
        // return view('Templates.add')->with($compact);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTemplateRequest $request)
    {
        $input = $request->all();
        if ($request->hasfile("template_picture")) {
            $template = $request->file("template_picture");
            $extension = $template->getClientOriginalExtension();
            $filename = Str::slug($input['template_title'], '-') . "." . $extension;
            $template->move("uploads/", $filename);
            $msg = 200;
        }
        if ($msg == 200) {
            $input['template_title'] = strtolower($input['template_title']);
            $input['template_picture'] = $filename;
            $input['template_status'] = 1;
            Template::create($input);
            return response()->json([
                "message" => 200,
                "module" => "template",
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        $status = $template->template_status;
        if ($status == 1) {
            Template::where('id', $template->id)->update([
                "template_status" => 2,
            ]);
        } else {
            Template::where('id', $template->id)->update([
                "template_status" => 1,
            ]);
        }
        return response()->json([
            "message" => $template,
            "module" => "template",
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTemplateRequest $request, Template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        return $template;
    }
    public function gettingData()
    {
        $alltempltes = Template::whereNull('deleted_at')->latest()->get();
        return response()->json([
            "data" => $alltempltes,
        ]);
    }
}
