<?php 

session_start();

/*OVDJE POCINJE DIO ZA DINAMICKI PRIKAZ*/

if (isset($_POST['username'])){
	if (($_POST['username'] == 'admin') && ($_POST['password'] == 'admin')){
	
	$_SESSION['logiran']='DA';
	$_SESSION['vrijeme']=time();
	$_SESSION['vrsta']='admin';
	}
	else {
	if(($_POST['username'] == 'korisnik') && ($_POST['password'] == 'korisnik')){
	
		$_SESSION['logiran']='DA';
		$_SESSION['vrijeme']=time();
		$_SESSION['vrsta']='korisnik';
		}
	else {
		echo "Netocno korisnicko ime i/ili lozinka<br>";
		}
	}
}

if (isset($_SESSION['logiran'])) {
//ako je korisnik logiran onda ga pustamo na ovaj dio stranice, inace ga odbijemo sa upozorenjem
require_once('connection.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
  $controller = $_GET['controller'];
  $action     = $_GET['action'];
} else {
  $controller = 'pages';
  $action     = 'home';
}

require_once('views/layout.php');
}

else {
echo "Niste prijavljeni..<br>";
echo "<h2 style='margin:auto;max-width:300px;color:green;'>Prijavite se</h2><br>";
echo "<form name= action=\"index.php\" method=\"POST\" style='margin:auto;max-width:500px;'>
			<table>
				<tr>	
					<td>Korisnicko ime</td>
					<td><input type=\"text\" name=\"username\" size=\"20\"></td>
				</tr>
				<tr>
					<td>Lozinka</td>
					<td><input type=\"password\" name=\"password\"  size=\"22\"></td>
				</tr>
				<tr>
					<td colspan=\"2\" align=\"center\">
								<input type=\"submit\" name=\"submit\" value=\"Podnesi ->\" style='color:white;background-color:green;'></td>
				</tr>
			</table>
		</form>";
} 
