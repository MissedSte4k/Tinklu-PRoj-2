<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL]))   { header("Location: logout.php");exit;}
$_SESSION['prev']="admin";
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Administratoriaus sąsaja</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <table class="center" ><tr><td>
            <center><img src="include/top.png"></center>
            </td></tr><tr><td>
		<center><font size="5">Vartotojų registracija, peržiūra ir įgaliojimų keitimas</font></center></td></tr></table> <br>
		<center><b><?php echo $_SESSION['message']; ?></b></center>
		<form name="vartotojai" action="procadmin.php" method="post">
	    <table class="center" style=" width:75%; border-width: 2px; border-style: dotted;">
		         <tr><td width=30%><a href="index.php">[Atgal]</a></td><td width=30%> 
	<?php
		   if ($uregister != "self") echo "<a href=\"register.php\"><b>Registruoti naują vartotoją<b></a><td>";
		   else echo "</td>";
	?>
		   
			<td width="30%">Atlikite reikalingus pakeitimus ir</td><td width="10%"> <input type="submit" value="Vykdyti"></td></tr></table> <br> 
<?php
    
	$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT * "
            . "FROM " . TBL_SPECIALISTAS . " ORDER BY userlevel DESC,Login";
	$result = mysqli_query($db, $sql);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę users"; exit;}
?>
    <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Vardas</b></td><td><b>Pavardė</b></td><td><b>Telefono_nr</b></td><td><b>Vartotojo vardas</b></td><td><b>Rolė</b></td><td><b>E-paštas</b></td><td><b>Kontora</b></td><td><b>Šalinti?</b></td></tr>
<?php
        while($row = mysqli_fetch_assoc($result)) 
	{	 
	    $level=$row['userlevel']; 
	  	$user= $row['Login'];
	  	$email = $row['e_pastas'];
      	$vardas = $row['Vardas'];
		$pavarde = $row['Pavarde'];
		$nr = $row['Telefono_nr'];
		$kontora = $row['id_Kontora'];
		echo "<td>".$vardas."</td>";
		echo "<td>".$pavarde."</td>";
		echo "<td>".$nr."</td>";
      	echo "<td>".$user. "</td><td>";
    	echo "<select name=\"role_".$user."\">";
      	$yra=false;
		foreach($user_roles as $x=>$x_value)
  			{echo "<option ";
        	 if ($x_value == $level) {$yra=true;echo "selected ";}
             echo "value=\"".$x_value."\" ";
         	 echo ">".$x."</option>";
        	 }
		if (!$yra)
        {echo "<option selected value=".$level.">Neegzistuoja=".$level."</option>";}
        $UZBLOKUOTAS=UZBLOKUOTAS; echo "<option ";
        if ($level == UZBLOKUOTAS) echo "selected ";
          echo "value=".$UZBLOKUOTAS." ";
        echo ">Užblokuotas</option>";      // papildoma opcija
      echo "</select></td>";
		
          echo "<td>".$email."</td><td>";
		
										echo "<select name=\"id_Kontora_".$user."\">";
										$db2= mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
										$sql2 = "SELECT * FROM Kontora";
										$result2 = mysqli_query($db2, $sql2);
										echo "<option ";
											 echo "value=\"".NULL."\" ";
											 echo ">".''."</option>";
   									   	 while($row2 = mysqli_fetch_assoc($result2))
  											{echo "<option ";
											 if ($row2['id'] == $kontora) {echo "selected ";}
											 echo "value=\"".$row2['id']."\" ";
											 echo ">".$row2['Pavadinimas']."</option>";
											}
		echo "</select></td>";
      
		
      echo "<td><input type=\"checkbox\" name=\"naikinti_".$user."\"></tr>";
		
		
   }
?>
        </table>
        <br> <input type="submit" value="Vykdyti">
        </form>
    </body></html>
