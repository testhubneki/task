<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckUser;
use App\Models\Url;
use \DB;

class CheckUserController extends Controller
{ 
	//properties
    private $active = 1;

	/*
	*@paramIn($usernme) string 
	*@paramIn($phone_number) string
	*@return user data
	*/
    public function  checkUser($username, $phone_number)
    {
		
		
        $user = $this->selectUser($username, $phone_number);//Check if exist user by user name by function selectUser
        $user = (empty($user)) ?  $this->createUser($username, $phone_number) : $this->checkByCredential($username, $phone_number);//if not exist create user if exist check by credential  
        return $user;
    }

	/*
	*@paramIn($usernme) string 
	*@paramIn($phone_number) string
	*@return $data from user by $username
	*/
    protected function selectUser($username, $phone_number)
    {
        $user = CheckUser::where('username', $username)
        ->where('active', $this->active)
        ->first();
        return $user;
    }
	
	/*
	*@paramIn($usernme) string 
	*@paramIn($phone_number) string
	*@return data from user by $username and $phone_number
	*/
    protected function checkByCredential($username, $phone_number) 
    {
        $user = CheckUser::where('username', $username)
        ->where('phone_number', $phone_number)
        ->where('active', $this->active)
        ->first();
        return $user;
    }

	/*
	*@paramIn($usernme) string 
	*@paramIn($phone_number) string
	*@return create user by credentials, create unique url, using transaction
	*/
    protected function createUser($username, $phone_number)
    {
       $unique_url = $this->createUniqueUrl(); //unique url
       DB::beginTransaction();
       try {
			 //insert user, get his id	
             $user = CheckUser::create([
            'username' => $username,
            'phone_number'=>$phone_number
             ]); 
			 
            $lastId = $user->id;
			
			//select user data by id
            $data = CheckUser::where('id', $lastId)
            ->where('active', $this->active)
            ->first();
			
			//insert unique link for register user
            Url::create([
                'user_id' => $lastId,
                'unique_link'=>$unique_url
            ]);
            
            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
        }

        return $data;
    }


	/*
	*create unique link by encoding and random bytes and unique id
	*@return unique link
	*/
    public function createUniqueUrl()
    {
        $url =  base64_encode(openssl_random_pseudo_bytes(16)).uniqid();
        return $url;
    }

	/*
	*@paramIN($id) int
	*@return user by id 
	*/
    public function checkUserById($id)
    {
        $data = CheckUser::where('id',$id)
        ->where('active',$this->active)
        ->first();
        return $data;
    }    

   
}
