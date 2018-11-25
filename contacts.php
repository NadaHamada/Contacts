<?php

	class Contact
	{
		public $id;
		public $name;
		public $mobile;
		public $email;
		public $country;
		public $city;
		public $street;
		public $user_id;

		static private $conn = null;

		function __construct($id=-1)
		{
			if(!self::$conn)
			{
				self::$conn=mysqli_connect('localhost','root','1','newcontacts');
			}
			if ($id !=-1)
			{
				$query='select * from contacts where id=$id limit 1';
				$result=mysqli_query(self::$conn,$query);
				$contact=mysqli_fetch_assco($result);
				$this->id=$post['id'];
				$this->name=$post['name'];
				$this->mobile=$post['mobile'];
				$this->email=$post['email'];
				$this->country=$post['country'];
				$this->city=$post['city'];
				$this->street=$post['street'];
				$this->user_id=$post['user_id'];
				

			}
		}
		function insert(){
			$query="insert into contacts set name='$this->name' , mobile='$this->mobile' ,email='$this->email', country='$this->country' , city='$this->city' , street='$this->street' ,user_id=$this->user_id ;";
			mysqli_query(self::$conn,$query);
			if (mysqli_errno(self::$conn))
				die(mysqli_error(self::$conn));
			$this->id=mysqli_insert_id(self::$conn);
			return $this->id;
		}

		function contacts(){
			$query='select * from contacts,users where contacts.user_id=users.id and contacts.user_id='.$_SESSION['user_id'].'  ;';
			$result=mysqli_query(self::$conn,$query);
			if(mysqli_errno(self::$conn))
				return mysqli_error(self::$conn);
			$contacts=mysqli_fetch_all($result,MYSQLI_ASSOC);
			return $contacts;
		}
	}


?>