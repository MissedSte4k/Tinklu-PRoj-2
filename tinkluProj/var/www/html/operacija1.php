<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos
include("include/nustatymai.php");
include("include/functions.php");
session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procuseredit")  && ($_SESSION['prev'] != "useredit")))
{header("Location: logout.php");exit;
}
 //visos kitos turetų būti tuščios
$_SESSION['prev'] = "operacija1"; 
?>

 <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Registracija</title>
            <link href="include/styles.css" rel="stylesheet" type="text/css" >
        </head>
        <body>   
            <table class="center"><tr><td> <img src="include/top.png"> </td></tr><tr><td> 
				<table style="border-width: 2px; border-style: dotted;"><tr><td>
                     Atgal į [<a href="index.php">Pradžia</a>] </td></tr>
		        </table>               
                <div align="center">   <font size="4" color="#ff0000"><?php echo $_SESSION['message']; ?><br></font>  
					
      <table bgcolor=#C3FDB8>
        <tr><td>
		<form action="operacija11.php" method="GET" class="login">             
        <center style="font-size:18pt;"><b>Registracija pas advokatą</b></center><br>
		<center style="font-size:14pt;"><b>Vartotojas: <?php echo $_SESSION['user'];  ?></b></center>
        
        <select class="row" name="paslauga" id="paslauga" style="margin: 15px">
  	<option selected>Pasirinkite paslauga</option>
		
		<?php	

        $dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$sql = "SELECT * FROM Paslauga;";
			$result = mysqli_query($dbc, $sql);  
		while($row = mysqli_fetch_assoc($result))
		 {
			 echo"<option value=\" $row[id]\">$row[Pavadinimas]</option>";
		 }
		?>
			</select>
        <p style="text-align:left;">
            <input type="submit" name="login" value="Rinktis"/>     
        </p>  
        </form>
        </td></tr>
	 </table>
  </div>
  </td></tr>
  </table>           
 </body>
</html>
	


