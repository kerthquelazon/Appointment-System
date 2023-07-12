<?php
    session_start();
    doLogout();
	function doLogout()
	{
		session_destroy();
        unset($_SESSION['id']);
        return true;
    }
    header('Location: index.php');
?>