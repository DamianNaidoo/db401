
<?php

$con=mysqli_connect("localhost","root","");

if(!$con)
{
	die('couldnt connect'.mysqli_error($con));
}

mysqli_select_db($con,"CinemaDb");

$movies="SELECT MName FROM Movies";

$movieDataSet=mysqli_query($con,$movies)
or die('Couldnt read'.mysqli_error($con));


?>


<html>
<head>
  <link rel="stylesheet" href="styles.css"/>    
    <title></title>
</head>
<body>

<h1>View Movie Details</h1>

<form method="post" action="MovieDetails.php">
<table>
<tr>
<td>Select a movie</td>
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
 $moviesQuery="SELECT * FROM Movies WHERE MName='$name'";
 	
$AllMovieDataset=mysqli_query($con,$moviesQuery)
or die('error '.mysqli_error($con));

echo "<table border='3'>";
echo "<tr>";
echo "<th>Movie Title</th> <th>Classification</th> <th>Age Restriction</th> <th>Duration</th>";
echo "</tr>";
$record=mysqli_fetch_array($AllMovieDataset);


echo "<tr>";

echo "<td>$record[0]</td>";
echo "<td>$record[1]</td>";
echo "<td>$record[2]</td>";
echo "<td>$record[3]</td>";
echo "</tr>";

 	
 	echo "</table>";

 }

?>