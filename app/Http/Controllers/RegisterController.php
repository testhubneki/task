<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\CheckUserController;
use App\Http\Controllers\UrlController;

class RegisterController extends Controller
{
	//properties
    private $check_user;
    private $url;

	//construct 
    public function __construct(CheckUserController $check_user,  UrlController $url  ){
        $this->check_user = $check_user;
        $this->url = $url;
    }

	
	 /*
	 *@paramIn($request)-check data request is it valid
	 *@return check user by credential if is bad credential return page with error else return pages with active unique links
	 */
    public function index(RegisterRequest $request)
    {
        $validated = $request->validated();
        $username = $request->username;
        $phone_number =$request->phone_number;
        $user  = $this->check_user->checkUser($username, $phone_number);
    
        $url['url'] = ($user) ? $this->url->getUserUrl($user->id) : NULL;
        $data['user']  = [$user];
        $pages = (empty($user)) ?  view('pages.error') :  view('pages.lucky', $data, $url);
        return $pages;
       
    }

}
