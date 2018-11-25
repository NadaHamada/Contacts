<?php 
	
	class User
	{
		public $id;
		public $first_name;
		public $last_name;
		public $gender;
		public $username;
		public $password;

		static private $conn = null ;
		function __construct($id=-1)
		{
			if(!self::$conn)
			{
				self::$conn=mysqli_connect('localhost','root','1','newcontacts');
			}
			if ($id !=-1)
			{
				$query='select * from users where id=$id limit 1';
				$result=mysqli_query(self::$conn,$query);
				$user=mysqli_fetch_assco($result);
				$this->id=$post['id'];
				$this->firstname=$post['firstname'];
				$this->lastname=$post['lastname'];
				$this->gender=$post['gender'];
				$this->username=$post['username'];
				$this->password=$post['password'];
				

			}
		}

		function register(){
			$query="insert into users set first_name='$this->firstname' , last_name='$this->lastname' , gender='$this->gender' , username='$this->username' , password='$this->pass'";
			$result=mysqli_query(self::$conn,$query);
			if(mysqli_errno(self::$conn))
				return mysqli_error(self::$conn);

			$user_id=mysqli_insert_id(self::$conn);
				$this->id=$user_id;
			return $user_id;
		}
	}


?>