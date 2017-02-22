<br>
<br>
<form name="eventform" method="POST"
      action="<?php $_SERVER['PHP_SELF']; ?>?month=<?php echo $month; ?>&day=<?php echo $day; ?>&year=<?php echo $year; ?>&v=true&add=true">

    <ul>
        <?php
        //eventually establish $b as a variable tied to user session and behandlareID
        $b = 0;
        //stores schedule for clicked date into object
        $behandlareSTM =
            $pdo->prepare("SELECT `tid` FROM `bokadetider` WHERE `tid` LIKE '%$year-$month-$day%' AND behandlareID=$b");
        try {
            $behandlareSTM->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        //loops through the db to check availability of each time block
        if ($behandlareSTM->rowCount() != 0) {
            foreach ($behandlareSTM as $row) {
                $taken[] = substr($row['tid'], 11);   //remove 8 or 10 characters to only keep time interval
            }
            for ($i = 9; $i <= 18; $i++) {
                $timeSlot = $i . ".00-" . ($i + 1) . ".00";
                if (in_array($timeSlot, $taken)) {
                    echo "<li class='unavailSlot'>kl. " . $i . ".00-" . ($i + 1) . ".00 är inte tillgänglig</li>";
                } else {
                    echo "<li><input type='radio' name='availSlot' value='" . $i . ".00-" . ($i + 1) . ".00'>kl. " . $i . ".00-" . ($i + 1) . ".00</li>";
                }
            }
        //if SQL search returns nothing from database, run through the full length of the loop    
        } else {
            for ($i = 9; $i <= 18; $i++) {
                echo "<li><input type='radio' name='availSlot' value='" . $i . ".00-" . ($i + 1) . ".00'>kl. " . $i . ".00-" . ($i + 1) . ".00</li>";
            }
        }
        ?>

    </ul>

    <p>Eventuella kommentarer:</p>
    <td width="250px"><textarea name="txtdetail"></textarea></td>
    <br>
    <br>
    <input type="submit" name="btnadd" value="Boka" class="btn btn-success">
    <br>
</form>