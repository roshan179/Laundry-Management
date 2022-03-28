<?php
  session_start();
  include 'config.php';
  if(isset($_SESSION['username']))
  {
    $username = $_SESSION["username"];
  }
  if(isset($_POST["submit"]))
  {
    $date= $_REQUEST['date'];
    $cotton = $_REQUEST['cotton'];
    $undergarment =  $_REQUEST['undergarment'];
    $towel = $_REQUEST['towel'];
    $napkin = $_REQUEST['napkin'];          
    $bedsheet = $_REQUEST['bedsheet'];          
    $pillowcover = $_REQUEST['pillow'];          
    $socks = $_REQUEST['socks'];                    
    // Performing insert query execution
    // here our table name is records
      $sql = "INSERT INTO records(username,cotton, date, undergarment,towel,napkin,bedsheet,pillowcover,socks)  VALUES ('$username','$cotton','$date',
        '$undergarment','$towel','$napkin','$bedsheet','$pillowcover','$socks')";
      $result = mysqli_query($conn, $sql);
      if ($result)
      {
        echo "<script> alert('Successful entry') </script>";
      }
      else{
        echo "error".$sql.":-". mysqli_error($conn);
        mysqli_close($conn);
      }

    //data retrieval from db table
    $query = "SELECT cotton,undergarment,towel,napkin,bedsheet,pillowcover,socks,(7*cotton + 4*undergarment + 10*towel + 8*napkin + 20*bedsheet + 5*pillowcover + 2*socks) AS TOTAL FROM records WHERE username = '$username'" ;

    $res = mysqli_query($conn, $query);
    if($res== true){ 
      if ($res->num_rows > 0) {
          $row2= mysqli_fetch_all($res, MYSQLI_ASSOC);
          $msg= $row2;
      } else {
          $msg= "No Data Found"; 
      }
      }else{
        $msg= mysqli_error($conn);
          }


    #balance calculation;
    $bal = 0;
    foreach($msg as $data){
      $bal = $bal + $data['TOTAL'];
    }
    

    #amount total udpation
    $query2 = "SELECT amount FROM balance WHERE username = '$username'" ;
    $res2 = mysqli_query($conn, $query);
    if($res2== true){ 
      if ($res2 ->num_rows > 0) {
          $row3= mysqli_fetch_all($res2, MYSQLI_ASSOC);
          $msg2= $row3;
      } else {
          $msg2= "No Data Found"; 
      }
      }else{
        $msg2= mysqli_error($conn);
          }

      $update = "UPDATE balance set amount = 2000 - $bal WHERE username = $username";
      
      $res3 = mysqli_query($conn, $update);
      if($res3== true){ 
        echo "<script> alert('Balance Updated Successfully')</script>";
     }
     else{
          $msg2= mysqli_error($conn);
          }
      }

      $new_amt = mysqli_query($conn, "SELECT amount from balance WHERE username = '$username' ");
      if($new_amt== true){ 
        if ($new_amt ->num_rows > 0) {
            $updated= mysqli_fetch_all($new_amt, MYSQLI_ASSOC);
            $msg3= $updated;
        } else {
            $msg3= "No Data Found"; 
        }
        }else{
          $msg3= mysqli_error($conn);
     }

     //fedbackform content
     if(isset($_POST['ticket']))
{
      $subject = $_REQUEST['subject'];
      $details = $_REQUEST["details"];
      $qdate = $_REQUEST["TicketDate"];
      $status='pending';

      $ticket_sql = "INSERT INTO tickets values('$qdate', '$username', '$subject', '$details','$status')";
      $result = mysqli_query($conn, $ticket_sql);
        if ($result)
        {
          echo "<script> alert('Successful entry') </script>";
        }
        else{
          echo "error".$ticket_sql.":-". mysqli_error($conn);
          mysqli_close($conn);
        }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />

    <title>Spin 'N' Dry</title>
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

      

    <div class="big__container">
      <form action="" class="cloth_count_form" method="post">
        <h2 class="form__title">Clothes Entry</h2>
        <div class="input__div">
          <div class="clothCat">Cloth Category</div>
          <div class="clothCat">Count</div>
        </div>
        <div class="input__div">
          <label for="cotton">Cotton</label>
          <select name="cotton" id="cotton" default="0">
            <option selected>0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
            <option>32</option>
            <option>33</option>
            <option>34</option>
            <option>35</option>
            <option>36</option>
            <option>37</option>
            <option>38</option>
            <option>39</option>
            <option>40</option>
            <option>41</option>
            <option>42</option>
            <option>43</option>
            <option>44</option>
            <option>45</option>
            <option>45</option>
            <option>46</option>
            <option>47</option>
            <option>48</option>
            <option>49</option>
            <option>50</option>
          </select>
        </div>
        <div class="input__div">
          <label for="undergarment">Undergarment</label>
          <select name="undergarment" id="undergarment" default="0">
            <option selected>0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
          </select>
        </div>
        <div class="input__div">
          <label for="towel">Towel</label>
          <select name="towel" id="towel" default="0">
            <option selected>0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
          </select>
        </div>
        <div class="input__div">
          <label for="napkin">Napkins</label>
          <select name="napkin" id="napkin" default="0">
            <option selected>0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
          </select>
        </div>
        <div class="input__div">
          <label for="bedsheet">Bedsheet</label>
          <select name="bedsheet" id="bedsheet" default="0">
            <option selected>0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
          </select>
        </div>
        <div class="input__div">
          <label for="pillow">Pillowcover</label>
          <select name="pillow" id="pillow" default="0">
            <option selected>0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
          </select>
        </div>
        <div class="input__div">
          <label for="socks">Socks</label>
          <select name="socks" id="socks" default="0">
            <option selected>0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
          </select>
        </div>
        <div class="input__div">
          <label for="date">Date</label>
          <input type="date" name="date" id="date" required>
          </select>
        </div>
        <input type="submit" class="cloth__entry" value="submit" name="submit">
      </form>
      <div class="money">
        <?php
          if(isset($_POST["submit"]))
          {
            ?>
            <h2>Your Current Account Balance is Rs. <?php $_SESSION['balance']= (2000-$bal); echo 2000 - $bal ; ?></h2>
           <?php
          }
          ?>
      </div>
    </div>

    <button class="open-button" onclick="openForm()">Raise A Ticket</button>
    <div class="form-popup" id="myForm">
      <h1>Raise a Ticket</h1>
      <form action="" class="form-container" method="post">
        <!-- <h1>Raise a Ticket</h1> -->

        <label for="subject"><b>Subject</b></label>
        <input type="text" placeholder="Enter Subject" name="subject" required>
        
        <label for="details"><b>Details</b></label>
        <textarea name="details" id="details" cols="30" rows="10" placeholder="Enter Details"></textarea>
        
        <label for="TicketDate"><b>Date of Laundry Submission</b></label>
        <input type="date" name="TicketDate" required>

        <input type="submit" class="btn" value="Submit Query" name="ticket"></input>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        
      </form>
    </div>
        <script>
          function openForm() {
            // console.log("Hi")
            document.getElementById("myForm").style.display = "block";
          }
    
          function closeForm() {
            document.getElementById("myForm").style.display = "none";
          }
        </script>
  </body>
</html>
