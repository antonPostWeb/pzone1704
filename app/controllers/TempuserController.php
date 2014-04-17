<?php

class TempuserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function get_index()
	{
		return View::make('tempuser/onlylogin');
	}

	
		public function post_checklogin()
	{
		$login = Input::get('login');
		$result = UsersTemp::where('login','=',$login)->first();
		If (($result != NULL)){
		$email = $result->email;
		$manager_id = $result->manager_id;
		return View::make('tempuser/passandlogin')
							->with('login',$login)
							->with('email',$email)
							->with('manager_id',$manager_id);
		} else {
		return View::make('tempuser/onlylogin');
		}
		
		
	}
	
	
		public function post_createnewuser()
	{
		$login = Input::get('login');
		$password = input::get('password');
		$email = Input::get('email');
		$firstname = Input::get('firstname');
		$lastname = Input::get('lastname');
		$manager_id = Input::get('manager_id');
		
		$newuser = new User;                          //Создали нового клиента
		$newuser->username = $login;
		$newuser->password = Hash::make($password);
		$newuser->email = $email;
		$newuser->firstname = $firstname;
		$newuser->lastname = $lastname;
		$newuser->role_id = 4;
		$newuser->save();
		
		$newclientmanager = new ClientManager;
		$user_id = DB::table('users')->max('id');
		$newclientmanager->client_id = $user_id;
		$newclientmanager->manager_id = $manager_id;
		$newclientmanager->save();
		
		
		
		
		//Теперь удалим данные из таблицы tempuser
		$willdeleteuser = UsersTemp::where('login','=',$login)->delete();
		//Вот  и удалили
		
		return Redirect::to('auth');
		
		
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