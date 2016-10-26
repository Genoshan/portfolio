<?php

	$link = mysqli_connect("localhost", "cl29-example", "rm7n.q9bt", "cl29-example");

	
	if (mysqli_connect_error()) {

		die ("Could not connect to database");
	}

	//$query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Ian', 'iantest@gmail.com', 'apples')";

	//$query = "UPDATE `users` SET `email` ='iantest1@gmail.com' WHERE `id` = 2 LIMIT 1"; // solo actualiza uno en caso de no setear el where sin querer.

	//mysqli_query($link, $query);

	

	


	$query = "UPDATE `users` SET `name` ='Ian O\'Neil' WHERE id = 2 LIMIT 1";


	$query = "SELECT `name` FROM users" ;


	if ($result=mysqli_query ($link,$query)) {

		echo mysqli_num_rows($result);

		while ($row=mysqli_fetch_array($result) /* sera una row conteniendo el array del resultado de la consulta (query())*/ ) {

			print_r($row); // para imprimir arrays.

		};  

		


	} else {

		echo "It failed!";
	}
	
	
?>