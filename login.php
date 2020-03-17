<?php
if(isset($_POST["login"]))
{
session_start();
require 'db_connection.php';
//IF the connection doesnot connect then error message is being showed...
if (!$db_conn)
{
	die("Connection is failed: ".mysqli_connect_error());
}

//Taking the Input form  the website
$loginname = $_POST['userid'];
$loginpass = $_POST['pass'];

echo $loginname;
echo $loginpass;

if ($loginname == "Admin" && $loginpass == "Admin"){
    $_SESSION['login'] = "Active";
    echo "credential matched";
	header("location:wholesaler_login.php");
}
else {
	$sql = "SELECT * FROM customer_information 
        WHERE CustomerID = '$loginname' and Password = '$loginpass'";

	//For getting the results of the querys
	$result = mysqli_query($db_conn,$sql);
    
    //checks if the result has selected any of the rows...
	if(!$row = mysqli_fetch_assoc($result))
    {
        echo "Your UserName or password is incorrect";
        $_SESSION["pass"] = "False";
        header("Location:login_page.php");
    }
	else
    {
        $_SESSION['login'] = "Active";
        $_SESSION['CID']  = $row['CustomerID'];
        header("Location:customer_login.php");
    }
}
//header("Location: LoginPage.htm");
}
?>