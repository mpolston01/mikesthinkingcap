<html>
<head>
    <title>Check Register</title>
    <link rel="stylesheet" href="income.css">
</head>
<body>
<?php //<a href = "javascript:alert('Hello World');">Execut JavaScript</a>?>
<form action = "" method = "POST">
<h1>Check Register</h1>
<div class="dropdown">
  <button class="dropbtn">Home</button>
</div>
  <div class="dropdown">
    <button class="dropbtn">Income</button>
  <div class="dropdown-content">
    <a href= "addnewPayee_Screen.php">Add New Payer</a>    
    <a href= "displayincome.php">Update Paychecks</a>
    <a href= "deleteBills.php">Delete Old Payers</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Bills</button>
  <div class="dropdown-content">
    <a href= "addnewBills.php">Add new Bills</a>
    <a href= "update_bills.php">Pay Bills</a>
    <a href= "deleteBills.php">Delete Bills</a>
    </div>
  </div>

<?php 
//error_reporting(0);
?>
</h3>
</div>
<br />
    <table border = '1'>
<thead>
<tr>
<th> Company </th>
<th> Date Due </th>
<th> Amount Due </th>
<th> Date Paid</th>
<th> Amount Paid</th>
</tr>
</thead>
<?php

?> 
	
<tr>
</td>

<?php 
include "database_bills_Connection.php";

$sql = "select * from bills order by dateDue ";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc())	
    {
         
echo "<td>" ."<a href = $row[url] >".$row['vendor']."</a>"."</td>";
echo "<td>" .$row['dateDue']."</td>";
echo "<td>" .$row['amountDue']."</td>";
echo "<td>" .$row['datePaid']. "</td>";
echo "<td>" .$row['amountPaid']."</td>";
echo "</tr>";
$amountPaid = $row['amountPaid'];
$datePaid = $row['datePaid'];
}
}
$conn->close();

?>	
<br>
<br>
<div class = "balance">
<br>
<br>
<h3>Beginning Balance:
<?php 
include "database_bills_Connection.php";
$sql = "select * from bankbalance limit 1";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc())
    {
        $balance = $row['bigbalance'];
   
echo "<input type = 'float' name = 'Balance'
             id = 'Balance' class = 'money'
        style = font-weight: bold;
	    background-color: lightgreen; color: black;
        font-size: large value = '$balance'>";  

    }
}

$conn->close();


?>
<br >
<br >

Total Paid This Period:

<?php
include "database_bills_Connection.php";
$sql = "select sum(amountPaid) as totalPaid from bills 
        where datePaid = between '2018-08-01' and '2018-08-12';
$result = $conn->query($sql); 

if($result->num_rows > 0){
     while($row = $result->fetch_assoc())
    {
        $totalPaid = $row[0];
    }";


echo "<input type = 'float' name = 'paidOut'
             id = 'paidOut' class = 'money'
        
        style = '
        font-weight: bold; 
	    background-color: lightgreen; 
	    color: black; 
        font-size: large;        
        value =  $totalPaid; 
                 
var_dump($totalPaid)";
        

?>
        
<br >
<br >

Ending Balance :

<?php 
$endingBalance = ($balance - $totalPaid);
     
                
       echo "<input type = 'float' name = 'balance'
             id = 'balance' class = 'money'
             value = '$endingBalance' >";
        

echo $conn->close();



?>
</table>
</div>
</form>
 </body>
</html>
