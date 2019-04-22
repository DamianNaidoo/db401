
<?php

$con=mysqli_connect("localhost","root","");

if(!$con)
{
	die('couldnt connect'.mysqli_error($con));
}

mysqli_select_db($con,"CinemaDb");

$bookings="SELECT BID FROM Booking";

$bookingDataSet=mysqli_query($con,$bookings)
or die('Couldnt read'.mysqli_error($con));


?>


<html>
<head>
  <link rel="stylesheet" href="styles.css"/>    
    <title></title>
</head>
<body>

<h1>Ticket</h1>

<form method="post" action="TicketInfo.php">
<table>
<tr>
<td>Select a BookingID</td>
<td>

<select name="id">
<?php
while($record=mysqli_fetch_array($bookingDataSet))
{
echo " <option value= '$record[BID]'>$record[BID] </option> ";
}

?>
</select>

</td>
<td><input type="submit" name="submit"/></td>
</tr>
<table>

</form>
</body>
</html>

<?php

if(isset($_POST["submit"]))
{
 $name=$_POST["movie"];
 $moviesQuery="SELECT * FROM Booking WHERE BID='$id'";
 	
$AllBookingDataset=mysqli_query($con,$moviesQuery)
or die('error '.mysqli_error($con));

$record=mysqli_fetch_array($AllBookingDataset);

echo "Movie Name : $record[0] </br> Cinema:$record[1]";

if(record[2]=="n" || record[2]=="N")
{
	echo "</br> No disability access required";
}
else
{
	echo "</br>disability access required";	
}
echo "</br> number of tickets $record[4]";

$priceQuery="SELECT Price from Cinema where CName='$record[2]'";
$price=mysqli_query($con,$priceQuery);

echo "Total cost is ".($price*$record[5]);

 }

?>