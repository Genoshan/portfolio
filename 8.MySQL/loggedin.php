<?php

	setcookie("id", "1234", time()+60*60*24); // setea el ttl de la cookie a 24 horas

	echo $_COOKIE['id'];

?>