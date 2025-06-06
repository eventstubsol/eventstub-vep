<?php

namespace App\Http\Controllers\Eventee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Leaderboard;
use App\LeadPoint;
use App\Image;
use App\User;
use App\Exports\LeaderboardExport;
use Maatwebsite\Excel\Excel;

class LeaderboardController extends Controller
{
    //
    public function index($id){
        $leaderSettings = Leaderboard::where('event_id',$id)->first();
        if(!$leaderSettings){
            createLeaderboard($id);
        }
        return view('eventee.leaderboard.index',compact('id','leaderSettings'));
    }
    public function clearleaderboard($id){
        User::where("event_id",$id)->update(["points"=>0]);
        return true;
        // $leaderSettings = Leaderboard::where('event_id',$id)->first();
        // if(!$leaderSettings){
        //     createLeaderboard($id);
        // }
        // return view('eventee.leaderboard.index',compact('id','leaderSettings'));
    }

    public function store(Request $request,$id){
        $color = $request->color;
        $img = $request->leaderboardUrl;
        $points = $request->points;
        $leaderBoard =new Leaderboard;
        $leaderBoard->color = $color;
        $leaderBoard->event_id = $id;
        if($leaderBoard->save()){
            if($img !== null){
                for($i = 0; $i < count($img) ;$i++){
                    if($img[$i] != null){
                        Image::create(['owner'=>$leaderBoard->id,'title'=>"lead_setting",'url'=>$img[$i]]);
                    }
                }
            }
            
            for($j = 0; $j < count($points) ; $j++){
                if($points[$j] != null){
                    LeadPoint::create(['owner'=>$leaderBoard->id,'point'=>$points[$j]]);
                }
            }
            flash("Data Uploaded Successfully")->success();
            return redirect()->route('eventee.leaderSetting',$id);
        }
        else{
            flash("Something Went Wrong")->success();
            return redirect()->back();
        }
    }

    public function update($id,$lead_id,Request $request){
        $color = $request->color;
        $img = $request->leaderboardUrl;
        $points = $request->points;
        $user_points = $request->user_points;
        $pointsstatus = $request->pointsstatus;
        // return $img;
        // dd($request->all());
        $leaderBoard = Leaderboard::findOrFail($lead_id);
       
        $leaderBoard->color = $color;
        
        if($leaderBoard->save()){
            $images = Image::where('owner',$leaderBoard->id)->delete();
           
            $pointCount = LeadPoint::where('owner',$leaderBoard->id)->update([
                "status"=>0
            ]);
            if($img !== null){
                for($i = 0; $i < count($img) ;$i++){
                    Image::create(['owner'=>$leaderBoard->id,'title'=>"lead_setting",'url'=>$img[$i]]);  
                 }
            }
            if($points !== null ){
                for($j = 0; $j < count($points) ; $j++){
                    if($pointsstatus[$j]!=="0"){
                        LeadPoint::where('id',$pointsstatus[$j])->update([
                            "point"=>$points[$j],
                            "user_points"=>$user_points[$j],
                            "status"=>1
                        ]);       
                    }
                }
            }
            
            flash("Data Updated Successfully")->success();
            return redirect()->route('eventee.leaderSetting',$id);
        }

    }

    public function DeletePoint(Request $req){
        $leadpoint = LeadPoint::findOrFail($req->id);
        if($leadpoint->delete()){
            return response()->json(['code'=>200,"message"=>"Point Have Been Deleted"]);
        }
        else{
            return response()->json(['code'=>500,"message"=>"Oops!Something Went Wrong"]);
        }
        
    }
    public function FileExcel($id,Excel $excel){
        
        return $excel->download(new LeaderboardExport($id),'leaderboardList.xlsx');
    }
}
