
<?php

$con=mysqli_connect("localhost","root","");

if(!$con)
{
	die('couldnt connect'.mysqli_error($con));
}

mysqli_select_db($con,"CinemaDb");

$movies="SELECT MName FROM Movies";
$cinemas="SELECT CName FROM Cinema";

$movieDataSet=mysqli_query($con,$movies)
or die('Couldnt read'.mysqli_error($con));
$cinemaDataSet=mysqli_query($con,$cinemas)
or die('Couldnt read'.mysqli_error($con));


$id="";

$movieName="";
$cinemaName="";
$disability="";
$date="";
$No=0;

$errId=0;
$errDisability=0;
$errNo=0;
if(isset($_POST["submit"]))
{
 $movieName=$_POST["movie"];
 $cinemaName=$_POST["cinema"];
if($_POST["id"]==null)
$errId=1;
else
$id=$_POST["id"];

if(isset($_POST["disable"]))
$disability=$_POST["disable"];
else
$errDisability=1;

if($_POST["num"]==null || $_POST["num"]==0)
$errNo=1;
else
$No=$_POST["num"];
}
?>



<html>
<head>
  <link rel="stylesheet" href="styles.css" />
  <title></title>
</head>
<body>

  <h1>Make your Booking</h1>
<form method="Post" action="booking.php">
  <table>

    <tr>
      <td>Booking ID</td>
      <td><input type="text" name="id" <?php echo "value ='$id'"?>/></td>
      </br>
       <?php
        if(isset($_POST["submit"])){
	  if($errId)
	  echo "Enter an ID";
	  }
	  ?>

         </tr>

    <tr>
      <td>
        Select a movie
      </td>

      <td>
        <select name="movie">
<?php
while($record=mysqli_fetch_array($movieDataSet))
{
echo " <option value= '$record[MName]'>$record[MName] </option> ";
}

?>
        </select>
      </td>
    </tr>

    <tr>
      <td>Select a Cinema</td>
      <td>
        <select name="cinema">
		<?php
while($record=mysqli_fetch_array($cinemaDataSet))
{
echo " <option value= '$record[CName]'>$record[CName] </option> ";
}

?>
		</select>

      </td>
    </tr>

    <tr>
      <td>Disability access</td>
      <td>
        Yes<input type="radio" name="disable" value="y" <?php if($disability=="y") echo "checked"?>/>
        No<input type="radio" name="disable" value="n" <?php if($disability=="n") echo "checked"?>/>
        </br>
        <?php
        if(isset($_POST["submit"]))
        {
        if($errDisability)
	  echo "select an option";
	  }
	?>
      </td>
    </tr>
    <tr>
      <td>Date</td>
      <td>
        <input type="text" name="date" <?php $date=date("y-m-d"); echo "value='$date'"?> readonly></input>
      </td>
    </tr>
    
    <tr>
      <td>No of Tickets</td>
      <td>
        <input type="text" name="num" <?php echo "value ='$No'"?>/>
</br>
<?php

        if(isset($_POST["submit"]))
		{
 			if($errNo)
	  			echo "Enter an No";
		}	 
 ?>
      </td>
    </tr>

  </table>
  <input type="submit" name="submit"/>
  
  </form>
</body>
</html>

<?php

if(isset($_POST["submit"]))
{
	if(($errId+$errDisability+$errNo)>0)
	{
	echo "please correct errors above";	
	}


else
{

$seatsQuery="SELECT * FROM Cinema WHERE CName='$cinemaName'";
$seatsQueryDataset=mysqli_query($con,$seatsQuery);
$seats=mysqli_fetch_array($seatsQueryDataset)
or die('error query'.mysqli_error($con));

if($seats[1] >=$No)
{
$insertBooking="INSERT INTO Booking VALUES 
('$id','$movieName','$cinemaName','$date','$disability','$No')";	

if(!mysqli_query($con,$insertBooking))
{
	die('Error'.mysqli_error($con));
}
else{
	echo "done";
}

}	

else{
	echo " insufficiet seats";
}

}

}


?>


