<?php
// procadmindb.php   admino nurodytus pakeitimus padaro DB
// $_SESSION['ka_keisti'] kuriuos vartotojus, $_SESSION['pakeitimai'] į kokį userlevel
	
session_start();
// cia sesijos kontrole: tik is procadmin
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "procadmin"))
{ header("Location: logout.php");exit;}

include("include/nustatymai.php");
include("include/functions.php");
$_SESSION['prev'] = "procadmindb";

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$i=0;$levels=$_SESSION['pakeitimai'];$kontoros=$_SESSION['pakeitimai2'];
foreach ($_SESSION['ka_keisti'] as $user)
  {$level=$levels[$i];
   $kontora=$kontoros[$i++];
   if ($level == -1) {
    $sql = "DELETE FROM ". TBL_SPECIALISTAS. "  WHERE  Login='$user'";
				         if (!mysqli_query($db, $sql)) {
                   echo " DB klaida šalinant vartotoją: " . $sql . "<br>" . mysqli_error($db);
		               exit;}
   } else {
    $sql = "UPDATE ". TBL_SPECIALISTAS." SET userlevel='$level', id_Kontora='$kontora' WHERE  Login='$user'";
				         if (!mysqli_query($db, $sql)) {
                   echo " DB klaida keičiant vartotojo įgaliojimus: " . $sql . "<br>" . mysqli_error($db);
		               exit;}
  }}
$_SESSION['message']="Pakeitimai atlikti sėkmingai";
header("Location:admin.php");exit;

?>