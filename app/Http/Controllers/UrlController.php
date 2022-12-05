<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Carbon\Carbon;
class UrlController extends Controller
{
	//properties
    private $active = 1;
    private $days =7;
 
	 /*
	 *@paramIn($id)- int 
	 *@return active  link by id
	 */
    public function getUserUrl($id)
    {  
        $url = Url::where('user_id', $id)->where('active',$this->active)->get();
        return $url;
    }

	 /*
	 *@paramIn($user_id)-int
	 *@paramIn($id_url)-int
	 *@return true or false if url still active 
	 */
    public function checkLink($user_id, $id_url) :bool
    {
        $status = NULL;
        $check = Url::where('user_id', $user_id)->where('id',$id_url)->where('active', $this->active)->first(); 
        if($check) {
            $date = $check->url_created_at;
            $diff = now()->diffInDays(Carbon::parse($date));
            $status = ($diff > $this->days) ? false : true;
        }else{
            $status = false;
        }
       
        return $status;
    }

 
    
}
