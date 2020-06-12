<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\HTMLToMarkdown\HtmlConverter;
use Illuminate\Support\Facades\Storage;

class SetMarkdown extends Controller
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
                $converter = new HtmlConverter();
                $markdown = $converter->convert(Storage::get($page_name));

                return response()->json(['markdown_content' => $markdown], 200);
            } else {
                return response()->json(['error_message' => 'File not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 400);
        }
    }
}
