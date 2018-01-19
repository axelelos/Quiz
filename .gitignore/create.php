<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Skapa konto</title>
</head>

<body>
<?php
$message = null;
if (isset($_POST['name']) && isset($_POST['user']) && isset($_POST['pass']) &&
  !empty($_POST['name']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
   
    $name = $_POST['name'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    
    include ('dbconnection.php');
    try {    
        # prepare
        $sql = "INSERT INTO kunder (name, user, pass, reg_date) 
          VALUES (?, ?, ?, now())";
        $stmt = $dbconn->prepare($sql);
        # the data we want to insert
        $data = array($name, $user, $pass);
        # execute width array-parameter
        $stmt->execute($data);
        $konto= $stmt -> rowCount();

        if ($konto==1) {
            header("Location:loggin.php");
            exit;
            }
            
        echo "New record created successfully";
    }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
    }
    
    $dbconn = null;
} else {
    $message .= "<br />Du måste fylla i namn, användarnamn och lösenord!<br /><br />";
}
echo $message;
?>
<form method="post" action=""> 
<table> 
<tr>
<td>Namn:</td>
<td><input type="text" name="name" size=40 maxlength=100>
</td>
</tr> 
<tr>
<td>Användarnamn:</td>
<td><input type="text" name="user" size=40 maxlength=100></td></tr> 
<tr><td>Lösenord:</td><td><input type="text" name="pass" size=40 maxlength=100></td></tr> 
<tr>
<td><button type="submit">Lägg till</button></td></tr> 
</table> 
</form>
</body>
</html>
