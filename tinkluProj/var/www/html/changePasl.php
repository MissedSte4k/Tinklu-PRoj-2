 <html>
<?php 

include("include/nustatymai.php");
include("include/functions.php");
session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "operacija2")  && ($_SESSION['prev'] != "operacija1")))
{header("Location: logout.php");exit;
}
  
$_SESSION['prev'] = "changePasl"; 
	 
console_log( $_POST['id'] );
$id = $_POST['id'];
$user = $_SESSION['user'];
	 
if(containsPasl($id, $user)){
	dropPasl($id, $user);
}else{
	writePasl($id, $user);
}

header("Location:operacija2.php");
exit;


?>
	  </html>