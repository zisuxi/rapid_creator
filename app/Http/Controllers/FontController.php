<?php

namespace App\Http\Controllers;

use App\Models\Font;
use App\Http\Requests\StoreFontRequest;
use App\Http\Requests\UpdateFontRequest;

class FontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('font.view');
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
        if ($request->hasfile('font_file')) {
            $file = $request->file('font_file');
            $extension = $file->getClientOriginalExtension();
            if ($extension == "zip") {
                echo "zip";
            } else {
                echo "ttf";
            }
        }
        // if ($request->hasFile('font_file') && $request->file('font_file')->isValid()) {
        //     $file = $request->file('font_file');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        // }
        // $creatFont = Font::create([
        //     'font_name' => $request->font_name,
        //     'font_zip_file' => $fileName,
        //     'font_status' => 1,
        // ]);
        // if ($creatFont) {
        //     return 200;
        // } else {
        //     return 300;
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Font $font)
    {
        //
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
    public function destroy(Font $font)
    {
        //
    }
}
