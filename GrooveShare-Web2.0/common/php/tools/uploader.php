<?php

session_start();
if(!isset($_SESSION['login']))
{
	header('Location: ../../../index.php');
	die("Acces restreint.");
}

/*
 * $_REQUEST['fileext'] = extensions autorisées, exemple "*.jpg;*.jpeg;*.png"
 * $_REQUEST['folder'] = dossier de destination de l'upload
 * $_REQUEST['newFileName'] = nouveau nom de fichier (si on ne veut pas renommer, ne pas affecter de vleur)
 */
if (!empty($_FILES)) {

	$tempFile = $_FILES['Filedata']['tmp_name'];
	$fileParts  = pathinfo($_FILES['Filedata']['name']);

	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$targetPath = str_replace('//','/',$targetPath);

	//$targetPath = dirname($_SERVER['SCRIPT_FILENAME'])."/../../audio/";
	$targetFile =  $targetPath . (isset($_REQUEST['newFileName']) ? $_REQUEST['newFileName'].".".$fileParts['extension'] : $_FILES['Filedata']['name']);

	$fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	$fileTypes  = strtolower($fileTypes);
	$fileTypes  = str_replace(';','|',$fileTypes);
	$typesArray = mb_split('\|',$fileTypes);

	if (in_array(strtolower($fileParts['extension']),$typesArray))
	{
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);

		if(file_exists($targetFile))
		{
			echo "<custom_message>Un fichier " . $fileParts['basename'] . " existse déja sur le serveur.</custom_message>";
		}
		elseif(move_uploaded_file($tempFile,$targetFile))
		{
			echo "true";
		}
		else
		{
			$max_upload = (int)(ini_get('upload_max_filesize'));
			$max_post = (int)(ini_get('post_max_size'));
			$memory_limit = (int)(ini_get('memory_limit'));
			$upload_mb = min($max_upload, $max_post, $memory_limit);
			echo "<custom_message>Le fichier " . $fileParts['basename'] . " n'a pas pu être téléchargé. Verifiez qur le repertoire ".$_REQUEST['folder']." existe, et a bien les droits en lecture/ecriture. Vérifiez également que votre fichier ne dépasse pas ".$upload_mb." MB</custom_message>";
		}

	} else {
		echo "<custom_message>Le type du fichier " . $fileParts['basename'] . " n'est pas autorisé.</custom_message>";
	}
}
?>