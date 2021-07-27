<?php

$server='localhost';
$username='root';
$password='';
$con=mysqli_connect($server,$username,$password);
$selec=mysqli_select_db($con,'reserves');
if(!($con && $selec))
{
    echo "Failed";
    die();
}
else
{
    /*echo "Connection to database succeded";*/
}
$con->query("CREATE TABLE reserves (`username` varchar(255),`firstname` varchar(255),`lastname` varchar(255),`email` varchar(255),`price` int(10),`noofticketsbooked` int(10),`ticketid` int(10),FOREIGN KEY(`username`) REFERENCES accounts(`username`),FOREIGN KEY(`ticketid`) REFERENCES fixtures(`matchid`)");
if(isset($_POST['price']))
{
$username=$_POST['username'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$phone=$_POST['phoneno'];
$email=$_POST['email'];
$price=$_POST['price'];
$matchno=$_POST['matchno'];
$noofticketsbooked=$_POST['noofticketsbooked'];
if($con->query("INSERT INTO reserves (`username`, `firstname`, `lastname`, `phone`, `email`, `price`, `noofticketsbooked`,`ticketid`) VALUES ('$username', '$firstname', '$lastname', '$phone', '$email', '$price', '$noofticketsbooked','$matchno');")==TRUE)
{
echo 1;
}
else
echo 0;
}
else if(isset($_POST['username']))
{
    $username=$_POST['username'];
    if(($con->query("DELETE FROM `reserves` WHERE `username`='$username'"))==TRUE)
    {
    echo 1;
    } 
    else
    echo 0;
}
?>