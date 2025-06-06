<?php


namespace App\Http\Controllers\Eventee;

use App\Event;
use App\Http\Controllers\Controller;
use App\NetworkingTable;
use App\Participant;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\LoungeFormRequest;


class LoungeController extends Controller
{
    public function index($id)
    {
        $tables = NetworkingTable::where("event_id",$id)->orderBy('seats', 'asc')->get();
        return view("eventee.lounge.list")->with(compact(["tables","id"]));
    }
    public function create($id)
    {
        return view("eventee.lounge.createForm")->with(compact(["id"]));
    }

    public function store($id,Request $request)
    {
        // if(empty($request->name)){
        //     flash("Name Field Cannot Be Left Blank")->error();
        //     return redirect()->back();
        // }
        // else if(empty($request->seats)){
        //     flash("Seats Field Cannot Be Left Blank")->error();
        //     return redirect()->back();
        // }
        
      
        $network = NetworkingTable::create([
            "name"=>$request->name,
            "seats"=>$request->seats,
            "meeting_id"=>$request->meetingId,
            "event_id"=>$id,
            "logo"=> isset($request->logo_url)? $request->logo_url: null
        ]);
        $network->save();
        // dd("done");
        return redirect(route("eventee.lounge.index",$id));
        // dd($request->all());
    }


    public function edit(NetworkingTable $table,$id)
    {
        return view("eventee.lounge.edit")->with(compact(["table","id"]));
    }


    public function update(Request $request,NetworkingTable $table,$id)
    {
        // dd($request->all());
        $table->name = $request->name;
        $table->seats = $request->seats;
        if($request->has('logo_url')){
            $table->logo = $request->logo_url;
        }
        $table->save();
        return redirect(route("eventee.lounge.index",$id));
    }
    public function appParticipant(Request $request,NetworkingTable $table, $user,$subdomain)
    {
        $participant = Participant::where("table_id",$table->id)->where("user_id",$user)->first();
        if($participant){
            $participant->update(["user_id"=>$user,"updated_at"=>Carbon::now("UTC")]);
        }else{
            $table->participants()->create([
                "user_id"=>$user
            ]);
        }
        return true;
    }
    public function removeParticipant(Request $request,NetworkingTable $table, $user,$subdomain)
    {
        Participant::where(["table_id"=>$table->id,"user_id"=>$user])->delete();
        return true;
    }

    public function updateLounge($subdomain)
    {
        $event = Event::where("slug",$subdomain)->first();
        Participant::where("updated_at", '<=', Carbon::now("UTC")->subtract('30','seconds'))->delete();

        $tables =  NetworkingTable::where("event_id",$event->id)->orderBy('seats', 'asc')->get();
        
        $tables->load(["participants.user"]);
        // dd($tables);

        
        return view("event.modules.loungeTables")->with(compact("tables"));
    }
//     public function updateLounge($subdomain)
//     {
//         $event = Event::where("slug",$subdomain)->first();
//         Participant::where("updated_at", '<=', Carbon::now("UTC")->subtract('30','seconds'))->delete();

//         $tables =  NetworkingTable::where("event_id",$event->id)->get();
        
//         $tables->load(["participants.user"]);
//         // dd($tables)

//         // foreach($tables as $i=> $table){
//         //     $participants = [];
//         //     foreach($table->participants as $participant){
//         //         array_push($participants,$participant->user);
//         //     }
//         //     // $tables[$i]->participantss = $participants;
//         //     $tables[$i]->participants = [];
//         // }

//         $html = <<<HTML
//             <div class="lounge_container">
// HTML; 




//         foreach($tables as $i=>$table){

//             $avs = $table->availableSeats();
//             $html = $html . <<<HTML
//                         <div class="table_container">
//                             <a class="lounge_meeting"   data-toggle="modal" data-table="$table->id" data-target="#lounge_modal"  data-meeting="$table->meeting_id">$table->name</a>
//                             <span> Total Seats: $table->seats</span>
//                             <span> Available Seats: $avs</span>
//                             <ul>
//                     HTML;
//             $participants = $table->participants()->get()->load(["user"]);
//             for($i = 0;$i<$table->seats ;$i++){
//                 $participant = isset($participants[$i])?$participants[$i]:null;
//                 $n = $i+1;
//                 if($participant!==null){

//                 $name = $participant->user->name." ".$participant->user->last_name;
//                 $src = $participant->user->profileImage? assetUrl($participant->user->profileImage):null;
//                 $html = $html . <<<HTML
//                             <div>                 
//                         HTML;           
//                 if($src){
//                     $html = $html . <<<HTML
//                         <img width="30" class="profile_image" src="$src">                    
//                     HTML;           
//                 }
//                 $html = $html . <<<HTML
//                                     $name
//                                 </div>     
//                         HTML;           
//                 }else{
//                     $html = $html . <<<HTML
//                     <div> Seat $n  </div>               
//                 HTML;     
//                 }

//             }
//             $html = $html . <<<HTML
//                             </ul>
//                         </div>
//                     HTML;
//         }

//         $html = $html . <<<HTML
//         </div>
// HTML;

    
//     return $html;
//     }






    public function destroy($id,NetworkingTable $table)
    {
        // dd($table);
        $table->delete();
        return true;
    }

    public function BulkDelete(Request $req){
        $ids = $req->ids;
        $totalcount = 0;
        for($i = 0 ; $i < count($ids); $i++){
            $page = NetworkingTable::findOrFail($ids[$i]);
            $page->delete();
            $pageCount = NetworkingTable::where('id',$ids[$i])->count();
            if($pageCount > 0){
                $totalcount++;
            }

        }
        if(($totalcount)>0){
        return response()->json(['code'=>500,"Message"=>"Something Went Wrong"]);
        }
        else{
        return response()->json(['code'=>200,"Message"=>"Deleted SuccessFully"]);
        }
    }
    public function DeleteAll(Request $req){
        $tables = NetworkingTable::where('event_id',$req->id)->get();
        foreach($tables as $table){
            $table->delete();
        }
        return response()->json(['code'=>200,"Message"=>"Deleted SuccessFully"]);
    }

}
