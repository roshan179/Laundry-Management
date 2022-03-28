<?php

    include("config.php");

    session_start();


    $update = mysqli_query($conn,"UPDATE tickets SET status = 'resolved' WHERE date");
    if($update)
    {
        echo "<script>alert('Ticket Resolved Successfully')</script>";
    }
    header("location:admin.php");

?>