<?php

namespace App\Http\Controllers;

use App\Models\Font;
use App\Http\Requests\StoreFontRequest;
use App\Http\Requests\UpdateFontRequest;
use ZipArchive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fontData = Font::all();

        return view('font.view', compact('fontData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('font.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFontRequest $request)
    {
        $zip = new ZipArchive();
        if ($zip->open($request->file('font_file')) === true) {
            $filePath = public_path('fileUpload/extract_folder');
            if (!file_exists($filePath)) {
                mkdir($filePath, 0755, true);
                $zipResult = $zip->extractTo($filePath);
                $zip->close();
                if ($zipResult) {
                    $scanDir = scandir($filePath);
                    $scanDir = array_diff($scanDir, array('.', '..'));
                    $arrayFile = [];
                    foreach ($scanDir as $key => $value) {
                        $uplFiles = rand(1000, 3000) . " " . $value;
                        $arrayFile[] = $uplFiles;
                    }
                    $serializeFile =  serialize($arrayFile);
                    $creatFont = Font::create([
                        'user_id' => Auth::user()->id,
                        'font_name' => $request->font_name,
                        'font_zip_file' =>  $serializeFile,
                        'font_status' => 1,
                    ]);
                    if ($creatFont) {
                        return 200;
                    } else {
                        return 300;
                    }
                    // $filteredFiles = array_filter($scanDir, function ($filename) {
                    //     return str_contains($filename, "ttf");
                    // });

                } else {
                    return "Error extracting files from the zip archive.";
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $fontStatus = Font::where('id', $id)->first();
        if ($fontStatus->font_status == 1) {
            $message = 0;
        } else {
            $message = 1;
        }
        Font::where('id', $id)->update([
            'font_status' => $message,
        ]);
        return response()->json([
            'message' => 200,
            'id' => $fontStatus->id,
            'status' => $fontStatus->font_status,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Font $font)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFontRequest $request, Font $font)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleteRecord = Font::where('id', $id)->delete();
        if ($deleteRecord) {
            return 200;
        } else {
            return 300;
        }
    }
}
