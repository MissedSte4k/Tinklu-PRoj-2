<?php
	
	$dbc=mysqli_connect('localhost','stud', 'stud','Tinklu_proj');
	if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
	$sql = "SELECT * FROM Specialistas;";
    $result = mysqli_query($dbc, $sql);  
	$maxV = "";
	$maxCNT = 0;
	$tmpmaxCNT = 0;
	while($row = mysqli_fetch_assoc($result)){
		$sql2 = "SELECT * FROM Registracija;";
    $result2 = mysqli_query($dbc, $sql2);  
		while($row2 = mysqli_fetch_assoc($result2)){
			if($row[id] == $row2[id_Specialistas]){
			$tmpmaxCNT++;	
			}
		}
		if($tmpmaxCNT > $maxCNT){
			$maxCNT = $tmpmaxCNT;
			$maxV = $row[Vardas].$row[Pavarde];
		}
		$maxV = "";
		$tmpmaxCNT = 0;
	}
 	
	

?>