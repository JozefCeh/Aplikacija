
<html>
<head>
<title>Login</title>
</head>
<body>

<p><a href="register.php">Registracija</a> | <a href="login.php">Login</a></p>
<h3>Login Form</h3>
<form action="" method="POST">
Username: <input type="text" name="user"><br />
Password: <input type="password" name="pass"><br />	
<input type="submit" value="Login" name="submit" />
</form>
<?php
//ako je korisnik kliknuo na dugme Login(submit)
if(isset($_POST["submit"])){

if(!empty($_POST['user']) && !empty($_POST['pass'])) {
	$user=$_POST['user'];
	$pass=$_POST['pass'];
    //konektovanje na MYSQL i "otvaranje" baze podataka
	$con=mysql_connect('localhost','root','') or die(mysql_error());
	mysql_select_db('biznis') or die("Ne može se otvoriti baza podataka");

	$query=mysql_query("SELECT * FROM user WHERE username='".$user."' AND password='".$pass."'");
	$numrows=mysql_num_rows($query);
	if($numrows!=0)
	{
	while($row=mysql_fetch_assoc($query))
	{
	$dbusername=$row['username'];
	$dbpassword=$row['password'];
	}

	if($user == $dbusername && $pass == $dbpassword)
	{
	//počinjanje sesije
	session_start();
	$_SESSION['sess_user']=$user;

	/* preusmeravanje */
	header("Location: Projekat.php");
	}
	} else {
	echo "Nevazeci username ili password!";
	}

} else {
	echo "Sva polja su obavezna!";
}
}
?>

</body>
</html>