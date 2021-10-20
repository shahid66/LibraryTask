<?php

namespace App\Http\Controllers;

use App\IssueModel;
use App\MembarsModel;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    function Issue($id){
        return view('AddIssue',compact('id'));
    }
    public function getMemberData($id){
        $result =MembarsModel::where('id',$id)->first();
        return $result;
    }
    public function getLentData($user){
        $result =IssueModel::where('u_name',$user)->get();
        return $result;
    }

    function issueAdd(Request $request){


        $u_name=$request->input('u_name');
        $b_name=$request->input('b_name');
        $issue_date=$request->input('issue_date');
        $return_date=$request->input('return_date');
        $status=$request->input('status');
        $result=IssueModel::insert([
            'u_name'=>$u_name,
            'b_name'=>$b_name,
            'issue_date'=>$issue_date,
            'return_date'=>$return_date,
            'status'=>$status,
        ]);
        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
