<?php

  include("config.php");

  session_start();


  if(isset($_POST['check']))
  {
    $user = $_REQUEST['userlist'];
  }
  $query = "SELECT date,cotton,undergarment,towel,napkin,bedsheet,pillowcover,socks,(7*cotton + 4*undergarment + 10*towel + 8*napkin + 20*bedsheet + 5*pillowcover + 2*socks) AS TOTAL FROM records WHERE username = '$user'" ;
  $result = $conn->query($query);

  if($result== true){ 
  if ($result->num_rows > 0) {
      $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
      $msg= $row;
  } else {
      $msg= "No Data Found"; 
  }
  }else{
    $msg= mysqli_error($conn);
    }
    // #balance calculation;
    // $bal = 0;
    // foreach($msg as $data){
    //   $bal = $bal + $data['TOTAL'];
    // }
    //ticket details
    $tick = mysqli_query($conn, "SELECT date,subject,query,status FROM tickets where username = '$user'");
    if($result== true){
    if ($tick->num_rows > 0) {
      $x = mysqli_fetch_all($tick, MYSQLI_ASSOC);
      $ticket = $x;
  } else {
      $ticket= "No Data Found"; 
  }
    }
  else{
    $ticket= mysqli_error($conn);
    }


  ?>
      


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />

    <title>Account Balance</title>
  </head>
  <body>
    <nav>
    <div class="welcome">
        <div class="nav__logo"><img src="./logo.jpg" alt=""/></div>
      <h3 class='user'>Hello, <?php echo $_SESSION['username'] ?></h3>
      </div>
      <ul>
        <li><a href="admin.php">Home</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <div class="box">
    <!-- <div id="boxy"> -->
    <h1 class="box">User List</h1>
    <form method="post" action="">
    <select name="userlist">
    <option value="0" selected> - - Select Username - - </option>
    <?php
    $z = mysqli_query($conn,"SELECT DISTINCT username FROM records");
    if($z == true){ 
      if ($z ->num_rows > 0) {
          $values= mysqli_fetch_all($z, MYSQLI_ASSOC);
          $msg1 = $values;
      } else {
          $msg1 = "No Data Found"; 
      }
      }else{
        $msg1 = mysqli_error($conn);
          }
      foreach($msg1 as $data)
      {
    ?>
     <option class="opt"><?php echo $data['username']??'' ; ?></option>
     <?php
      }
      ?>
    <input type="submit" name="check" value="CHECK" class="btn">

    <div class="container">
      <table class="table-data">
        <!-- <h1>USER RECORDS</h1> -->
      <thead>
        <tr><th colspan="9">USER RECORDS</th></tr>
        <tr>
          <th>Date</th>
          <th>Cotton</th>
          <th>Undergarment</th>
          <th>Towel</th>
          <th>Napkins</th>
          <th>Bedsheet</th>
          <th>Pillowcover</th>
          <th>Socks</th>
          <th>Charges</th>
        </tr>
      </thead>
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
        <?php $sn++;}}else{ ?>
        <tr>
          <td colspan="8">
        <?php echo $msg; ?>
          </td>
        </tr>
      <?php
      }?>
      </tbody>
     </table>
     
     <table class="table-data">
       <thead>
       <tr><th colspan="5">USER TICKETS</th></tr>
         <tr><th>Date of Ticket</th>
         <th>Subject</th>
         <th>Query</th>
         <th>Status</th>
         <th>Updation</th>
         
        </thead>
        <tbody>
          <?php
          if(is_array($ticket)){      
            $sn=1;
            foreach($ticket as $data){
              ?>
        <tr>
          <td><?php echo $data['date']??''; ?></td>
          <td><?php echo $data['subject']??''; ?></td>
          <td><?php echo $data['query']??''; ?></td>
          <td><?php echo $data['status']??''; ?></td>
          <td><a href="update.php">FINISH</a></td>
        </tr>
        <?php $sn++;}}else{ ?>
          <tr>
            <td colspan="8">
              <?php echo $msg; ?>
            </td>
          </tr>
          <?php
      }?>
      </tbody>
    </table>
  </div>
  </body>
  </html>
  