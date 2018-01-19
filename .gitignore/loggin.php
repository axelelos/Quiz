<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Logga in</title>
</head>

<body>
<?php
if (isset($_POST['user']) && isset($_POST['pass']) && 
  !empty($_POST['user']) && !empty($_POST['pass'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    
    include ('dbconnection.php');

$sql = "SELECT * FROM kunder WHERE user='$user' AND pass='$pass' ";
$stmt = $dbconn->prepare($sql);
$data = array();
$stmt->execute($data); 
$antalposter = $stmt -> rowCount();

if ($antalposter==1) {
header("Location:choose.php");
exit;
} else{
    echo "Fel användarnamn eller lösenord";
}
}
?>
<form method="post" action=""> 
<table> 
<tr>
<td>Användarnamn:</td>
<td><input type="text" name="user" size=40 maxlength=100>
</td>
</tr> 
<tr>
<td>Lösenord:</td>
<td><input type="text" name="pass" size=40 maxlength=100></td></tr> 

<td><button type="submit">Logga in</button></td></tr> 
</table> 
</form>
</body>
</html>
