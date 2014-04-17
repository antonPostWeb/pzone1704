<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $restful = true;
	
	public function get_allclients()
	{
		
		return View::make('admin/allclients');
		
	}
	
	public function get_recovery()
	{
		
		return View::make('admin/recovery');
		
	}
	
	public function get_yesrecovery($id)
	{
		
		$user = Useremergencyexit::find($id);
		
		$rec_user = new User;
		$rec_user->id = $user->user_id;
		$rec_user->role_id = $user->role_id;
		$rec_user->password = $user->password;
		$rec_user->username = $user->username;
		$rec_user->firstname = $user->firstname;
		$rec_user->lastname = $user->lastname;
                $rec_user->email = $user->email;
		$rec_user->save();
		$user->delete();
		
                
                $data = array(
		'detail'=>'Вы восстановлены в Pzone Project.Проследуйте по ссылке http://pzone.postweb.ru',
		'name'  => $user['name'],
		);
 
		$email = Input::get('email');
		Mail::send('emails.welcome', $data, function($message) use ($user)
		{
		$message->from('PostWebChat@yandex.ru', 'IamPzone');
		$message->to($user['email'], $user['name'])->subject('PZone project');
		});
                
		return View::make('admin/recovery');
		
	}
	
	
	public function get_allmanagers()
	{
		return View::make('admin/allmanagers');
	}
	

	public function get_delpassword($client_id)
	{
		$cur_client = User::find($client_id);
		$email = $cur_client->email;
		$login = $cur_client->username;
		
		$cur_client->role_id = 0; //Роль если сбросили пароль, потом используем в AuthController
		$cur_client->password = 0; //Пароль сбросили
		$cur_client->save();
	
	    	
		$user = array(
		'email'=>$email,
		'name'=>$login,
		);
 
		
		$data = array(
		'detail'=>'Ваш пароль сброшен. Для установления нового пароля проследуйте по ссылке http://pzone.postweb.ru',
		'name'  => $user['name'],
		);
 
		$email = Input::get('email');
		Mail::send('emails.welcome', $data, function($message) use ($user)
		{
		$message->from('PostWebChat@yandex.ru', 'IamPzone');
		$message->to($user['email'], $user['name'])->subject('PZone Project');
		});
		
		
		return Redirect::to('admin/allclients');
			
	}
	
	
	public function get_profile($client_id)
	{
		return View::make('admin/profile')
		   ->with('client_id',$client_id);
	}
	
	public function get_profilemanager($manager_id)
	{
		return View::make('admin/profilemanager')
		   ->with('manager_id',$manager_id);
		   
	}
	
	public function post_profilemanager()
	{
		$manager_id = Input::get('manager_id');
		$del_last_rows = ClientManager::where('manager_id','=',$manager_id)->delete();
		$tagsSelect = Input::get('tagsSelect');
		if (isset($tagsSelect)){
			foreach ($tagsSelect as $item){
			$new_row = new ClientManager;
			$new_row->manager_id = $manager_id;
			$new_row->client_id = $item;
			$new_row->save();
			}
		}
		Return Redirect::to('admin/allmanagers');
	}
	
	
	public function get_seereq($req_id)
	{
	
			return View::make('admin/seereq')
					->with('req_id',$req_id);
	}
	
	
	public function get_newclient()
	{
		return View::make('admin/newclient');
		   
	}
	
		public function post_tempuser()
	{
		$login = Input::get('login');
		$email = Input::get('email');
		$manager = Input::get('manager');
		$clientmanager = new UsersTemp;   
		$clientmanager->login =  $login;
		$clientmanager->email =  $email;
		$clientmanager->manager_id =  $manager;
		if ($clientmanager->save()) { 
		$user = array(
		'email'=>$email,
		'name'=>$login,
		);
 
		
		$data = array(
		'detail'=>'Добро пожаловать в Pzone project.http://pzone.postweb.ru/tempuser',
		'name'  => $user['name'],
		);
 
		$email = Input::get('email');
		Mail::send('emails.welcome', $data, function($message) use ($user)
		{
		$message->from('PostWebChat@yandex.ru', 'IAmPzone');
		$message->to($user['email'], $user['name'])->subject('PZone project!');
		});
		return Redirect::to('admin/allclients');
		}
	}
	
	public function get_newmanager()
	{
		return View::make('admin/newmanager');
		   
	}
	public function post_newmanager()
	{
	
	
		$login = Input::get('login');
		$password = input::get('password');
		$email = Input::get('email');
		$firstname = Input::get('firstname');
		$lastname = Input::get('lastname');
		$input = Input::all();
		if (isset($input['projectmanager'])){
		$role_id = 2; //Project Manager
		} elseif (isset($input['clientmanager'])){
		$role_id = 3; //client manager
		}
		$newuser = new User;                          
		$newuser->username = $login;
		$newuser->password = Hash::make($password);
		$newuser->email = $email;
		$newuser->firstname = $firstname;
		$newuser->lastname = $lastname;
		$newuser->role_id = $role_id;
		$newuser->save();
	
		Return Redirect::to('admin/allclients');
		
	}
	
	public function get_altermanager($client_id)
	{
	
	
		return View::make('admin/altermanager')
				->with('client_id',$client_id);
		   
	}
	
	
	public function post_altermanager()
	{
		$manager_id = Input::get('manager_id');
		$client_id  = input::get('client_id');
		$client_exist_in_table = ClientManager::where('client_id','=',$client_id)->first();
		if (isset($client_exist_in_table)){
		$client_exist_in_table->manager_id = $manager_id;
		$client_exist_in_table->save();
		} else {
		$client_isnt_in_table  = new ClientManager;
		$client_isnt_in_table->client_id = $client_id;
		$client_isnt_in_table->manager_id = $manager_id;
		$client_isnt_in_table->save();
		}
		
		Return Redirect::to('admin/allclients');
		
		
		   
	}
	
	
	
}	