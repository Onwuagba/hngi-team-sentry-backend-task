<?php

use App\Http\Controllers\PagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// end point to add a page
Route::post('add_page', 'PagesController@set_page_markdown');
// end point to set a page markdown
Route::post('set_page_markdown', 'PagesController@set_page_markdown');
// this endpoint will take care of retrieving the html format of the markdown file
Route::get('retrieve_page_html', 'PagesController@retrieve_page_html');
// this endpoint will return the list of all pages in storage
Route::get('list_pages', 'PagesController@list_pages');
