<?php namespace Auth;

use Auth as Auth;

class phpAuth
{
	/**
	 * [$username The username of the Person trying to log-into your App]
	 * @var [string]
	 */

	/**
	 * [$password The password of the User]
	 * @var [string]
	 */

	/**
	 * [$tableName The name of the Table to be worked with]
	 * @var [string]
	 */


	protected $username;
	protected $password;
	protected $tableName;
	protected $rememberToken;
	protected $userdetails;
    public $submitButton;

	public function __construct()
	{
		//Initialization of Connection details and stuffs.
		$user_details= require('/config.php');
		$this->userdetails=$user_details;
		$this->tableName=$user_details['connection_details']['users_table'];	
		
	}

	public function redirect($link)
	{
		return header("Location: $link");
	}

	public function rememberToken()
	{
		$selectedTable=$this->tableName;
		$rememberToken=sha1($this->password);
		$passwordName="password";
		$usernameName="username";
		$query="UPDATE $this->tableName SET remember_token='$rememberToken' WHERE username='$this->username' AND password='$this->password'";
		$updateToken=$this->userdetails['connectsqli']->query($query);
		if($updateToken)
			{
				session_start();
				$_SESSION['username']=$_POST['username'];
				$sessionUserName=$_SESSION['username'];
				die($this->isLoggedIn());
				$redirect= $this->redirect('home.php');
				return $redirect;

			}
			else
			{
				return false;
			}
	}

	public function isLoggedIn()
	{
		//Extends the time of the user.
		/** 
		* @var $remember_token.
		*
		*/
		$sessionUserName=$_SESSION['username'];
		$getUserWithSession= "SELECT * FROM $this->tableName WHERE username='$sessionUserName'";
		$querySession=$this->userdetails['connectsqli']->query($getUserWithSession)->fetch_assoc();
		
		//Compare sessions.
		if($_SESSION['username']==$querySession['username'])
		{
			//Meaning, the two shit is connected.
			echo "You are already Logged in";
		}
		else
		{
			return redirect('/');
		}

	

	}

	/**
	*@var No params.
	*Logs the user out from the Application.
	**/
	public function logout()
	{
		//Logs the user out from the Application
		session_destroy();
	}

	public function login($username=NULL,$password=NULL)
	{
		/**
		*[$username= NULL by default, $password= NULL,$remember_token=NULL]
		*@var username,password,remember_token
		*/
		
		$this->username=$username;
		$this->password=$password;
	

		//The Name of the Submit button must be 'submit'
		if(isset($_POST['submit']))
		{
			//Check for RM token
			$selectedTable=$this->tableName;
			$checkUser="SELECT * FROM $selectedTable WHERE username='$this->username' AND password='$this->password'";
			$search_checkUser=$this->userdetails['connectsqli']->query($checkUser);
			
			if($search_checkUser->num_rows==1)
			{
				//Check if he choose rem me.
				if(isset($_POST['remember_me']))
				{
					$this->rememberToken();
				}
				else
				{
					//if he doesn't click on remember Me. and onload.
					return true;	
				}
			}
			else
			{
				echo "I did not";
			}
			
		}

	}
}