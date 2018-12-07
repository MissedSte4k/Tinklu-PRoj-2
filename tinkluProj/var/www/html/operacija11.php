<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos
include("include/nustatymai.php");
include("include/functions.php");
session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procuseredit")  && ($_SESSION['prev'] != "operacija1")))
{header("Location: logout.php");exit;
}
//visos kitos turetų būti tuščios
$_SESSION['prev'] = "operacija11"; 

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
			<?php 
			$_SESSION['kam'] = $_GET['paslauga'];
			$m = $_GET['paslauga'];
				
			$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$sql = "SELECT *
		FROM `Paslauga` WHERE `id` = $m;";
			$result = mysqli_query($dbc, $sql);  
			
		$row = mysqli_fetch_assoc($result)
			?>
			<center style="font-size:18pt;"><b>Registracija pas advokatą</b></center><br>
		<center style="font-size:14pt;"><b>Vartotojas: <?php echo $_SESSION['user'];  ?></b></center>
		<center style="font-size:14pt;"><b><?php echo $row['Pavadinimas']?> teikia: </b></center><br>	
<?php		
	$sql = "SELECT * FROM Specialistu_paslaugos WHERE id_Paslauga = $m";
	$result = mysqli_query($dbc, $sql);
	while($row = mysqli_fetch_assoc($result)){
		$sql2 = "SELECT * FROM Specialistas WHERE id = \"$row[id_Specialistas]\"";
		$result2 = mysqli_query($dbc, $sql2);
		if (!$result2 || (mysqli_num_rows($result2) < 1))  
			{ exit;}
		while($row2 = mysqli_fetch_assoc($result2)){	 
		$sql3 = "SELECT * FROM Kontora WHERE id = $row2[id_Kontora]";
		$result3 = mysqli_query($dbc, $sql3);
			if (!$result3 || (mysqli_num_rows($result3) < 1))  
			{ exit;}
?>
			
	<form action="mygtU.php" method="POST" class="login">   
    <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Kontora</b></td><td><b>Adresas</b></td><td><b>Telefono_nr</b></td><td><b>Pasirinkti</b></td></tr>
<?php
			while($row3 = mysqli_fetch_assoc($result3)) 
	{	 
	    
		echo "<td>".$row3['Pavadinimas']."</td>";
		echo "<td>".$row3['Adresas']."</td>";
		echo "<td>".$row3['Telefono_nr']."</td>";
      echo "<td><button type=\"submit\" name=\"id\" value=\"$row3[id]\"</button>rinktis</tr>";
   }
			
			
	}
	}
       
		?>
		</table>
		</form>	
			
        </td></tr>
	 </table>
  </div>
  </td></tr>
  </table>           
 </body>
</html>
