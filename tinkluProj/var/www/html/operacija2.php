<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos
include("include/nustatymai.php");
include("include/functions.php");
session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "operacija2")  && ($_SESSION['prev'] != "changePasl") && ($_SESSION['prev'] != "changeBtn")))
{header("Location: logout.php");exit;
}
  //visos kitos turetų būti tuščios
$_SESSION['prev'] = "operacija2"; 

?>

 <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Darbo laiko pasirinkimas</title>
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
							
			$id = getIdFromLogin($_SESSION['user']);
			console_log($id);
			?>
			<center style="font-size:18pt;"><b>Mielas</b></center><br>
		<center style="font-size:14pt;"><b>Vartotojas: <?php echo $_SESSION['user'];  ?></b></center>
		<center style="font-size:14pt;"><b>Pasirinkite šio mėnesio savo darbo laiką (geltona - dirbat, žalia - ne, raudona - yra užsiregistravęs žmogus)</b></center><br>	
	
			<form action="changeBtn.php" method="POST" class="login">   
    <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Diena</b></td>
<?php		
		$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		
	$sql = "SELECT * FROM Darbo_laikas";
	$result = mysqli_query($dbc, $sql);
		
	while($row = mysqli_fetch_assoc($result)){
		$tmp = date('G:i', strtotime($row['Pradzia']));
		echo"<td><b>$tmp</b></td>";
	}
	$today = date('Y-m-d');	
	$date = date('Y-m');
	$i = 1;
		while($i < 31)
	{
		if($i > 9)
		$tmpdate = $date."-".$i;
		else $tmpdate = $date."-"."0".$i;
		console_log( $tmpdate );
		echo"<tr><td><b>$i</b></td>";
	$result = mysqli_query($dbc, $sql);
	while($row = mysqli_fetch_assoc($result)){
		$tmp = date('G:i', strtotime($row['Pradzia']));
		echo"<td><button ";
			if(containsTime($row['id'], $tmpdate, $_SESSION['user'])){
				if(uzsiregines($row['id'], $tmpdate, $_SESSION['user'])){
					echo"style=\"background-color:red;color:black;\"";
				}
				echo"style=\"background-color:yellow;color:black;\"";
			}else{
				echo"style=\"background-color: green ;color:black;\"";
			}
		if($tmpdate < $today){
			echo" disabled ";
		}
			echo" type=\"submit\" name=\"id\" value=\"$tmpdate.$row[id]\"</button>$tmp</td>";
		}
		$i++;
		echo"</tr>";
	}
?>
		</tr>	
		
		</table>
		</form>	
		<center style="font-size:14pt;"><b>Pasirinkite jūsų teikiamas paslaugas (žalia - teikiat, raudona - ne)</b></center><br>	
			<form action="changePasl.php" method="POST" class="login">   
    <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Paslaugos:</b></td>
<?php		
		$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$cnt = 0;
	$sql = "SELECT * FROM Paslauga";
	$result = mysqli_query($dbc, $sql);
		
	while($row = mysqli_fetch_assoc($result)){
				
	
		echo"<td><button ";
			if(containsPasl($row['id'], $_SESSION['user'])){
				echo"style=\"background-color:green;color:white;\"";
			}else{
				echo"style=\"background-color:red ;color:black;\"";
			}
			echo" type=\"submit\" name=\"id\" value=\"$row[id]\"</button>$row[Pavadinimas]</td>";
	$cnt++;	
		if($cnt > 10){
			echo"</tr>";
		}
	}
		
		echo"</tr>";
?>
		</tr>	
		</table>
		</form>	
			
        </td></tr>
	 </table>
  </div>
  </td></tr>
  </table>           
 </body>
</html>
