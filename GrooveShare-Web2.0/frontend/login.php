<?php
session_start();
/* sécu:
 * empecher l'utilisateur de fournir un id de session,
 * celui-ci doit forcement être genere suite à une
 * authentification valide
 */
session_destroy();

if(isset($_POST['login']))
{
	$login = $_POST['login'];
	$password = $_POST['password'];

	if($login != $admin_login || $password != $admin_pass)
	{
		$notice = "<span class = 'errMsg'>Login ou mot de passe erronné.</span></br/>\n";
	}else
	{
		session_start(); // si l'utilisateur est OK, on génere une nouvelle session

		$_SESSION['login'] = $admin_login;
	}
}
echo "login controller not implented yet"
?>
