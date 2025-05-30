<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Event;
use App\UserSubtype;


class UserImport implements ToModel,WithHeadingRow
{
    use Importable;
    public function __construct($id)
    {
        $this->event_id = $id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::where('email',$row['email'])->where('event_id',$this->event_id);
        if($row["type"] == null){
            $row["type"] = 'attendee';
        }
        if($user->count() < 1){
            return new User([
                "name"=>$row["name"],
                "last_name" =>$row["last_name"],
                "email" =>$row["email"],
                "phone"=>$row["phone"]??'',
                "password" =>password_hash($row["password"]??'',PASSWORD_DEFAULT),
                "event_id"=> $this->event_id,
                "type" => $row["type"]??'attendee',
                "country" => $row["country"]??'',
                "subtype"=>$row['sub_type']??''
            ]);
        }
    
        
    }
}
