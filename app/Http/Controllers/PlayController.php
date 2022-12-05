<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\CheckUserController;
use App\Models\Url;
use App\Models\History;

class PlayController extends Controller
{

	//properties
    private $url;
    private $check_user;
    private $active = 1;
	
	//construct 
    public function __construct(UrlController $url, CheckUserController $check_user)
    {
        $this->url = $url;
        $this->check_user = $check_user;
    }
    
    /*
	*@paramIn($id) int 
	*@paramIn($id_url) int
	*@return views play withunique url
	*/
    public function play($id, $id_url)
    {
        $check_link = $this->url->checkLink($id, $id_url);//check if link is active
        if($check_link === false){
            return  view('pages.expired');
        }
        $date['date'] =['id'=>$id, 'id_url'=>$id_url];
        return  view('pages.play', $date);
    }

	 /*
	 *@paramIn($id) int 
	 *@paramIn($id_url) int
	 *create unique link
	 *@return views with user data and unique active link
	*/
    public function create($id, $user_id)
    {
        $link = $this->check_user->createUniqueUrl(); //create unique links
        Url::create([
            'user_id' => $id,
            'unique_link'=>$link
        ]);

        $user = $this->check_user->checkUserById($user_id);
        $url['url'] =  $this->url->getUserUrl($user_id) ;
        $data['user']  = [$user];
        return view('pages.lucky', $data, $url);
    }
	
	 /*
	 *deactivate links
	 *@paramIn($id) int 
	 *@paramIn($id_url) int
	 *@return views show active links
	*/
    public function deactivate($id, $user_id)
    {
        URL::where('id', $id)
        ->where('active', $this->active)
        ->update(['active' => 0]);
        
        $user = $this->check_user->checkUserById($user_id);
        $url['url'] =  $this->url->getUserUrl($user_id) ;
        $data['user']  = [$user];
        return view('pages.lucky', $data, $url);
       
    }

	/*
	 *@paramIn($id)int 
	 *@paramIn($id_url) int
	 *create rand number, amount by number insert data
	 *@return views with number, result and amount
	*/
    public function lucky($id, $id_url)
    {
        $date['date'] =['id'=>$id, 'id_url'=>$id_url];
        $rand = rand(0,1000); //rand number
        $amount = $this->checkResult($rand); //check amount by result
       
        $result = ($rand === 0) ? 'Lose' : 'Win';
		//insert into table
        History::create([
            'user_id' => $id,
            'url_id'=>$id_url,
            'rand'=>$rand,
            'result'=>$result,
            'amount'=>$amount
        ]);
		
        $res['res'] = ['amount'=>$amount, 'res'=>$result, 'rand'=>$rand];
        return  view('pages.play', $date, $res);
    } 


	 /*
	 *@paramIn($rand) int
	 *return amount by number using function calculatePercent;
	 */
    private function checkResult($rand)
    {
        $amount_win = 0;
      
        if($rand === 0)
        {
            $amount_win = 0;
        }
        if($rand > 900)
        {
            $amount_win = $this->calculatePercent(70,$rand);
        
        }
        if($rand > 600 && $rand < 901)
        {
            $amount_win = $this->calculatePercent(50,$rand);
        }
        if($rand > 300 && $rand < 601)
        {
            $amount_win = $this->calculatePercent(30,$rand);
        }
        if($rand < 301 )
        {
            $amount_win = $this->calculatePercent(10,$rand);
        }

        return $amount_win;
    }

	/*
	 *@paramIn($percante ) int
	 *@paramIn($number ) int
	 *@return amount by percente
	 */
    private function calculatePercent($percente, $number)
    {
        $calculate  = (($percente/100)* $number);
        return $calculate;
    }

	 /*
	 *@paramIn($id ) int
	 *@paramIn($id_url) int
	 *@return vew history select last 3 records 
	 */
    public function history($id, $id_url) 
    {
        $history = History::where('user_id', $id)->where('url_id',$id_url) ->orderBy('created_at', 'desc')->limit(3)->get();
        $data['history']=$history;
        return  view('pages.history', $data);
    }


	 /*
	 *@paramIn($id ) int
	 *@paramIn($id_url) int
	 *@return page with active links for user 
	 */
    public function back($id, $user_id)
    {
        $user = $this->check_user->checkUserById($user_id);
        $url['url'] =  $this->url->getUserUrl($user_id) ;
        $data['user']  = [$user];
        return view('pages.lucky', $data, $url);
    }
    
}
