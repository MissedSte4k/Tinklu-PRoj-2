 <html>
<?php 

include("include/nustatymai.php");
include("include/functions.php");
session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index")  && ($_SESSION['prev'] != "laiko")))
{header("Location: logout.php");exit;
}
  
$_SESSION['prev'] = "laikoReg"; 
	 

$pieces = explode(".", $_POST['ids']);
$id = $pieces[0];
$diena = $pieces[1];
$laikas = $pieces[2];
	 console_log( $id );
	 console_log( $diena );
	 console_log( $laikas );

$user = $_SESSION['user'];
console_log( "atejo" );
if(uzsiregines3( $laikas, $diena, $id, $user)){
	console_log( "drop" );
	
	removeVartToTime($id, $laikas, $diena);
}else{
	console_log( "write" );
	
	 addVartToTime($id, $laikas, $diena, $user);
	
}
	 header("Location:laikoPasirinkimasV.php");
exit;

?>
	  </html>