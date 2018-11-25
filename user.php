<?php
	require_once 'users.php';
	session_start();
	$conn=mysqli_connect('localhost','root','iti','blog');
	if(mysqli_connect_errno())
		die(mysqli_connect_error());

	if(isset($_POST['register'])) //registration form
	{
		// print_r($_POST);
		extract($_POST);
		$user = new User();
		$user->name=$name;
		$user->email=$email;
		$user->password=$password;
		$user->register();

		$_SESSION['user_id']=$user->id;
		$_SESSION['user_name']=$user->name;
		$_SESSION['user_email']=$user->email;

		header('Location: index.php');
		exit;
	}

	if(isset($_POST['login'])) // login form
	{
		extract($_POST);
		$query="select * from users where email='$email' and password='$password'";
		$result=mysqli_query($conn,$query);
		if(mysqli_errno($conn))
			die(mysqli_error($conn));
		if(mysqli_num_rows($result) == 0)
		{
			$_SESSION['error']='incorrect email or password.';
			header('Location: login.php');
		}
		$user=mysqli_fetch_assoc($result);
		$_SESSION['user_id']=$user['id'];
		$_SESSION['user_name']=$user['name'];
		$_SESSION['user_email']=$user['email'];
		if(isset($_POST['remember_me']))
		{
			setcookie('user_id',$user['id'],time()+60*60*24*5);
			setcookie('user_name',$user['name'],time()+60*60*24*5);
			setcookie('user_email',$user['email'],time()+60*60*24*5);
		}



		header('Location: index.php');


	}
	die('unauthorized!!');