<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class NoteController extends Controller
{

    //add note function
    public function addnote(Request $request)
    {
        // get user button click action
        $action = $request->input('action');

        //validate request
        $customErrorMessages = [
            'note_title.required' => 'Please add a Note Title.',
            'category.required' => 'Please select a category.',
            'note_image.required' => 'Please add an image.',
            'note.required' => 'Please add a Note Text.',
            'note_image.image' => 'Please upload an image.',
            'note_image.mimes' => 'Please upload an image of type jpeg, png, jpg, gif.',
            'note_image.max' => 'Please upload an image of maximum size 2MB.',

        ];


        $request->validate([
            'note_title' => 'required',
            'category' => 'required',
            'note_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // You can adjust the image validation rules as needed
            'note' => 'required',
        ], $customErrorMessages);



        //upload image to cloudinary
        $imageUrl = '';
        if ($request->hasFile('note_image')) {
            $image = $request->file('note_image');
            $uploadResult = cloudinary::upload($image->getRealPath(), [
                'folder' => 'uploads', // You can change the folder where the image will be uploaded
            ]);

            $imageUrl = $uploadResult->getSecurePath(); // Get the secure URL of the uploaded image

        }

        //insert data into database
        if($action == 'publish'){
            $note_status = 1; // 1 for published
            $newNote = DB::table('note')->insert([
                'note_title' => $request->note_title,
                'note' => $request->note,
                'note_image' => $imageUrl,
                'note_status' => $note_status,
                'category_id' => $request->category,
            ]);

            if ($newNote) {
                //send response after 5 seconds
                return back()->with('success',"Note added successfully..!");
            } else {
                return back()->with('error',"Something went wrong..!")->withInput();
            }

        }else if ($action == 'draft'){
            $note_status = 2; // 2 for draft
            $newNote = DB::table('note')->insert([
                'note_title' => $request->note_title,
                'note' => $request->note,
                'note_image' => $imageUrl,
                'note_status' => $note_status,
                'category_id' => $request->category,
            ]);

            if ($newNote) {
                return back()->with('success',"Note successfully as draft..!");
            } else {
                return back()->with('error',"Something went wrong..!")->withInput();
            }
        }

    }

    public function deletenote($id)
    {

        // $deleteNote = DB::table('note')->where('id', '=', $id)->delete();
        //update status to 0
        $deleteNote = DB::table('note')
            ->where('id', '=', $id)
            ->update(['note_status' => 0, 'is_favorite' => 0]);

        if ($deleteNote) {
            return back()->with('success', "Note deleted successfully..!");
        } else {
            return back()->with('error', "Something went wrong..!")->withInput();
        }
    }

    //restore note as publish
        public function restorepublish($id)
    {
        //update status to 1
        $restoredNote = DB::table('note')
            ->where('id', '=', $id)
            ->update(['note_status' => 1]);

        if ($restoredNote) {
            return back()->with('success', "Note restored successfully..!");
        } else {
            return back()->with('error', "Something went wrong..!")->withInput();
        }
    }

    public function restoredraft($id){
   //update status to 1
   $restoredNote = DB::table('note')
   ->where('id', '=', $id)
   ->update(['note_status' => 2]);

        if ($restoredNote) {
        return back()->with('success', "Note restored successfully..!");
        } else {
        return back()->with('error', "Something went wrong..!")->withInput();
        }
    }

    public function addfavorite($id) {
        //update status to 1
        $restoredNote = DB::table('note')
        ->where('id', '=', $id)
        ->update(['is_favorite' => 1]);

             if ($restoredNote) {
             return back()->with('success', "Note added to favorites..!");
             } else {
             return back()->with('error', "Something went wrong..!")->withInput();
             }
    }

    public function addUnfavorite($id){
        //update status to 1
        $restoredNote = DB::table('note')
        ->where('id', '=', $id)
        ->update(['is_favorite' => 0]);

             if ($restoredNote) {
             return back()->with('success', "Note removed from favorites..!");
             } else {
             return back()->with('error', "Something went wrong..!")->withInput();
             }
    }


    public function updatenote(Request $request ,$id){
        //  dd($request->request);
        $customErrorMessages = [
            'note_title.required' => 'Please add a Note Title.',
            'category.required' => 'Please select a category.',
            'note.required' => 'Please add a Note Text.',


        ];
        // dd($request->request);
        $request->validate([
            'note_title' => 'required',
            'category' => 'required',
            'note' => 'required',

        ], $customErrorMessages);


        //get old image
        $oldImage = DB::table('note')
        ->where('id', '=', $id)
        ->first();


        //upload image to cloudinary
        $imageUrl = '';
        if ($request->hasFile('note_image')) {
            $image = $request->file('note_image');
            $uploadResult = cloudinary::upload($image->getRealPath(), [
                'folder' => 'uploads', // You can change the folder where the image will be uploaded
            ]);

            $imageUrl = $uploadResult->getSecurePath(); // Get the secure URL of the uploaded image

        }else {
            $imageUrl = $oldImage->note_image;
        }

        $updateNote = null;
        if($request->action == 'publish'){
            $note_status = 1; // 1 for published
        }else if ($request->action == 'draft'){
            $note_status = 2; // 2 for draft
        }

        $updateNote = DB::table('note')
        ->where('id', '=', $id)
        ->update([
            'note_title' => $request->note_title,
            'note' => $request->note,
            'note_image' => $imageUrl,
            'category_id' => $request->category,
            'note_status' => $note_status
        ]);


             if ($updateNote) {
                return redirect($request->previous_route)->with('success', "Note updated successfully..!");


             } else {
             return back()->with('error', "Something went wrong..!")->withInput();
             }

    }

    public function getSpecificNote($id){
        //get specfi note details with category name
        $noteDetails = DB::table('note')
        ->join('category', 'note.category_id', '=', 'category.id')
        ->select('note.*', 'category.category_name')
        ->where('note.id', '=', $id)
        ->first();

        return response()->json($noteDetails);
    }

    public function deletepermently($id){

        DB::table('note')
        ->where('id', '=', $id)
        ->delete();

        return back()->with('success', "Note deleted permanently..!");
    }
}