<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AddFile extends Controller
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
            $input = $request->all(); //store the post values in input array
            $errors = array(); //intialize an empty array to store errors

            if (!isset($input['file_name'])) { //if file name is null add error to errors array
                $errors[] = 'No file name';
            }

            if (!isset($input['file_content'])) { //if file content is null add error to errors array
                $errors[] = 'No file content';
            }

            //if there are errors return error response
            if (sizeof($errors) > 0) {
                return response()
                    ->json(['error(s)' => $errors], 400);
            }

            Storage::disk('local')->put($input['file_name'], $input['file_content']);
            return response()
                ->json(['Response_message' => 'Page added successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 400);
        }
    }
}
