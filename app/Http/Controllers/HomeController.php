<?php

namespace App\Http\Controllers;

use App\MembarsModel;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('home');
    }

    public function getMemberData(){
        $result =MembarsModel::all();
        return $result;
    }

    function memberAdd(Request $request){


        $name=$request->input('name');
        $email=$request->input('email');
        $phone=$request->input('phone');
        $result=MembarsModel::insert([
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone
        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function memberDelete(Request $request){
        $id=$request->input('id');
        $result=MembarsModel::where('id','=',$id)->delete();
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function GetMemberDetails(Request $request){
        $id=$request->input('id');
        $result=MembarsModel::where('id','=',$id)->get();
        return $result;
    }

    function MemberDetailUpdate(Request $request){
        $id=$request->input('id');
        $e_name=$request->input('e_name');
        $e_email=$request->input('e_email');
        $e_phone=$request->input('e_phone');


        MembarsModel::where('id',$id)->update([
            'name'=>$e_name,
            'email'=>$e_email,
            'phone'=>$e_phone
        ]);

        return 1;

    }
}
