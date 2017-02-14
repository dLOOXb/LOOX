<?php session_start(); ?>

<!--

date format is : day-month-year (e.g. 04-02-2017 HH:MM:SS)

-->

<?php 
//import config file for db linkage
require "config.php";

?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <title>LOOX</title>
    <link type="text/css" rel="stylesheet" href="../css/layout.css" />
    <link type="text/css" rel="stylesheet" href="../css/calendar.css" />
    

</head>

<body>

   
   
   
   
    <?php
    
    //If day not pre-determined by user, sets day to today
    if (isset($_GET['day'])) {
        //if user has determined day, fetches data
        $day = $_GET['day'];
    }
    else {  
        //sets date to today
       $day = date("d"); 
    }
    
    //If month not pre-determined by the user, sets month to now
    if (isset($_GET['month'])) {
        //fetches month data
        $month = $_GET['month'];
    }
    else {
        //sets month to now
        $month = date("n");
    }
    

    //If year not pre-determined by user through $_GET, sets year to now
    if (isset($_GET['year'])) {
        $year = $_GET['year'];
    }
    else {
       //sets year to now
        $year = date("Y");  
    }

//set up calendar variables
    
    //Create a variable for current date in time stamp
    $currentTimeStamp = strtotime("$year-$month-$day");
   
    //Get current month name
    $monthName = date("F", $currentTimeStamp);
    
    //Get how many days in current month
    $numDays = date("t", $currentTimeStamp);
    
    //adds one everytime a cell is produced in our table, to keep track of our cells independently of date
    $cellCounter = 0;
    
    
    //Frisör namn -- hämta från databasen!!
    echo "<h1>Jenny</h1>";
        
    //Salong namn -- hämta från databasen!!
    echo "<text>PostNord Salong // Kruthusgatan 411 04 Göteborg</text><br><br>";
    
    
    ?>

       
       
       
       
       
       
        <?php    
        
        if (isset($_POST['btnadd'])) {
            
            if (isset($_POST['availSlot'])) {
                
               $selectedHour = $_POST['availSlot'];
                $tid = $year."-".$month."-".$day." ".$selectedHour;
                $namn = "DummyName"; //****** take anvandarnam från user session here ******
                $detaljer = $_POST['txtdetail'];
       
                $behandlareID = 0; //**** take behandlareID från navigation path page ****
       
                
                $STH = $pdo->prepare("INSERT INTO bokadeTider (namn, detaljer, tid, behandlareID, skapadeDen)
          VALUES('$namn', '$detaljer', '$tid', '$behandlareID', NOW())");
                
                try {
		              $STH->execute();
	               }
        
        /// ***** how does the below work? Do I need anything else?? ***** 
        /// *** will this actually catch any potential errors????? *******
        
 	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
        
                
              //////  $_SESSION['id'];
                
        
        $_SESSION['sess_id'] = $pdo->lastInsertId() . date("z");
        $_SESSION['sess_user'] = $_POST['user'];
        $_SESSION['userid'] = $pdo->lastInsertId();
        
    
        
        ///// ***** add a loop here that only leads to this page if booking successfully recorded into db ****

      //  echo "<script type='text/javascript'>document.location.href = 'bekraftelse.php';</script>";
            //exit;        
        
    }
            }
            
            
        
         else {
             
         }
 
	
        
    ?>


            <!-- HTML table below to be styled by Front End team-->

            <table border='1'>
                <tr>
                    <td align='center'> <input style='width:50px' type='button' value='<' name='previousbutton' onclick="goLastMonth(<?php echo $month." , ".$year?>)" /> </td>
                    <td colspan='5' align='center'>
                        <?php echo $monthName.", ".$year;
                    ?> </td>
                    <td align='center'><input style='width:50px' type='button' value='>' name='nextbutton' onclick="goNextMonth(<?php echo $month." , ".$year?>)" /></td>
                </tr>
                <tr>
                    <td width='50px' align='center'>Sön</td>
                    <td width='50px' align='center'>Mån</td>
                    <td width='50px' align='center'>Tis</td>
                    <td width='50px' align='center'>Ons</td>
                    <td width='50px' align='center'>Tor</td>
                    <td width='50px' align='center'>Fre</td>
                    <td width='50px' align='center'>Lör</td>
                </tr>

                <?php
            
        
        //create a new row for calendar    
          echo "<tr>";
          
            //make loop from 1 to the number of days in the month
            for($i=1; $i<$numDays+1; $i++) {
                
                
                // make timestamp for each day in the loop
                $timeStamp = strtotime("$year-$month-$i");
                
              // ******* compare to today's date and remove link if passed ******
                // ********* if($timeStamp  $todaysDate) *********
                
                // check if first day of the month
                if($i == 1) {
                    
                    // If first day of the month, check if it falls on a Sunday (where Sun=0, Monday=1, Tues=2, etc..)
                    $firstDay = date("w", $timeStamp);
                    
                    //make blank cells if first day does not fall on first cell of table
                    for ($j = 0; $j < $firstDay; $j++) {
                        
                        //blank space
                        echo "<td>&nbsp;</td>";
                        
                        //add one, so we can process the next cell position
                        $cellCounter++;
                    }
                }
                
            //Is it Sunday? if so, break line and begin a new row
                if ($cellCounter % 7 == 0){
                   echo "</tr><tr>";
                }
                
                //establish variables and determines string length
                $monthstring = $month;
                $monthlength = strlen($monthstring);
                $daystring = $i;
                $daylength = strlen($daystring);
                
                //adds zero in front of month digit if only one digit
                if($monthlength <= 1){
                    $monthstring = "0".$monthstring;
                }
                
                //adds zero in front of day digit if only one digit
                if($daylength <= 1){
                    $daystring = "0".$daystring;
                }
                
                $todaysDate = date("d-m-Y");
                $dateToCompare = $daystring.'-'.$monthstring.'-'.$year;
                $dateToCompareSQL = $daystring.':'.$monthstring.':'.$year;
                
                //creates cell, prints date inside it
                 echo "<td align='center'";
                
                
                if ($todaysDate == $dateToCompare) {
                    echo"class='today'";
                } 
                
                /*** add here function to make booked day colored ****
                
                else if ($noOfevent >= 1 ){
                    
                      //later establish $b as a variable tied to user session and behandlareID
                    $b=0;
                    
                    $eventCheckSTMT = $pdo->prepare("SELECT behandlingTid FROM `bokadeTider` WHERE `behandlingTid` LIKE '%$year-$monthstring-$daystring%' AND behandlareID=$b");
                    
                    try { $eventCheckSTMT->execute();}
                    catch(PDOException $e){echo $e->getMessage();}
                    
                    $noOfevent = $eventCheckSTMT->rowCount();
                    
                        echo "class='event'";  
                    
                }
                
            */
                
                
                
                echo "><a href='".$_SERVER['PHP_SELF']."?month=".$monthstring."&day=".$daystring."&year=".$year."&v=true'>".$i."</a></td>";
                
                //add one, so we can process the next cell position
                $cellCounter++;
            }
          
            ?>

           
           
           
           
           
            </table>
            <br>

           
           
           
           <div>
            <?php 
    
    if(isset($_GET['v'])){
        
        echo "<td align='center'></td>Lediga tider med Jenny den <span style='color: white; background: black;'>".$day."-".$month."-".$year."</span>:";
        
        include("eventform.php");
        
    }
    ?>
    
</div>
   
   
    
    <script>
        //navigate to previous month
        function goLastMonth(month, year) {

            if (month == 1) {
                --year;
                month = 13;
            }

            //adds zero in front of one-digit long month number
            --month
            var monthstring = "" + month + "";
            var monthlength = monthstring.length;
            if (monthlength <= 1) {
                monthstring = "0" + monthstring;
            }

            //stores the new month in the URL, to be processed by $_GET later in document
            document.location.href = "<?php $_SERVER['PHP_SELF'];?>?month=" + monthstring + "&year=" + year;
        }

        //navigate to following month
        function goNextMonth(month, year) {
            if (month == 12) {
                ++year;
                month = 0;
            }

            //adds a zero in front of month number, if only one-digit long
            ++month
            var monthstring = "" + month + "";
            var monthlength = monthstring.length;
            if (monthlength <= 1) {
                monthstring = "0" + monthstring;
            }

            //stores the new month in the URL, to be processed by $_GET later in document
            document.location.href = "<?php $_SERVER['PHP_SELF'];?>?month=" + monthstring + "&year=" + year;
        }

    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>
    <script src="../bootstrap/assets/javascripts/bootstrap.js"></script>
    <script src="../javascript/javascript.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYlVGcY8AMg8SJooxNQ9ebks_4aHk3THc&callback=initMap"> </script>
        <script src="../javascript/about.js"></script>

</body>

</html>
