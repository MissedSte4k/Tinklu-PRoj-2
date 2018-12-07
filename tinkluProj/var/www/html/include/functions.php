<?php
// funkcijos  include/functions.php

function inisession($arg) {   //valom sesijos kintamuosius
            if($arg =="full"){
                $_SESSION['message']="";
                $_SESSION['user']="";
				$_SESSION['ukontora']="";
	       		$_SESSION['ulevel']=0;
				$_SESSION['userid']=0;
				$_SESSION['umail']=0;
            }			
	    $_SESSION['Vardas_login']="";
		$_SESSION['Vardas_error']="";
		$_SESSION['Pavarde_login']="";
		$_SESSION['Pavarde_error']="";
		$_SESSION['Telefono_nr_login']="";
		$_SESSION['Telefono_nr_error']="";
	
	
		$_SESSION['name_login']="";
		$_SESSION['pass_login']="";
		$_SESSION['mail_login']="";
		$_SESSION['name_error']="";
      	$_SESSION['pass_error']="";
		$_SESSION['mail_error']=""; 
        }



function checkname ($username){   // Vartotojo vardo sintakse
	   if (!$username || strlen($username = trim($username)) == 0) 
			{$_SESSION['name_error']=
				 "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo vardas</font>";
			 "";
			 return false;}
            elseif (!preg_match("/^([0-9a-zA-Z])*$/", $username))  /* Check if username is not alphanumeric */ 
			{$_SESSION['name_error']=
				"<font size=\"2\" color=\"#ff0000\">* Vartotojo vardas gali būti sudarytas<br>
				&nbsp;&nbsp;tik iš raidžių ir skaičių</font>";
		     return false;}
	        else return true;
   }
             
 function checkpass($pwd,$dbpwd) {     //  slaptazodzio tikrinimas (tik demo: min 4 raides ir/ar skaiciai) ir ar sutampa su DB esanciu
	   if (!$pwd || strlen($pwd = trim($pwd)) == 0) 
			{$_SESSION['pass_error']=
			  "<font size=\"2\" color=\"#ff0000\">* Neįvestas slaptažodis</font>";
			 return false;}
            elseif (!preg_match("/^([0-9a-zA-Z])*$/", $pwd))  /* Check if $pass is not alphanumeric */ 
			{$_SESSION['pass_error']="* Čia slaptažodis gali būti sudarytas<br>&nbsp;&nbsp;tik iš raidžių ir skaičių";
		     return false;}
            elseif (strlen($pwd)<4)  // per trumpas
			         {$_SESSION['pass_error']=
						  "<font size=\"2\" color=\"#ff0000\">* Slaptažodžio ilgis <4 simbolius</font>";
		              return false;}
	          elseif ($dbpwd != substr(hash( 'sha256', $pwd ),5,32))
               {$_SESSION['pass_error']=
				   "<font size=\"2\" color=\"#ff0000\">* Neteisingas slaptažodis</font>";
				$k = substr(hash( 'sha256', $pwd ),5,32);
                return false;}
            else return true;
   }

 function checkdb($username) {  // iesko DB pagal varda, grazina {vardas,slaptazodis,lygis,id} ir nustato name_error
		 $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		 $sql = "SELECT * FROM " . TBL_SPECIALISTAS. " WHERE Login = '$username'";
		 $result = mysqli_query($db, $sql);
	     $uname = $upass = $ulevel = $uid = $umail = null;
		 if (!$result || (mysqli_num_rows($result) != 1))   // jei >1 tai DB vardas kartojasi, netikrinu, imu pirma
	  	 {  // neradom vartotojo DB
	     $_SESSION['name_error']=
			 "<font size=\"2\" color=\"#ff0000\">* Tokio vartotojo nėra</font>";
		 }
      else {  //vardas yra DB
           $row = mysqli_fetch_assoc($result); 
           $uname= $row["Login"]; $upass= $row["Password"]; 
           $ulevel=$row["userlevel"]; $uid= $row["id"]; $umail = $row["e_pastas"];}
     return array($uname,$upass,$ulevel,$uid,$umail);
 }

function checkmail($mail) {   // e-mail sintax error checking  
	   if (!$mail || strlen($mail = trim($mail)) == 0) 
			{$_SESSION['mail_error']=
				"<font size=\"2\" color=\"#ff0000\">* Neįvestas e-pašto adresas</font>";
			   return false;}
            elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
			      {$_SESSION['mail_error']=
					   "<font size=\"2\" color=\"#ff0000\">* Neteisingas e-pašto adreso formatas</font>";
		            return false;}
	        else return true;
   }
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

function getIdFromLogin($Login) {   // e-mail sintax error checking  
	   $dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		
		$sql = "SELECT * FROM Specialistas WHERE Login = '$Login';";
			$result = mysqli_query($dbc, $sql);  
		$row = mysqli_fetch_assoc($result);
			return $row['id'];
   }

