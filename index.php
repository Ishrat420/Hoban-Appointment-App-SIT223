<style>
  body{
    font-family: Arial;
  }
#menu {
  border: 1px solid;
  padding: 14px;
  background: blue;
}

#menu a{
  border-right: 1px solid;
  padding: 12px;
  text-decoration: none;
  color: white;
  font-size: 16px;
}
</style>
<div id="menu">
  <a href="index.php">Appointment Page</a>
  <a href="slots.php">Slot Setting</a>
</div>
<?php
include "conn.php";
$numDay = 0;
$numMonth = 0;
$numYear = 0;

if(isset($_POST['numDay']))
{
  $numDay = $_POST['numDay'];
}

if(isset($_POST['numMonth']))
{
  $numMonth = $_POST['numMonth'];
}

if(isset($_POST['numYear']))
{
  $numYear = $_POST['numYear'];
}

if(isset($_POST['prev']))
{
  $numMonth = $_POST['numMonth']-1;
}
if(isset($_POST['next']))
{
  $numMonth = $_POST['numMonth']+1;
}

if(isset($_POST['save_std']))
{
  $slot_id = $_POST['slot_id'];
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];

  mysqli_query($conn, "INSERT INTO `students`(`name`, `phone`, `email`) VALUES ('$name', '$phone', '$email')");
  $student_id = mysqli_insert_id($conn);

  mysqli_query($conn, "UPDATE `slots` SET `is_fill`='1',`student_id`='$student_id' WHERE id = '$slot_id'");
}


$date = $numYear . "-" . $numMonth .  "-" . $numDay;
if($numMonth == 0)
  $time = strtotime("now");
else
  $time = strtotime($date);


$numDay = date('d', $time);
$numMonth = date('m', $time);
$strMonth = date('F', $time);
$numYear = date('Y', $time);
$firstDay = mktime(0,0,0,$numMonth,1,$numYear);
$daysInMonth = cal_days_in_month(0, $numMonth, $numYear);
$dayOfWeek = date('w', $firstDay);

// echo $numDay . "<br>";
// echo $numMonth . "<br>";
// echo $numYear . "<br>";
?>

<style>
  button{
    background: blue;
    color: white;
    border-radius: 13px;
    padding: 6px 14px 6px 14px;
    border: 0px;
  }
</style>

<div style="background: lightgrey; padding: 20px; margin-top: 14px">
  <font style="float: left"> Book Appointment </font>
  <div align="center" style="">
    <button>Student Login</button>  
    <button>Organizer Login</button> 
  </div> 
</div>

<div style="float: left; width:30%">
  <br>
  <br>
  <br>
  <br>
  <form action="" method="POST">
    <table width="100%" style="line-height: 3">
      <tr>
          <td>Student ID: </td> 
          <td> <input type="text" name="student_id" value="" required ></td> 
      </tr>
      <tr>
          <td> Name: </td>
          <td><input type="text" name="name" value="" required ></td>
      </tr>
      <tr>
          <td>Email: </td> 
          <td><input type="email" name="email" value="" required > </td> 
      </tr>
      <tr>
          <td>Phone: </td> 
          <td><input type="text" name="phone" value="" required ></td>
      </tr>
      <tr>
          <td>Slot: </td> 
          <td><input type="text" name="slot" id="slot" value="" placeholder="select a slot" required  readonly></td>
      </tr>
      <tr>
          <td></td> 
          <td><input type="submit" name="save_std" value="Save" onclick="return validate()"></td>
      </tr>
    </table>


    <input type='hidden' name='slot_id' id='f_slot_id' value='0'>
    <input type='hidden' name='numDay' value='<?php echo $numDay ?>'>
    <input type='hidden' name='numMonth' value='<?php echo $numMonth ?>'>
    <input type='hidden' name='numYear' value='<?php echo $numYear ?>'>
  </form>
</div>

<script>
function validate()
{
    if(document.getElementById("f_slot_id").value == "0")
    {
      alert("Please select a slot");
      return false;
    }
    return true;
}
function selectSlot(div)
{
    var appSlot = document.getElementsByClassName("appointmentSlot");
    var i;
    for (i = 0; i < appSlot.length; i++) {
      appSlot[i].style.backgroundColor = "white";
      appSlot[i].style.color = "#4c72fb";
    }


    var slotDiv = document.getElementById(div);
    var slot_id = slotDiv.querySelector("#slot_id").value;
    document.getElementById("f_slot_id").value=slot_id;
    
    document.getElementById("slot").value=slotDiv.querySelector("#slot_v").innerHTML;


    slotDiv.parentNode.style.backgroundColor = 'blue';
    slotDiv.parentNode.style.color = 'white';
  
}
</script>

