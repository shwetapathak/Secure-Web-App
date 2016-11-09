<html>
<body>
<h1>Home Page</H1><br>
<?php


$db = new pdo('mysql:unix_socket=/cloudsql/secureassign2:us-central1:myinstance;dbname=users',
  'root',  // username
  'shweta2191'       // password
  );
if ($_SERVER["REQUEST_METHOD"] == "POST"){

$user=$_POST['username'];
$pass=$_POST['password'];



$statement=$db->prepare("select user_name, password from User_Info where user_name='$user' and password='$pass'");

$statement->execute();
$row = $statement->fetch();
echo $row['username'];

if($row>0)
{
	session_start();
	$_SESSION['user'] = $user;
    echo '<meta http-equiv="refresh" content="0; URL=http://secureassign2.appspot.com/login.php">';
}

}
?>

</form>
</body>
</html>
