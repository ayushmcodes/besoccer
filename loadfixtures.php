<?php
$server='localhost';
$username='root';
$password='';
$con=mysqli_connect($server,$username,$password);
$selec=mysqli_select_db($con,'fixtures');
if(!($con && $selec))
{
    echo "Failed";
    die();
}
else
{
    /*echo "Connection to database succeded";*/
}

if(isset($_POST['bookingpage']) && isset($_POST['matchno']))
{
$matchno=$_POST['matchno'];
$res=$con->query("select * from fixtures WHERE `match_id`='$matchno'");
if($res)
{
    echo json_encode($res->fetch_all());
}
}




if(isset($_POST['match_id']) | isset($_POST['date']) | isset($_POST['teamname']) | isset($_POST['minprice']) | isset($_POST['maxprice']))
{
$teamname=$_POST['teamname'];
$date=$_POST['date'];
$minprice=$_POST['minprice'];
$maxprice=$_POST['maxprice'];


if($date!="" && $teamname!="" && $minprice!="" && $maxprice!="")
$res=$con->query("select * from fixtures WHERE `date`='$date' AND (`team1`='$teamname' OR `team2`='$teamname') AND `price`>='$minprice' AND `price`<='$maxprice'");
else if($date!="" && $teamname!="")
$res=$con->query("select * from fixtures WHERE `date`='$date' AND (`team1`='$teamname' OR `team2`='$teamname')");
else if($teamname!="" && $minprice!="" && $maxprice!="")
$res=$con->query("select * from fixtures WHERE (`team1`='$teamname' OR `team2`='$teamname') AND `price`>='$minprice' AND `price`<='$maxprice'");
else if($date!="" && $minprice!="" && $maxprice!="")
$res=$con->query("select * from fixtures WHERE `date`='$date' AND `price`>='$minprice' AND `price`<='$maxprice'");
else if($date!="")
$res=$con->query("select * from fixtures WHERE `date`='$date'");
else if($teamname!="")
$res=$con->query("select * from fixtures WHERE (`team1`='$teamname' OR `team2`='$teamname')");
else if($minprice!="" && $maxprice!="")
$res=$con->query("select * from fixtures WHERE `price`>='$minprice' AND `price`<='$maxprice'");
else
$res=$con->query("select * from fixtures");


if($res)
{
echo json_encode($res->fetch_all());
}
else
echo "Row Selection Failed";
}



if(isset($_POST['noofticketsbooked']) && isset($_POST['matchno']))
{
    $matchno=$_POST['matchno'];
    $noofticketsbooked=$_POST['noofticketsbooked'];
    $con->query("UPDATE fixtures SET `tickets`=`tickets`-'$noofticketsbooked' WHERE `match_id`='$matchno'");
    
}
?>