
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
 $id=$_POST["id"];
 $moviesQuery="SELECT * FROM Booking WHERE BID='$id'";
 	
$AllBookingDataset=mysqli_query($con,$moviesQuery)
or die('error '.mysqli_error($con));

$record=mysqli_fetch_array($AllBookingDataset);

echo "</br>Movie Name : <input type='text' value='$record[1]' readonly/> </br></br> Cinema:<input type='text' value='$record[2]' readonly/>";


echo "</br></br> number of tickets  <input type='text' value='$record[5]' readonly/>";

$priceQuery="SELECT * from Cinema where CName='$record[2]'";
$priceDataset=mysqli_query($con,$priceQuery);
$result=mysqli_fetch_array($priceDataset);
echo "<br></br> price per ticket is $result[2]";
echo "</br></br>Total cost is ".($result[2]*$record[5]);

 }

?>