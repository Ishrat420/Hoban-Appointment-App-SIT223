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

if(isset($_POST['prev']))
{
  $numMonth = $_POST['numMonth']-1;
}
if(isset($_POST['next']))
{
  $numMonth = $_POST['numMonth']+1;
}

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

if(isset($_POST['delete']))
{
  $slot_id = $_POST['slot_id'];
  mysqli_query($conn, "DELETE FROM `slots` WHERE id = '$slot_id'");
}

if(isset($_POST['save']))
{
  $date = $_POST['date'];
  $start_time = $_POST['start_time'];
  $no_of_slots = $_POST['no_of_slots'];
  $interval = $_POST['interval'];
  $end_time = date('H:i:s',strtotime('+'.$interval.' minutes',strtotime($start_time)));

  for($i=0; $i<$no_of_slots; $i++)
  {
      $end_time = date('H:i:s',strtotime('+'.$interval.' minutes',strtotime($start_time)));
      mysqli_query($conn, "INSERT INTO `slots`(`date`, `start_time`, `end_time`) 
                           VALUES ('$date', '$start_time', '$end_time')");

      $start_time = $end_time;
  }
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

<div id="main" align="center">
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
            echo "<input type='submit' value='$i' style='padding:10px; width:50%' disable>";
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
          height: 100%;
          width: 50%;
          padding: 10px;
        }
      </style>
    <div id="slotParent">
      <?php
      $date = $numYear . '-' . $numMonth . '-' . $numDay;
      ?>
      <form action="" method="POST">
          <input type="hidden" name="date" value="<?php echo $date ?>">
          <input type='hidden' name='numDay' value='<?php echo $numDay ?>'>
          <input type='hidden' name='numMonth' value='<?php echo $numMonth ?>'>
          <input type='hidden' name='numYear' value='<?php echo $numYear ?>'>
          
          <table width="100%">
          <tr>
            <td>Start Time : </td>
            <td> <input type="time" name="start_time"  style="width:200px"> </td>
          </tr>
          <tr>
            <td> No of Slots : </td>
            <td> <input type="number" min="1" name="no_of_slots" placeholder="Total slots after the strat time" style="width:200px"> </td>
          </tr>
          <tr>
             <td> Interval : </td>
             <td><input type="number" min="5" name="interval" placeholder="Time interval in minutes" style="width:200px">  </td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="save" value="Save"></td>
          </tr>
          </table>
      </form>
      <table width="100%" border="1px">
        <tr>
            <th>S.No</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Action</th>
        </tr>
        <?php
        $slots = mysqli_query($conn, "SELECT * FROM `slots` WHERE `date` = '$date'");
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
          <td>
            <form action="" method="POST">
              <input type='hidden' name='numDay' value='<?php echo $numDay ?>'>
              <input type='hidden' name='numMonth' value='<?php echo $numMonth ?>'>
              <input type='hidden' name='numYear' value='<?php echo $numYear ?>'>
              <input type="hidden" name="slot_id" value="<?php echo $slot['id'] ?>">
              <input type="submit" name="delete" value="Delete">
            </form>
          </td>
        </tr>
        <?php } ?>
      </table>
    </div>



</div>