function writeTime($timeid, $date, $user){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = getIdFromLogin($user);
		$sql = "INSERT INTO `Specialistu_laikas` (`id`, `Diena`, `id_Darbo_laikas`, `id_Specialistas`, `id_Vartotojas`) VALUES 
		(NULL, '$date', '$timeid', '$id', NULL);";
			$result = mysqli_query($dbc, $sql);  
			return $result;
}
function dropTime($timeid, $date, $user){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = getIdFromLogin($user);
		$sql = "DELETE FROM `Specialistu_laikas` 
		WHERE `Diena` = '$date' AND `id_Specialistas` = '$id' AND `id_Darbo_laikas` = '$timeid'";
			$result = mysqli_query($dbc, $sql); 
		return $result;
}

function writePasl($ids, $user){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = getIdFromLogin($user);
		$sql = "INSERT INTO `Specialistu_paslaugos` (`id`, `id_Specialistas`, `id_paslauga`) VALUES 
		(NULL, '$id', '$ids');";
			$result = mysqli_query($dbc, $sql);  
			return $result;
}
function dropPasl($ids, $user){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = getIdFromLogin($user);
		$sql = "DELETE FROM `Specialistu_paslaugos` 
		WHERE `id_Specialistas` = '$id' AND `id_paslauga` = '$ids'";
			$result = mysqli_query($dbc, $sql); 
		return $result;
}



function containsTime($timeid, $date, $user){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = getIdFromLogin($user);
		$sql = "SELECT * FROM `Specialistu_laikas` 
		WHERE `Diena` = '$date' AND `id_Specialistas` = '$id' AND `id_Darbo_laikas` = '$timeid'";
			$result = mysqli_query($dbc, $sql);  
		if($result){
			if((mysqli_num_rows($result) > 0)){
				return true;
			}
		}else	
			    return false;  
		
}

function containsTime2($timeid, $date, $user){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = $user;
		$sql = "SELECT * FROM `Specialistu_laikas` 
		WHERE `Diena` = '$date' AND `id_Specialistas` = '$id' AND `id_Darbo_laikas` = '$timeid'";
			$result = mysqli_query($dbc, $sql);  
		if($result){
			if((mysqli_num_rows($result) > 0)){
				return true;
			}
		}else	
			    return false;  
		
}

function containsPasl($ids, $user){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = getIdFromLogin($user);
		$sql = "SELECT * FROM `Specialistu_paslaugos` 
		WHERE `id_Paslauga` = '$ids' AND `id_Specialistas` = '$id'";
			$result = mysqli_query($dbc, $sql);  
		if($result){
			if((mysqli_num_rows($result) > 0)){
				return true;
			}
		}else	
			    return false;  
}
function uzsiregines($timeid, $date, $user){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = getIdFromLogin($user);
		$sql = "SELECT * FROM `Specialistu_laikas` 
		WHERE `Diena` = '$date' AND `id_Specialistas` = '$id' AND `id_Darbo_laikas` = '$timeid'";
			$result = mysqli_query($dbc, $sql);  
		if($result){
			if((mysqli_num_rows($result) > 0)){
				$row = mysqli_fetch_assoc($result);
					if($row['id_Vartotojas'] != NULL){
						
				return true;
			}
			}
		}	
		return false;  
	
}
function uzsiregines2($timeid, $date, $user){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = $user;
		$sql = "SELECT * FROM `Specialistu_laikas` 
		WHERE `Diena` = '$date' AND `id_Specialistas` = '$id' AND `id_Darbo_laikas` = '$timeid'";
			$result = mysqli_query($dbc, $sql);  
		if($result){
			if((mysqli_num_rows($result) > 0)){
				$row = mysqli_fetch_assoc($result);
					if($row['id_Vartotojas'] != NULL){
						
				return true;
			}
			}
		}	
		return false;  
	
}

function uzsiregines3($timeid, $date, $user, $userr){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = $user;
		$id2 = getIdFromLogin($userr);
		$sql = "SELECT * FROM `Specialistu_laikas` 
		WHERE `Diena` = '$date' AND `id_Specialistas` = '$id' AND `id_Darbo_laikas` = '$timeid' AND `id_Vartotojas` = '$id2'";
			$result = mysqli_query($dbc, $sql);  
		if($result){
			if((mysqli_num_rows($result) > 0)){
				$row = mysqli_fetch_assoc($result);
					if($row['id_Vartotojas'] != NULL){
						
				return true;
			}
			}
		}	
		return false;  
	
}

function addVartToTime($ids, $timeid, $date, $user){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$id = getIdFromLogin($user);
		$sql = "UPDATE `Specialistu_laikas` SET `id_Vartotojas` = '$id' WHERE `Diena` = '$date' AND `id_Darbo_laikas` = '$timeid' AND `id_Specialistas` = '$ids';";
			console_log( $sql );
	$result = mysqli_query($dbc, $sql);  
			return $result;
}

function removeVartToTime($ids, $timeid, $date){
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		$sql = "UPDATE `Specialistu_laikas` SET `id_Vartotojas` = NULL WHERE `Diena` = '$date' AND `id_Darbo_laikas` = '$timeid' AND `id_Specialistas` = '$ids';";
			console_log( $sql );
	$result = mysqli_query($dbc, $sql);  
			return $result;
}







 ?>
 