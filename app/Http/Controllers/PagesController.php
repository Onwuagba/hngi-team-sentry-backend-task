<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Mail\Markdown;
use Illuminate\Support\HtmlString;
use GrahamCampbell\Markdown\Facades\Markdown;
class PagesController extends Controller
{

    // This function will take care of creating the file and writing the markdown content to it.
    // the content will be automatically overwritten when the /set_content_markdown is hit

    public function set_page_markdown(Request $request)
    {
        // retrieve title and content from request payload
        $title = $request->input('page_title');
        $content = $request->input('page_content');

        try {
            // this will create a file on local storage with the markdown extension
            if($title) {
                Storage::put($title . '.md', $content);
                return response()->json(['message' => 'Your page has been added successfully']);
            } else {
                return response()->json(['errors' => 'Sorry, the page title is required']);
            }

            if($request->hasFile('file')) {
                if ($request->file('file')->isValid()) {
                    $file = $request->file('file');
                    Storage::put($file);
                    return response()->json(['message' => 'Your file has been uploaded successfully']);
                } else {
                    return response()->json(['errors' => 'The upload process had some errors, please try again']);
                }
            }
        } catch (\Exception $e) {
            // return error response to the user
            return response()->json(['error' => $e]);
        }
    }

    public function retrieve_page_html(Request $request) {
        $title = $request->input('page_title');
        try {
            if($title) {
                if (Storage::exists($title . '.md')) {
                    $markdown = Storage::get($title . '.md');
                    $html = Markdown::convertToHtml($markdown);
                    return response()->json(['html_response' => $html]);
                } else {
                    return response()->json(['errors' => 'The page you requested for does not exist.'], 404);
                }
            } else {
                return response()->json(['errors' => 'Sorry, the page title is required']);
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        }
    }

    public function retrieve_page_markdown(Request $request)
    {
        $title = $request->input('page_title');
        try {
            if ($title) {
                if (Storage::exists($title . '.md')) {
                    $markdown = Storage::get($title . '.md');
                    return response()->json(['html_response' => $markdown]);
                } else {
                    return response()->json(['errors' => 'The page you requested for does not exist.'], 404);
                }
            } else {
                return response()->json(['errors' => 'Sorry, the page title is required']);
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        }
    }

    public function list_pages() {
        $files = array_slice(scandir(storage_path('app/files')), 2);

        if(count($files)){
            return response()->json(['pages' => $files]);
        } else {
            return response()->json(['pages' => 'Sorry, you have not saved any pages with us']);
        }  
    }
}
