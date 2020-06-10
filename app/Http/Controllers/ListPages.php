<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListPages extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $files = array_filter(Storage::files('/'), function ($fileName) {
                return '.gitignore' !== $fileName;
            });

            return response()->json($files, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 400);
        }
    }
}
