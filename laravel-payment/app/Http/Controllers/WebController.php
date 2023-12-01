<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class WebController extends Controller
{

    public function handlePaymentResponse(Request $request){
        // dd($request->all());
        //return json as response
        $decryptedData = json_encode($request->all());


        return view('pages.payment.payment', compact('decryptedData'));

    }

   public function aes_evpKDF($password, $salt, $keySize = 8, $ivSize = 4, $iterations = 1, $hashAlgorithm = "md5")
{
    $targetKeySize = $keySize + $ivSize;
    $derivedBytes = "";
    $numberOfDerivedWords = 0;
    $block = NULL;
    $hasher = hash_init($hashAlgorithm);
    while ($numberOfDerivedWords < $targetKeySize) {
        if ($block != NULL) {
            hash_update($hasher, $block);
        }
        hash_update($hasher, $password);
        hash_update($hasher, $salt);
        $block = hash_final($hasher, TRUE);
        $hasher = hash_init($hashAlgorithm);

        // Iterations
        for ($i = 1; $i < $iterations; $i++) {
            hash_update($hasher, $block);
            $block = hash_final($hasher, TRUE);
            $hasher = hash_init($hashAlgorithm);
        }

        $derivedBytes .= substr($block, 0, min(strlen($block), ($targetKeySize - $numberOfDerivedWords) * 4));

        $numberOfDerivedWords += strlen($block) / 4;
    }
    return array(
        "key" => substr($derivedBytes, 0, $keySize * 4),
        "iv"  => substr($derivedBytes, $keySize * 4, $ivSize * 4)
    );
}

public function cryptoJs_aes_decrypt($data, $key)
    {
        $data = base64_decode($data);
        if (substr($data, 0, 8) != "Salted__") {
            return false;
        }
        $salt = substr($data, 8, 8);
        // $keyAndIV = aes_evpKDF($key, $salt);
        $keyAndIV = $this->aes_evpKDF($key, $salt);
        $decryptPassword = openssl_decrypt(
            substr($data, 16),
            "aes-256-cbc",
            $keyAndIV["key"],
            OPENSSL_RAW_DATA, // base64 was already decoded
            $keyAndIV["iv"]
        );
        return $decryptPassword;
    }

    //login page load function
    public function payment()
    {
        $publicKey = 'lbwyBzfgzUIvXZFShJuikaWvLJhIVq36';
        $secretForHashing = 'bwebuwbeudbwedybewudew';

        $encryptedData= $_GET['data'];


        $decryptedData = $this->cryptoJs_aes_decrypt($encryptedData, $publicKey);

        //remove signature form json

        $newData = json_decode($decryptedData);

        try{
            $signature = $newData->signature;
          }catch(Exception $e){
            return view('pages.payment.errorpage');
        }

        unset($newData->signature);

        $stringData = json_encode($newData);


        $serverSignature = hash_hmac('sha256', $stringData, $secretForHashing);

        if($signature == $serverSignature) {
            return view('pages.payment.payment', compact('decryptedData'));
        }else {
            return view('pages.payment.errorpage');
        }


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
