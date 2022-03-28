<?php
include "config.php";

session_start();

$db= $conn;
$tableName="records";
$columns= ['cotton', 'undergarment','towel','napkin','bedsheet', 'pillowcover','socks'];

#charges for clothes:
#cotton: 7 Rs.
#undergarment: 4 Rs.
#towel: 10 Rs.
#napkin: 8 Rs.
#bedsheet 20 Rs.
#pillowcover 5 Rs.
#Socks 2 Rs.

if(empty($db)){
  $msg= "Database connection error";
 }elseif (empty($columns) || !is_array($columns)) {
  $msg="columns Name must be defined in an indexed array";
 }elseif(empty($tableName)){
   $msg= "Table Name is empty";
}else{
  if(isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
  }
  $query = "SELECT date,cotton,undergarment,towel,napkin,bedsheet,pillowcover,socks,(7*cotton + 4*undergarment + 10*towel + 8*napkin + 20*bedsheet + 5*pillowcover + 2*socks) AS TOTAL FROM records WHERE username = '$username'" ;
  $result = $db->query($query);

  if($result== true){ 
  if ($result->num_rows > 0) {
      $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
      $msg= $row;
  } else {
      $msg= "No Data Found"; 
  }
  }else{
    $msg= mysqli_error($db);
      }
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link rel="stylesheet" href="style.css">
    

    <title>Records</title>
  </head>
  <body>
    <nav>
    <div class="welcome">
        <div class="nav__logo"><img src="./logo.jpg" alt=""/></div>
      <h3 class='user'>Hello, <?php echo $_SESSION['username'] ?></h3>
      </div>
      <ul>
        <li><a href="count.php">Home</a></li>
        <li><a href="history.php">History</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
<div class="container">
    
    <table class="table-data">
    <tr><th colspan="9">USER RECORDS</th></tr>
       <tr><th>Date</th>
         <th>Cotton</th>
         <th>Undergarment</th>
         <th>Towel</th>
         <th>Napkins</th>
         <th>Bedsheet</th>
         <th>Pillowcover</th>
         <th>Socks</th>
         <th>Charges</th>
</tr>
    <tbody>
  <?php
      if(is_array($msg)){      
      $sn=1;
      foreach($msg as $data){
    ?>
      <tr>
      <td><?php echo $data['date']??''; ?></td>
      <td><?php echo $data['cotton']??''; ?></td>
      <td><?php echo $data['undergarment']??''; ?></td>
      <td><?php echo $data['towel']??''; ?></td>
      <td><?php echo $data['napkin']??''; ?></td>
      <td><?php echo $data['bedsheet']??''; ?></td>
      <td><?php echo $data['pillowcover']??''; ?></td>
      <td><?php echo $data['socks']??''; ?></td>  
      <td> Rs. <?php echo $data['TOTAL']??''; ?></td>  
     </tr>
     <?php
      $sn++;}}else{ ?>
      <tr>
        <td colspan="8">
    <?php echo $msg; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
</div>
</div>


  </body>
</html>
