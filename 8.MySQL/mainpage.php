<?php
	
	session_start();

	include("connection.php");

	$query= "SELECT diary FROM users WHERE id='".$_SESSION['id']."' LIMIT 1";

	$result = mysqli_query ($link, $query);

  $row = mysqli_fetch_array($result);

	$diary=$row['diary'];



 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Diario Secreto</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <style>

      .navbar-brand {
        font-size: 1.8em;
      }   

      #topContainer{
        background-image: url("images/bkg1.jpg");
        height:500px;
        width:100%;
        background-size: cover;

      }

      #topRow {
        margin-top:80px;
        text-align: center;        
      }

      #topRow H1 {
        font-size:300%;
      }

      .bold {
        font-weight: bold;
      }

      .marginTop {
        margin-top:30px;
      }

      .center {
        text-align: center;
      }

      .title {
        margin-top: 100px;
        font-size: 300%;
      }

      #footer {
        background-color: #66ccff;
        width: 100%;
        padding-top: 70px;
      }

      .marginBottom {
        margin-bottom: 30px;
      }

      .appstoreImage {
        width: 250px;

      }






  </style>

  <body>
    
    <div class="navbar navbar-default navbar-fixed-top" >
      
      <div class="container">
        <div class="navbar-header pull-left">          
          <a class="navbar-brand">Diario Secreto</a>
        </div>

        <div class="pull-right">
        	<ul class="navbar-nav nav">
        		<li><a href="index.php?logout=1">Log Out</a></li>
        	</ul>
        	
          

        </div>


      </div>
    </div>


    <div class="container contentContainer" id="topContainer">

    <div class="row">
      
      <div column ="col-md-6 col-md-offset-3" id="topRow">

      		<textarea class="form-control"><?php echo $diary; ?></textarea>
        
        
      </div>

    </div>

    </div>



    



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->   


    <script src="js/bootstrap.min.js"></script>

    <script >

      $(".contentContainer").css("min-height", $(window).height());

      $("textarea").css("height", $(window).height()-110);

      $("textarea").keyup(function() {
      		//Invocamos a la funcio post de AJAX , para que actualice la BD sin que se note
      		$.post("updatediary.php", {diary:$("textarea").val()} );
      });




    </script>


  </body>
</html>