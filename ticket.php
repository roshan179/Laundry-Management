<?php

include("config.php");

session_start();

if(isset($_SESSION["username"]))
{
    $username = $_SESSION["username"];
}
if(isset($_POST['ticket']))
{
    $subject = $_REQUEST['subject'];
    $details = $_REQUEST["details"];
    $qdate = $_REQUEST["TicketDate"];
    $status='pending';

    $ticket_sql = "INSERT INTO tickets values('$qdate', '$username', '$subject', '$details','$status')";
    $result = mysqli_query($conn, $ticket_sql);
      if ($result -> num_rows>0)
      {
        echo "<script> alert('Successful entry') </script>";
      }
      else if ($result->num_rows == 0){
        echo "No data found";
      }
      else {
        echo "error".$ticket_sql.":-". mysqli_error($conn);
        mysqli_close($conn);
      }
    header("location:admin.php");
}
?>