<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>";
        if ($_SESSION['user'] != "guest") echo "[<a href=\"useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;";
		echo "[<a href=\"operacija1.php\">Registruotis į susitikimą</a>] &nbsp;&nbsp;";
        //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
        if (($userlevel == $user_roles["Advokatas"]) || ($userlevel == $user_roles[ADMIN_LEVEL] )) {
            echo "[<a href=\"operacija2.php\">Pasirinkt darbo laiką</a>] &nbsp;&nbsp;";
			
	
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
	$sql = "SELECT * FROM Specialistas;";
    $result = mysqli_query($dbc, $sql);  
	$maxV = "";
	$maxCNT = 0;
	$tmpmaxCNT = 0;
	while($row = mysqli_fetch_assoc($result)){
		$sql2 = "SELECT * FROM Specialistu_laikas;";
    $result2 = mysqli_query($dbc, $sql2);  
		while($row2 = mysqli_fetch_assoc($result2)){
			if($row['id'] == $row2['id_Specialistas'] && $row2['id_Vartotojas'] != NULL){
			$tmpmaxCNT++;	
			}
		}
		if($tmpmaxCNT > $maxCNT){
			$maxCNT = $tmpmaxCNT;
			$maxV = $row['Vardas']." ".$row['Pavarde'];
		}
		$tmpmaxCNT = 0;
	}
 	
	



			echo "[<a >Geriausias darbuotojas: $maxV aptarnavęs $maxCNT</a>] &nbsp;&nbsp;";
       		}   
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "[<a href=\"admin.php\">Administratoriaus sąsaja</a>] &nbsp;&nbsp;";
        }
        echo "[<a href=\"logout.php\">Atsijungti</a>]";
      echo "</td></tr></table>";
?>       
    
 