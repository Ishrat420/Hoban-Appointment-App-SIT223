<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/index.css">
      <title>HOBAN</title>
   </head>
   <body>
      <?php include "navbar.php"; 
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
          
          
          ?>
      <div class="container" style="margin-top: 2.5em;">
         <div class="card-deck mt-5">
            <div class="card mt-5">
               <div class="card-body">
                  <h5 class="card-title">TAKE APPOINTMENT</h5>
                  <table align="center">
                     <thead>
                        <form action="" method="POST">
                           <input type="hidden" name="numDay" value="<?php echo $numDay ?>">
                           <input type="hidden" name="numMonth" value="<?php echo $numMonth ?>">
                           <input type="hidden" name="numYear" value="<?php echo $numYear ?>">
                           <tr>
                              <th> <input type="submit" class="navbtn" name="prev" value="<<"> </th>
                              <th colspan=5> <?php echo strtoupper($strMonth) . '-' . $numYear; ?> </th>
                              <th> <input type="submit" class="navbtn" name="next" value=">>"> </th>
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
                                      echo'<th id="today" style="border: 1px solid red;background-color: #00000000;">'; 
                                  } 
                                  else 
                                  { 
                                      echo"<th style='width: 10%;'>"; 
                                  }
                                    echo " <form action='' method='POST'>";
                                      echo "<input type='hidden' name='numDay' value='$i'>";
                                      echo "<input type='hidden' name='numMonth' value='$numMonth'>";
                                      echo "<input type='hidden' name='numYear' value='$numYear'>";
                                      echo "<input type='submit' value='$i' style='padding:10px; width:80%;background-color: #45A29E;border: 1px solid #66FCF1; color:#ffffff;padding: 10px;margin: 10px;border-radius: 15px;' disable>";
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
               </div>
               <div class="card-footer">
               </div>
            </div>
            <div class="card mt-5">
               <div class="card-body">
               <form action="" method="POST">
                  <?php
                     $date = $numYear . '-' . $numMonth . '-' . $numDay;
                     ?>
                     <input type="hidden" name="date" value="<?php echo $date ?>">
                     <input type='hidden' name='numDay' value='<?php echo $numDay ?>'>
                     <input type='hidden' name='numMonth' value='<?php echo $numMonth ?>'>
                     <input type='hidden' name='numYear' value='<?php echo $numYear ?>'>
                     <fieldset class="col-sm-12 form-e">
                        <input type="time" id="start_time" name="start_time" class="form__input" autocomplete="off" placeholder=" ">
                        <label for="start_time" class="form__label">Start Time</label>
                     </fieldset>
                     <fieldset class="col-sm-12 form-e">
                        <input type="number" id="no_of_slots" name="no_of_slots"  class="form__input" autocomplete="off" placeholder=" ">
                        <label for="no_of_slots" class="form__label">No of Slots</label>
                     </fieldset>
                     <fieldset class="col-sm-12 form-e">
                        <input type="number" id="interval" name="interval" min="5" class="form__input" autocomplete="off" placeholder=" ">
                        <label for="interval" class="form__label">Interval</label>
                     </fieldset>
               </div>
               <div class="card-footer">
                  <input type="submit" class="btn btn-save-slot" name="save" value="Save">
                  <button type="button" class="btn btn-cancel-slot">Cancel</button>
               </div>
			   </form>
            </div>
         </div>
         <div class="card mt-5">
            <div class="card-body">
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
                           <input type="submit" name="delete" class="navbtn" value="Delete">
                        </form>
                     </td>
                  </tr>
                  <?php } ?>
               </table>
            </div>
            <div class="card-footer">
            </div>
         </div>
      </div>
      </div>
      <?php include "footer.php"; ?>
      <script src="js/all.js"></script>
   </body>
</html>