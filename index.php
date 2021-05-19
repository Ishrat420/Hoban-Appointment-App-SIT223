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

           $stdNo = $_POST['student_id'];
           $slot_id = $_POST['slot_id'];
           $name = $_POST['name'];
           $phone = $_POST['phone'];
           $email = $_POST['email'];
         
           mysqli_query($conn, "INSERT INTO `students`(`No`,`name`, `phone`, `email`) VALUES ('$stdNo','$name', '$phone', '$email')");
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
         
         
         
         ?>
      <div class="container" style="margin-top: 2.5em;">
         <div class="card-deck mt-5">
            <div class="card mt-5">
               <div class="card-body">
                  <h5 class="card-title">Book Appointment</h5>
                  <form action="" method="POST">
                     <fieldset class="col-sm-12 form-e">
                        <input type="text" id="student_id" name="student_id" class="form__input" autocomplete="off" placeholder=" ">
                        <label for="student_id" class="form__label">Student ID</label>
                     </fieldset>
                     <fieldset class="col-sm-12 form-e">
                        <input type="text" id="name" name="name" class="form__input" autocomplete="off" placeholder=" ">
                        <label for="name" class="form__label">Name</label>
                     </fieldset>
                     <fieldset class="col-sm-12 form-e">
                        <input type="text" id="email" name="email" class="form__input" autocomplete="off" placeholder=" ">
                        <label for="email" class="form__label">Email</label>
                     </fieldset>
                     <fieldset class="col-sm-12 form-e">
                        <input type="text" id="phone" name="phone" class="form__input" autocomplete="off" placeholder=" ">
                        <label for="phone" class="form__label">Phone</label>
                     </fieldset>
                     <fieldset class="col-sm-12 form-e">
                        <input type="text" id="slot" name="slot" class="form__input" autocomplete="off" placeholder=" ">
                        <label for="slot" class="form__label">Slot</label>
                     </fieldset>
                     <input type='hidden' name='slot_id' id='f_slot_id' value='0'>
                     <input type='hidden' name='numDay' value='<?php echo $numDay ?>'>
                     <input type='hidden' name='numMonth' value='<?php echo $numMonth ?>'>
                     <input type='hidden' name='numYear' value='<?php echo $numYear ?>'>
                  
               </div>
               <div class="card-footer">
                  <input type="submit" name="save_std" class="btn btn-save" value="Save" onclick="return validate()">
                  <button type="button" class="btn btn-cancel">Cancel</button>
               </div>
               </form>
            </div>
            <div class="card mt-5">
               <div class="card-body">
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
                  <div class="card-footer">
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
            </div>
         </div>
         
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
      <td><?php echo $slot['no'] ?></td>
      <td><?php echo $slot['name'] ?></td>
      <td><?php echo $slot['phone'] ?></td>
      <td><?php echo $slot['email'] ?></td>
   </tr>
   <?php } ?>
</table>
                  <div class="card-footer">
                     
                  </div>
               </div>
            </div>
                              </div>
                              </div>
      <?php include "footer.php"; ?>
      <script src="js/all.js"></script>

   </body>
</html>