<div id="main" align="center" style="float: left; width:60%">
    <h3> CLICK ON ANY DATE YOU WANT TO TAKE APPOINTMENT </h3>
    <table align="center" style="width:50%; border: 1px solid">
    <thead>
      <form action="" method="POST">
        <input type="hidden" name="numDay" value="<?php echo $numDay ?>">
        <input type="hidden" name="numMonth" value="<?php echo $numMonth ?>">
        <input type="hidden" name="numYear" value="<?php echo $numYear ?>">
    <tr>
          <th> <input type="submit" name="prev" value="<<"> </th>
          <th colspan=5> <?php echo strtoupper($strMonth) . '-' . $numYear; ?> </th>
          <th> <input type="submit" name="next" value=">>"> </th>
    </tr>
    </form>
    <tr>
          <th abbr="Sunday" scope="col" title="Sunday">S</th>
          <th abbr="Monday" scope="col" title="Monday">M</th>
          <th abbr="Tuesday" scope="col" title="Tuesday">T</th>
          <th abbr="Wednesday" scope="col" title="Wednesday">W</th>
          <th abbr="Thursday" scope="col" title="Thursday">T</th>
          <th abbr="Friday" scope="col" title="Friday">F</th>
          <th abbr="Saturday" scope="col" title="Saturday">S</th>
    </tr>
    </thead>
    <tbody>

    <tr>
    <?php
    if(0 != $dayOfWeek) 
    { 
        echo('<th colspan="'.$dayOfWeek.'"> </th>'); 
    }

    for($i=1;$i<=$daysInMonth;$i++) 
    {
        //if($i == $numDay) // today 
        if($i == $numDay) 
        {
            echo'<th id="today" style="border: 1px solid; padding-top: 15px;">'; 
        } 
        else 
        { 
            echo"<th style='width: 10%;'>"; 
        }
          echo " <form action='' method='POST'>";
            echo "<input type='hidden' name='numDay' value='$i'>";
            echo "<input type='hidden' name='numMonth' value='$numMonth'>";
            echo "<input type='hidden' name='numYear' value='$numYear'>";
            echo "<input type='submit' value='$i' style='padding:10px; width:80%' disable>";
          echo "</form>";
        echo "</th>";
        if(date('w', mktime(0,0,0,$numMonth, $i, $numYear)) == 6) 
        {
          echo("</tr><tr>");
        }
    }
    ?>
    </tr>
    </tbody>
    </table>


    <style>
        .appointmentSlot{
          align-items: center;
          justify-content: center;
          border: 1px solid #4c72fb;
          background-color: #fff;
          color: #4c72fb;
          border-radius: 6px;
          text-align: center;
          cursor: pointer;
          padding: 10px;
          margin: 10px;
          font-weight: 600;
          font-size: 18px;
        }
        .appointmentSlot:hover{
          background-color: blue;
          color:white;
        }
        #slotParent{
          display: flex;
          justify-content: space-between;
          align-content: flex-start;
          flex-wrap: wrap;
          width: 50%;
          padding: 10px;
        }
      </style>
    <div id="slotParent">
      <?php

      $date = $numYear . '-' . $numMonth . '-' . $numDay;
      $slots = mysqli_query($conn, "SELECT * FROM `slots` WHERE `date` = '$date'");
      $count_slots = mysqli_num_rows($slots);
      if($count_slots == 0)
      {
        echo "<font color='red'>No Slot Available</font>";
      }
      while($slot = mysqli_fetch_assoc($slots))
      {
      ?>
            <form action="" method="POST">
            <?php 
            if($slot['is_fill'] == 0)
            {
                echo "<div class='appointmentSlot'>"; 
                //echo "<div onclick='this.parentNode.parentNode.submit()'>";
                echo "<div onclick='selectSlot(".$slot['id'].")'id='".$slot['id']."'>";
                echo "<input type='hidden' name='slot_id' id='slot_id' value='".$slot['id']."'>";
                echo "<input type='hidden' name='numDay' id='numDay' value='$numDay'>";
                echo "<input type='hidden' name='numMonth' id='numMonth' value='$numMonth'>";
                echo "<input type='hidden' name='numYear' id='numYear' value='$numYear'>";
            } 
              else
              {
                echo "<div class='appointmentSlot' style='background-color:grey; color:white'>"; 
                echo "<div>";
              } 
              ?>
                <b> 
                <?php 
                    $stime = strtotime($slot['start_time']);
                    $etime = strtotime($slot['end_time']);

                    echo "<div id='slot_v'>" . date("h:i", $stime) . "-" . date("h:i", $etime) . "</div>"; 
                ?> 
                </b>
            </div>
          </div>
            </form>
      <?php } ?>

    </div>



    <table width="100%" border="1px">
        <tr>
            <th>S.No</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
        </tr>
        <?php
        $slots = mysqli_query($conn, "SELECT * FROM `slots` sl join students st on sl.student_id = st.id WHERE `date` = '$date' and is_fill='1'");
        $sno = 0;
        while($slot = mysqli_fetch_assoc($slots))
        {
          $sno++;
           ?>
        <tr>
          <td><?php echo $sno ?></td>
          <td><?php echo $slot['date'] ?></td>
          <td><?php echo $slot['start_time'] ?></td>
          <td><?php echo $slot['end_time'] ?></td>
          <td><?php echo $slot['student_id'] ?></td>
          <td><?php echo $slot['name'] ?></td>
          <td><?php echo $slot['phone'] ?></td>
          <td><?php echo $slot['email'] ?></td>
        </tr>
        <?php } ?>
      </table>

</div>