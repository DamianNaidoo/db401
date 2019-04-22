<?php
$con=mysqli_connect("localhost","root","");
if(!$con)
die('couldnt connect'.mysqli_error($con));

$create="Create Database CinemaDb";
mysqli_query($con,$create);

mysqli_select_db($con,"CinemaDb");

$movieTbl="Create Table Movies
(
MName varchar(30),
Type  varchar(20),
Age		varchar(5),
Duration varchar(10),
Primary key(MName) 
)";

if(mysqli_query($con,$movieTbl))
echo "table created";
else
echo "error ".mysqli_error($con);

$cinemaTbl="Create Table Cinema 
(
CName		varchar(10),
Capacity	varchar(10),
Price			decimal(5,2),
Primary key(CName)
)";

if(mysqli_query($con,$cinemaTbl))
echo "table created";
else
echo "error ".mysqli_error($con);


$bookingTbl="Create Table Booking 
(
BID					int,
MName				varchar(30),
CName				varchar(10),
BDate				Date,
Diabled			char(1),
NumBooked		int,
Primary key(BID),
Foreign Key (MName) references Movies(MName),
Foreign Key (CName) references Cinema(CName)
)";

if(mysqli_query($con,$bookingTbl))
echo "table created";
else
echo "error ".mysqli_error($con);

$InsertMovies="INSERT INTO Movies Values
('Minions','Animation','10lv','101 mins'),
('Fantastic four','fantasy','PG','120 mins'),
('Boy Choir','drama','PG','109 mins'),
('The man from uncle','action','13v','109 mins')";

if(mysqli_query($con,$InsertMovies))
echo "inserted";
else
echo "error ".mysqli_error($con);

$InsertCinema="Insert Into Cinema Values
('Prestige',50,150.00),		
('Nouvau',120,95.00),
('Imax',100,75.00),
('Cine',350,40.00)";

if(mysqli_query($con,$InsertCinema))
echo "inserted";
else
echo "error ".mysqli_error($con);
?>