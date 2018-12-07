<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos
include("include/nustatymai.php");
include("include/functions.php");
session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procuseredit")  && ($_SESSION['prev'] != "operacija11")))
{header("Location: logout.php");exit;
}
  //visos kitos turetų būti tuščios
$_SESSION['prev'] = "mygtU"; 

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
					
			$m = $_SESSION['kam'];
			$kontora = $_POST['id'];
			$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$sql = "SELECT Specialistas.Vardas, Specialistas.Pavarde, Specialistas.Telefono_nr, Specialistas.e_pastas, Specialistas.id
		FROM Specialistas  
		INNER JOIN Specialistu_paslaugos ON Specialistas.id = Specialistu_paslaugos.id_Specialistas 
		WHERE Specialistas.id_Kontora = $kontora AND Specialistu_paslaugos.id_Paslauga = $m;";
			$result = mysqli_query($dbc, $sql);  
					?>
			<center style="font-size:18pt;"><b>Registracija pas advokatą</b></center><br>
		<center style="font-size:14pt;"><b>Vartotojas: <?php echo $_SESSION['user'];  ?></b></center>
		<center style="font-size:14pt;"><b>Jums tinkami advokatai:</b></center><br>	
<?php		
			if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Nera"; exit;}
?>
			<form action="laikoPasirinkimasV.php" method="POST" class="login">   
    <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Vardas</b></td><td><b>Pavarde</b></td><td><b>Telefono_nr</b></td><td><b>E paštas</b></td><td><b>Pasirinkti</b></td></tr>
<?php
			while($row = mysqli_fetch_assoc($result)) 
	{	 
	    
		echo "<td>".$row['Vardas']."</td>";
		echo "<td>".$row['Pavarde']."</td>";
		echo "<td>".$row['Telefono_nr']."</td>";
		echo "<td>".$row['e_pastas']."</td>";
        echo "<td><button type=\"submit\" name=\"id\" value=\"$row[id]\"</button>rinktis</tr>";
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

