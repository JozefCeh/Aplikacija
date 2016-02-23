
<html>
<head>
<title>Registracija</title>
</head>
<body>

<p><a href="register.php">Registracija</a> | <a href="login.php">Login</a></p>
<h3>Registration Form</h3>
<form action="" method="POST">
Username: <input type="text" name="user"><br />
Password: <input type="password" name="pass"><br />	
<input type="submit" value="Registracija" name="submit" />
</form>
<?php
if(isset($_POST["submit"])){
//ako je korisnik kliknuo na dugme submit(registracija)
if(!empty($_POST['user']) && !empty($_POST['pass'])) {
	$user=$_POST['user'];
	$pass=$_POST['pass'];
    //konektovanje na MYSQL i "otvaranje" baze podataka
	$con=mysql_connect('localhost','root','') or die(mysql_error());
	mysql_select_db('biznis') or die("Ne može se otvoriti baza podataka");

	$query=mysql_query("SELECT * FROM user WHERE username='".$user."'");
	$numrows=mysql_num_rows($query);
	if($numrows==0)
	{
	$sql="INSERT INTO user(username,password) VALUES('$user','$pass')";

	$result=mysql_query($sql);


	if($result){
	echo "Nalog je uspesno napravljen";
	} else {
	echo "Neuspeh!";
	}

	} else {
	echo "Ovaj username vec postoji! Probajte nesto drugo.";
	}

} else {
	echo "Sva polja su obavezna!";
}
}
?>

</body>
</html>