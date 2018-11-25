<?php

	require_once 'contacts.php';
	$required = array('name','mobile');


	  $error = false;
	  foreach($required as $field) {
	      if (empty($_POST[$field])) {
	        $error = true;
	   }
	  }

	  if ($error) {
	      header("Location: addnew.php?error=All data are required");
	  } 
	  elseif (isset($_POST['add'])) {
	    extract($_POST);
	        session_start();
	        $conn=mysqli_connect('localhost','root','1','newcontacts');
	        if(mysqli_connect_errno())
	        {
	          $connection_error=mysqli_connect_error();
	          die(header("Location: addnew.php?error=$connection_error"));
	        }
	        $user_id=$_SESSION['user_id'];

		$new_contact=new Contact();
		$new_contact->user_id=$user_id;
		$new_contact->name=$name;

		$id=$new_contact->insert();
		header('Location: index.php');
	}

	