<?php

namespace App\Http\Controllers;

use App\BooksModel;
use Illuminate\Http\Request;

class BooksController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Books');
    }

    public function getBookData(){
        $result =BooksModel::all();
        return $result;
    }

    function bookAdd(Request $request){


        $name=$request->input('name');

        $result=BooksModel::insert([
            'b_name'=>$name,

        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function bookDelete(Request $request){
        $id=$request->input('id');
        $result=BooksModel::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function GetBookDetails(Request $request){
        $id=$request->input('id');
        $result=BooksModel::where('id','=',$id)->get();
        return $result;
    }

    function BookDetailUpdate(Request $request){
        $id=$request->input('id');
        $e_name=$request->input('e_name');



        BooksModel::where('id',$id)->update([
            'b_name'=>$e_name,

        ]);

        return 1;

    }
}
