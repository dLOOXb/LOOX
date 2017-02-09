<form name="eventform" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>?month=<?php echo $month;?>&day=<?php echo $day;?>&year=<?php echo $year;?>&v=true&add=true">


    <ul>
        <?php 
        
        //eventually establish $b as a variable tied to user session and behandlareID
        $b = 0;
        
        //stores schedule for clicked date into object
        $behandlareSTM = 
            $pdo->query("SELECT tid FROM `bokadeTider` WHERE `tid` LIKE '%$year-$month-$day%' AND behandlareID=$b");
        
        //Next week: keep pursying the below leads for solution:
        
        //$result = print_r($behandlareSTM);
        
        //echo "<div style='display:none;'>".$result = print_r($behandlareSTM)."</div>";
        
        //function that searches for a parcel of string into a PDO statement
        
        $result ="";
        
        
            for ($i=9; $i<=18; $i++) {
        
                $timeSlot = $i.":00";
       
              
                if (strpos($result, $timeSlot) == false)    {
            
                    echo "<li><input type='radio' name='availSlot' value='".$i.".00-".($i+1).".00'>kl. ".$i.".00-".($i+1).".00</li>";
            }
        
                else    {
            
                    echo "<li class='unavailSlot'>kl. ".$i.".00-".($i+1).".00 is unavailable</li>";
                }
            }
        
        
        
    ?>

    </ul>
    
    <p>Eventuella kommentarer:</p>
     <td width="250px"><textarea name="txtdetail"></textarea></td>
<br>
   <br>
    <input type="button" name="btnback" value="Tillbacka"> &nbsp; &nbsp;
    <input type="submit" name="btnadd" value="Boka">

<br>
    

</form>
