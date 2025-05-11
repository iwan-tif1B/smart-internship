<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SertifikatController extends Controller
{
    public function index()
    {
        $Sertifikat = Sertifikat::latest()->first();
        if ($Sertifikat && $Sertifikat->value) {
            $Sertifikat->location = Storage::url($Sertifikat->value);
        }
        return view('pages.sertifikat.index', compact('Sertifikat'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '' => 'required|file|mimes:docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('');
        $path = $file->store('s', 'public');

        Sertifikat::updateOrCreate(
            [],
            ['value' => $path]
        );

        return response()->json(['message' => ' sertifikat berhasil diunggah.']);
    }
}