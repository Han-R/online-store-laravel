<?php

namespace App\Http\Controllers\WEB\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewPostNotification;

use App\User;
use App\Models\NotificationMessage;
use App\Models\Token;
use App\Models\Category;
use App\Models\DepartmentUsers;


class NotificationMessageController extends Controller
{


    public function index(Request $request)
    {
        $items = NotificationMessage::query()->orderBy('id', 'Desc')->paginate(10);
        //return $items;
        return view('admin.notifications.home', [
            'items' => $items,
        ]);
    }

    public function create()
    {
        $notifications = NotificationMessage::all();
$departments = Category::all();

        return view('admin.notifications.create',[
'notifications'=>$notifications,
'categories'=>$departments]);
    }

  public function store(Request $request)
    {
        $roles = [
        'message' => 'required',
        'type' => 'required',
        ];

        if($request->type == 1){
            $roles = [
            'category' => 'required',
            ];
        }
        if($request->type == 1){
            foreach($request->category as $one){
                $notifications= New NotificationMessage ;
                $notifications->message = $request->message;
                $notifications->type = $request->type;
                $notifications->category = $one;
                $notifications->save();
            }
         
        }else{
            $notifications= New NotificationMessage ;
            $notifications->message = $request->message;
            $notifications->type = $request->type;
            $notifications->save();
        }
        $message = $request->message ;
        if($request->type == 0){
            $user_ides = User::where('admin',0)->pluck('id')->toArray();
        }elseif($request->type == 1){
            if($request->category  and $request->category != ''){
                $user_ides  = DepartmentUsers::whereIn('category_id',$request->category)->pluck('user_id')->toArray();
            }else{
                $user_ides = User::where('admin',1)->pluck('id')->toArray();
            }
        }else{
            $user_ides = User::where('id','>',0)->pluck('id')->toArray();
        }
        $token_android = Token::whereIn('user_id',$user_ides)->where('accept',1)->where('type','android')->pluck('token')->toArray();
        $token_iphone = Token::whereIn('user_id',$user_ides)->where('accept',1)->where('type','ios')->pluck('token')->toArray();
        //return $token_android;
        
         if ($token_android == '' and $token_iphone == '') {
           exit();
       }
   

       $this->fcmPush( $token_android, $token_iphone , $message);
       
    
   
       return redirect()->back()->with('status', __('common.create'));
    }
  
 
  


function fcmPush($token_android, $token_iphone,$message_notification)
    {

        try {


            $API_ACCESS_KEY = 'AAAAA9B-PVg:APA91bGTqpJ0UzvfOX4EEJj35i2I-EzJQlF7tOFtyp6nvwlrdfGFEPnhKvDPATQyRLLRvJ0hSfe62HjFXVIZurCMAQsLjVwKZFfUkXJVCmMzmpARiBRjQFQ6MCbZixk9sZFlNX7wMU8F
Legacy server key
AIzaSyD8hgpomB0NfHw4qFWIUaUhgFqzampKVWM';

            $msg = [
                'body' => $message_notification,
                'type' => "notify",
                'custom_type' => 1,
                'title' => 'ENJAZ',
                'badge' => 1,
                'icon' => 'myicon',//Default Icon
                'sound' => 'mySound'//Default sound
            ];
            //return $msg;
           
            $headers = [
                'Authorization: key=' . $API_ACCESS_KEY,
                'Content-Type: application/json'
            ];


            $data= [
                "registration_ids"=> $token_android,
                "data"=>[
                    'body' => $message_notification,
                    'type' => "notify",
                    'title' => 'ENJAZ',
                    'badge' => 1,
                    'icon' => 'myicon',//Default Icon
                    'sound' => 'mySound'//Default sound
                ]
            ];

            //return $data;
            $notification= [
                "registration_ids"=> $token_iphone,
                "notification"=>[
                    'body' => $message_notification,
                    'type' => "notify",
                    'title' => 'ENJAZ',
                    'badge' => 1,
                    'icon' => 'myicon',//Default Icon
                    'sound' => 'mySound'//Default sound
                ]
            ];
            //return $notification;
            // return json_encode($data);
            if($token_android){

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                
                $result = curl_exec($ch);
                curl_close($ch);               
            }


            if($token_iphone){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));
                
                $result = curl_exec($ch);
                curl_close($ch);
                
            }
                        
            //return json_decode($result, true);
            //return back()->with('success', 'Edit SuccessFully');
            
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }


public function destroy($id)
    {
        $item = NotificationMessage::query()->findOrFail($id);
        if ($item) {
            NotificationMessage::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }


}
