<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RetrievePage extends Controller
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
            $page_name = $request->input('page_name');

            if ($page_name === NULL) {
                return response()->json(['error_message' => 'File name not specified'], 400);
            }

            if (Storage::exists($page_name)) {
                return response()->json(['file_content' => Storage::get($page_name)], 200);
            } else {
                return response()->json(['error_message' => 'File not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 400);
        }
    }
}
