<html>
<body>
<h1> Sign up to post code : </h1>
<form action= "main.php" enctype="multipart/form-data" method="post">
    Username:  <input type="text" name = "username" value="username">
    Password:   <input type="password" name = "password" value="password">
    
    <input type="submit" value="Send">
	</form>

	<?php


//echo "User Authentication";

$db = new pdo('mysql:unix_socket=/cloudsql/secureassign2:us-central1:myinstance;dbname=users',
  'root',  // username
  'shweta2191'       // password
  );
if ($_SERVER["REQUEST_METHOD"] == "POST"){

$user=$_POST['username'];
$pass=$_POST['password'];

$tableName = "User_Info";
$columnName = "username varchar(255) PRIMARY KEY, password varchar(255) " ;
$createTableUser = $db->prepare("CREATE TABLE IF NOT EXISTS scale.$tableName ($columnName)");
$createTableUser->execute();

$selectStatement=$db->prepare("select user_name, password from User_Info where user_name='$user' and password='$pass'");

$selectStatement->execute();
$row = $selectStatement->fetch();

if($row>0)
{
	session_start();
	$_SESSION['user'] = $user;
    header("Location: login.php");
    echo '<meta http-equiv="refresh" content="0; URL=http://secureassign2.appspot.com/login.php">';
}

}
?>

</body>
</html>
