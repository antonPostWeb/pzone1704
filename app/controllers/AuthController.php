<?php

class AuthController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function get_index()
	{
		return View::make('auth/onlylogin');
	}
	
	
	public function post_newpass()
	{
	    $password = Input::get('password');
	    $user_id = Input::get('user_id');
		$cur_user = User::find($user_id);
		$cur_user->password = Hash::make($password);
		$cur_user->role_id = 4;
		$cur_user->save();
		
		
		
		return Redirect::to('auth');
		
	}
	
	
	public function get_logout()
	{
	    
	    $cur_manager_id = Auth::user()->id;
        $user = User::find($cur_manager_id);
        $last_exit_time = time() - 900; 
        $user->last_activity2 = $last_exit_time;
        $user->save();
                
		Auth::logout();
		
		return Redirect::to('auth');
	}
	
        
        public function get_superlogout()
	{
                $cur_user_id = Auth::user()->id;
                $cur_user = User::find($cur_user_id);
                if(isset($cur_user->username)){
                    
                $email = $cur_user->email;
                $username = $cur_user->username;
                $role_id = $cur_user->role_id;
                $firstname= $cur_user->firstname;
                $lastname = $cur_user->lastname;
                $password = $cur_user->password;
                    
                } else {
                    
                   Auth::logout();
                   return Redirect::to('auth');
                   
                }
                
                
                if(!empty($username)){
                    
                    $user_emergency_exit = new Useremergencyexit;
                    $user_emergency_exit->user_id = $cur_user_id;
                    $user_emergency_exit->username = $username;
                    $user_emergency_exit->email = $email;
                    
                    $user_emergency_exit->role_id = $role_id;
                    $user_emergency_exit->firstname = $firstname;
                    $user_emergency_exit->lastname = $lastname;
                    $user_emergency_exit->password = $password;
                    
                    $user_emergency_exit->save();
                    
                }    
                
                User::find($cur_user_id)->delete();
                Auth::logout();
		return Redirect::to('auth');
                
		
              

                
	
	}
        
        
        
        
	public function post_onlylogin()
	{
	
	$username = Input::get('username');
	
	$results = User::where('username','=', $username) -> first();
	
	
		
		if (isset($results->id)) {
		    $user_id = $results->id;
		    if($results->role_id != 0 ) {
		        return View::make('auth/passandlogin')->with('username',$username);
		    } else {
		        
		        
		        return View::make('auth/newpass')->with('user_id',$user_id);
		        
		    }      
		} else {
		return View::make('auth/onlylogin');
		
		}
	
	
		
		
	}
	
	public function post_passandlogin()
	{
	
		$userdata = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
			//'remember' => (bool) Input::get('remember')
		) ;
	/*	
		$user = new User();
		$user->username     = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->save();
	*/	//Регистрация
	
	
		 if(Auth::attempt($userdata))
		{
		Session::put('ourkey',md5(Input::get('password')));
		$role = Auth::user()->role_id;
		

		
		
		if($role == 4){ //client
		return Redirect::to('client');
		} elseif($role == 2 or $role == 3) {
		return Redirect::to('manager');
		} elseif($role == 1) {
		return Redirect::to('admin/allclients');
		}
		
		} else {
		return Redirect::to('/');
		}
		
		
	}
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}