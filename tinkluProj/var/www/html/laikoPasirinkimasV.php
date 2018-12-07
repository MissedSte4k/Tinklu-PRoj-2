<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos
include("include/nustatymai.php");
include("include/functions.php");
session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "laikoReg")  && ($_SESSION['prev'] != "mygtU" && ($_SESSION['prev'] != "laiko"))))
{header("Location: logout.php");exit;
}
  //visos kitos turetų būti tuščios
$_SESSION['prev'] = "laiko"; 


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
		<center style="font-size:14pt;"><b>Kliente: <?php echo $_SESSION['user'];  ?></b></center>
		<center style="font-size:14pt;"><b>Pasirinkite laiką kuriuo norite užsiregistruoti</b></center><br>	
	
			<form action="laikoRegistrProc.php" method="POST" class="login">   
    <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Diena</b></td>
<?php		
		$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		
	$sql = "SELECT * FROM Darbo_laikas";
	$result = mysqli_query($dbc, $sql);
		if(isset($_POST['id'])){
	$_SESSION['adv'] = $_POST['id'];
		}
		$id = $_SESSION['adv'];
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
			if(containsTime2($row['id'], $tmpdate, $id)){
				if(uzsiregines3($row['id'], $tmpdate, $id, $_SESSION['user'])){
					echo"style=\"background-color:blue;color:white;\"";
				}else if(uzsiregines2($row['id'], $tmpdate, $id)){
					echo"style=\"background-color: red ;color:black;\" disabled";
				}else{				
				echo"style=\"background-color:yellow;color:black;\"";
				}
			}else{
				echo"style=\"background-color: gray ;color:black;\" disabled";
			}
		if($tmpdate < $today){
			echo" disabled ";
		}
			echo" type=\"submit\" name=\"ids\" value=\"$id.$tmpdate.$row[id]\"</button>$tmp</td>";
		}
		$i++;
		echo"</tr>";
	}
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
