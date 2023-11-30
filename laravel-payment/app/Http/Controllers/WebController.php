<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class WebController extends Controller
{
    //login page load function
    public function payment()
    {
        return view('pages.payment.payment');
    }
    public function login()
    {
        if (session()->has('LoggedUser') && session()->has('LoggedUserName')) {
            return redirect('/dashboard');
        }

        return view('pages.auth.login');
    }

    //register page load function
    public function register()
    {
        return view('pages.auth.register');
    }

    //dashboard page load function
   public function dashboard()
   {
        //Get all categories count
        $categoryCount = DB::table('category')
            ->where('status', '=', 1)
            ->count();

        //Get all notes created at within last 30 days and status is published
        $noteCount = DB::table('note')
            ->where('note_status', '=', 1)
            ->whereDate('createdAt', '>', date('Y-m-d', strtotime('-30 days')))
            ->count();

        //Get all drafts count
        $draftCount = DB::table('note')
            ->where('note_status', '=', 2)
            ->whereDate('createdAt', '>', date('Y-m-d', strtotime('-30 days')))
            ->count();

        //Get all favorites count
        $favoritesCount = DB::table('note')
            ->where('is_favorite', '=', 1)
            ->whereDate('createdAt', '>', date('Y-m-d', strtotime('-30 days')))
            ->count();

        $categories = DB::table('category')->get()->toArray();

            //create dashboard data object
            $dashBoardData = [
                'categoryCount' => $categoryCount,
                'noteCount' => $noteCount,
                'draftCount' => $draftCount,
                'favoritesCount' => $favoritesCount,
            ];

      return view('pages.dashboard', compact('dashBoardData', 'categories'));
   }

   //favorites page load function
    public function favourites()
    {
        //get  all notes which are marked as favorites and note status is published and category name
        $favouriteNotes = DB::table('note')
            ->join('category', 'note.category_id', '=', 'category.id')
            ->select('note.*', 'category.category_name')
            ->where('is_favorite', '=', 1)
            ->where('note_status', '=', 1)
            ->get()->toArray();

            // dd($favouriteNotes);
        return view('pages.favourites', compact('favouriteNotes'));
    }

    //add note page load function
    public function addnote()
    {

        // get categories from database
        $categories = DB::table('category')
            ->where('status', '=', 1)
            ->get()->toArray();

        return view('pages.addnote', compact('categories'));
    }


    //view notes page load function
    public function viewnotes($id)
    {
        //get all notes by category id
        $notes = DB::table('note')
            ->join('category', 'note.category_id', '=', 'category.id')
            ->select('note.*', 'category.category_name')
            ->where('category_id', '=', $id)
            ->where('note_status', '=', 1)
            ->get()->toArray();

        $category = DB::table('category')->where('id', '=', $id)->first();
            // dd($categoryName);
        return view('pages.viewnotes', compact('notes', 'category'));
    }

    //drafts page load function
    public function drafts()
    {
        //load all draft notes populating category by joining category table
        $draftNotes = DB::table('note')
            ->join('category', 'note.category_id', '=', 'category.id')
            ->select('note.*', 'category.category_name')
            ->where('note_status', '=', 2)
            ->get()->toArray();

        return view('pages.drafts', compact('draftNotes'));
    }


    //trash page load function
    public function trash()
    {
        //load all draft notes populating category by joining category table
        $trashNotes = DB::table('note')
            ->join('category', 'note.category_id', '=', 'category.id')
            ->select('note.*', 'category.category_name')
            ->where('note_status', '=', 0)
            ->get()->toArray();
        return view('pages.trash', compact('trashNotes'));
    }


    //edit note page load function
    public function updateNote($id){

         // get categories from database
         $categories = DB::table('category')
         ->where('status', '=', 1)
         ->get()->toArray();

            //get note details by id
            $noteDetails = DB::table('note')
            ->where('id', '=', $id)
            ->first();

            $previousUrl = URL::previous();



            // Parse the URL to get the path
            $parsedUrl = parse_url($previousUrl);

            // Get the path from the parsed URL
            $previousRouteName = $parsedUrl['path'];

            // dd($previousRouteName);

        return view('pages.editnote', compact('categories', 'noteDetails','previousRouteName'));
}


}
