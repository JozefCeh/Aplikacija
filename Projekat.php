<?php 
//počinjanje sesije i proveravanje dali je korisnik prijavljen
session_start();
if(!isset($_SESSION["sess_user"])){
	header("location:login.php");
} else {
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Podaci o kupcu</title>
</head>
<body style = "background-color:Lavender">
<h2 style = "font-family:arial color:DarkBlue">
Unos-ažuriranje podataka o kupcima.<br>
Dobrodošli,<?=$_SESSION['sess_user'];?>!</h2>
<form method ="post" action ="Projekat.php">
<?php	
//Konektovanje na MYSQL
if(!($DB = mysql_connect("localhost","root","")))
die("Ne može se izvršiti konekcija na MYSQL server");
//"otvaranje" baze podataka
if(!mysql_select_db("biznis",$DB))
die("Ne može se otvoriti baza podataka");
//deklarisanje i inicijalizovanje promenljivih
$ID_KUPCA="";
$IME="";
$PREZIME="";
$TELEFON="";
//ako je korisnik kliknuo na dugme "TRAŽI Prez"
IF(ISSET($_POST['TRAZI']))
{
$upit ="SELECT * FROM kupac WHERE prezime LIKE '".$_POST['PREZIME']."'";
if(!($rezultat=mysql_query($upit,$DB))){
print("Ne moze se izvrsiti upit!<br/>");
die(mysql_error());
}
if(!($RED=MYSQL_FETCH_ASSOC($rezultat))){
print("Nema trazenog kupca!<br/>");
die(mysql_error());
}
ELSE
{
$ID_KUPCA=$RED['ID_kupca'];
$IME=$RED['Ime'];
$PREZIME=$RED['Prezime'];
$TELEFON=$RED['Telefon'];
}
}
ELSEIF(ISSET($_POST['TRAZI1']))
{
//ako je korisnik kliknuo na dugme "TRAZI ID_kupca"
$upit1="SELECT * FROM kupac WHERE ID_kupca LIKE '".$_POST['ID_KUPCA']."'";
if(!($rezultat1=mysql_query($upit1,$DB))){
print("Ne moze se izvrsiti upit!<br/>");
die(mysql_error());
}
if(!($RED=MYSQL_FETCH_ASSOC($rezultat1))){
print("Nema trazenog kupca!<br/>");
}
ELSE
{
$ID_KUPCA=$RED['ID_kupca'];
$IME=$RED['Ime'];
$PREZIME=$RED['Prezime'];
$TELEFON=$RED['Telefon'];
}
}
ELSEIF(ISSET($_POST['DODAJ']))
{
//ako je korisnik kliknuo na dugme "DODAJ"
IF((!$_POST['ID_KUPCA'])||(!$_POST['IME'])||(!$_POST['PREZIME'])||(!$_POST['TELEFON']))
{
echo"Mora biti uneto ID_kupca, ime, prezime i telefon!";
}
else
{
$upitdod="INSERT INTO kupac
(ID_kupca,Ime,Prezime,Telefon)
VALUES('".$_POST['ID_KUPCA']."','".$_POST['IME']."','".$_POST['PREZIME']."','".$_POST['TELEFON']."')";
IF(!($rezultatd=mysql_query($upitdod,$DB))){
print("Ne moze se izvrsiti upit!<br/>");
die(mysql_error());
}
$MESSAGE="SLOG DODAT";
}
}
ELSEIF(ISSET($_POST['AZURIRAJ']))
{
//ako je korisnik kliknuo na dugme "AŽURIRAJ"
if((!$_POST['ID_KUPCA'])||(!$_POST['IME'])||(!$_POST['PREZIME'])||(!$_POST['TELEFON']))
{
echo"Mora biti uneto ID_kupca, ime, prezime i telefon!";
}
else
{
$upitaz="UPDATE kupac
SET Prezime='".$_POST['PREZIME']."',
Ime='".$_POST['IME']."',
Telefon='".$_POST['TELEFON']."'
WHERE ID_kupca='".$_POST['ID_KUPCA']."'";
if(!($rezultataz=mysql_query($upitaz,$DB))){
print("Ne može se izvršiti AŽURIRANJE u tabeli kupac!<br/>");
die(mysql_error());
}
$MESSAGE="SLOG AŽURIRAN";
}
$ID_KUPCA=$_POST['ID_KUPCA'];
$IME=$_POST['IME'];
$PREZIME=$_POST['PREZIME'];
$TELEFON=$_POST['TELEFON'];
}
ELSEIF(ISSET($_POST['OBRISI']))
{
//ako je korisnik kliknuo na dugme "OBRIŠI"
$upitbris="DELETE FROM kupac
WHERE ID_kupca='".$_POST['ID_KUPCA']."'";
if(!($rezultatbris=mysql_query($upitbris,$DB))){
print("Ne može se izvršiti brisanje!<br/>");
die(mysql_error());
}
//brisanje selktovanih podataka sa ekrana
//za slog koji je obrisan
$ID_KUPCA="";
$IME="";
$PREZIME="";
$TELEFON="";
$MESSAGE="SLOG OBRISAN";
}
$ID_KUPCA=TRIM($ID_KUPCA);
$IME=TRIM($IME);
$PREZIME=TRIM($PREZIME);
$TELEFON=TRIM($TELEFON);



?>
<table>
<col span="1" align="left">
<tr>
<td>ID_Kupca:</td>
<td><input name="ID_KUPCA" type="text" size="7"
value="<?php echo $ID_KUPCA?>"/></td>
<td>Telefon:</td>
<td><input name="TELEFON" type="numeber" size="30" min="3" max="9"
value="<?php echo $TELEFON ?>"/></td>
</tr>
<tr>
<td>Prezime:</td>
<td><input name="PREZIME" type="text" size="30"
value="<?php echo $PREZIME ?>"/></td>
<td>Ime:</td>
<td><input name="IME" type="text" size="30"
value="<?php echo $IME ?>"/></td>
</tr>
</table>
<br>
<input type="submit" name="DODAJ" value="DODAJ"
style="background-color:black;
color:yellow;font-weight:bold"/>
<input type="submit" name="AZURIRAJ" value="AŽURIRAJ"
style="background-color:black;
color:yellow;font-weight:bold"/>
<input type="submit" name="OBRISI" value="OBRIŠI"
style="background-color:black;
color:yellow;font-weight:bold"/>
<br><br>
<input type="submit" name="TRAZI" value="TRAŽI Prez."
style="background-color:black;
color:yellow;font-weight:bold"/>
<input type="submit" name="TRAZI1" value="TRAŽI ID_Kupca"
style="background-color:black;
color:yellow;font-weight:bold"/>
<br><br>
<a href="logout.php">Logout</a>
<?php
if(ISSET($MESSAGE))
{
ECHO"<BR><BR>$MESSAGE";
}
?>
</form>
</body>
</html>
<?php
}
?>