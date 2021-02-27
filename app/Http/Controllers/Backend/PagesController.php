<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
  public function index(){
    // $breadcrumbs = [
    //   ['name'=>"Page"]
    // ];
    // $config = array(
    //   "title"        => "Backend Page",
    //   "title_table"  => "Create Page",
    // );
    $page_title = 'Dashboard';
    $page_description = 'Some description for the page';
    return view('backend.pages.index', compact('page_title', 'page_description'));
    // return view('pages.dashboard', compact('page_title', 'page_description'));

  }
}
