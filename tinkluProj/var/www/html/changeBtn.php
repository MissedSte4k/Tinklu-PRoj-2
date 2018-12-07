 <html>
<?php 

include("include/nustatymai.php");
include("include/functions.php");
session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "operacija2")  && ($_SESSION['prev'] != "operacija1")))
{header("Location: logout.php");exit;
}
  
$_SESSION['prev'] = "changeBtn"; 
console_log( $_POST['id'] );
$pieces = explode(".", $_POST['id']);
$diena = $pieces[0];
$laikas = $pieces[1];
console_log( $diena );
console_log( $laikas );
$user = $_SESSION['user'];
console_log( "atejo" );
if(containsTime($laikas, $diena, $user)){
	console_log( "drop" );
	
	dropTime($laikas, $diena, $user);
	
}else{
	console_log( "write" );
	
	writeTime($laikas, $diena, $user);
	
}

header("Location:operacija2.php");
exit;


?>
	  </html>