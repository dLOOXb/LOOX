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
    <link type="text/css" rel="stylesheet" href="../css/hairdresser.css" />
    <link type="text/css" rel="stylesheet" href="../css/calendar.css" />
</head>

<body>

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                <a class="navbar-brand" href="../html/index.html"><img id="logo" src="../pictures/loox.jpg"><span class="sr-only">(current)</span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-left">
                    <li class="aboutUs"><a href="#">Om oss</a></li>
                    <li data-toggle="modal" data-target="#myModal"><a href="#">Kontakt</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Företag och frisörer<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="saloons_hairdressers.html">Visa företag och frisörer</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="registersaloon.html">Registrera företag</a></li>
                            <li><a href="registerhairdresser.html">Registrera frisör</a></li>
                        </ul>
                </ul>
                <form class="navbar-form navbar-right">
                    <div class="form-group">
                        <p><a href=""><strong id="myProfile"> Min Profil </strong></a></p>
                    </div>
                </form>

                <div class="nav-row-below">
                    <ul class="">

                    </ul>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>



    <div class="container-fluid main-part">
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="searchbox text-center">
                <br>
                <h1>Salong PostNord</h1>
                <div id="stars-existing" class="starrr" data-rating='5'></div>
                <div>Kruthusgatan 411 04 Göteborg</div>
                <br>
                <img class="img-responsive" src="../pictures/SalongNamn.jpg">
                <h3>Jenny</h3>
                <h3>Sandra</h3>
                <h3>Anders</h3>
                <h3>Patrik</h3>
                <h3>Martina</h3>
                <br>
                <br>
                <br>



            </div>
        </div>



        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="container-header text-center profile">
                <div class="col-md-6 col-sm-6 col-xs-12">


                    <br>
                    <h1>Jenny</h1>
                    <br>
                    <span class="rating">
                      <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    <br>
                    <br>
                    </span>
                    <br>


                    <img class="img-responsive" src="../pictures/Jenny.jpg">

                    <a href="https://www.facebook.com/">
                        <img class="social" id="facebook" src="../pictures/facebook.png">
                    </a>
                    <a href="https://www.instagram.com/">
                        <img class="social" id="instagram" src="../pictures/instagram.png">
                    </a>
                    <a href="https://www.twitter.com/">
                        <img id="twitter" class="social" src="../pictures/twitter.png">
                    </a>

                </div>



                <div class="col-md-6 col-sm-6 col-xs-12">
                   <br>
                  <h1>Boka en tid</h1>
                    <br>
                    <br>
                    <br>
                   





                    <!-- <a class="btn btn-success" id="bookButton" href="../backend/calendar.php">BOKA EN TID</a> -->
                </div>

            </div>


            <div>


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
    
    
              if (isset($_POST['btnadd'])) {
            
            if (isset($_POST['availSlot'])) {
                
               $selectedHour = $_POST['availSlot'];
                $tid = $year."-".$month."-".$day." ".$selectedHour;
                $namn = "Dummy Name"; //****** take user name with super global variable    $_SESSION['id'];
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
                
        
       // $_SESSION['sess_id'] = $pdo->lastInsertId() . date("z");
       // $_SESSION['sess_user'] = $_POST['user'];
       // $_SESSION['userid'] = $pdo->lastInsertId();
        
    
        
        ///// ***** add a loop here that only leads to this page if booking successfully recorded into db ****

      //  echo "<script type='text/javascript'>document.location.href = 'bekraftelse.php';</script>";
            //exit;        
        
    }
            }
            
            
        
         else {
             
         }
    
    ?>
                    <table border='1' align='center' style='font-size:18px;'>
                        <tr>
                            <td align='center'> <input style='width:50px' type='button' value='<' class='btn btn-black' name='previousbutton' onclick="goLastMonth(<?php echo $month." , ".$year?>)" /> </td>
                            <td colspan='5' align='center'>
                                <?php echo $monthName.", ".$year;
                    ?> </td>
                            <td align='center'><input style='width:50px' type='button' value='>' class='btn btn-black' name='nextbutton' onclick="goNextMonth(<?php echo $month." , ".$year?>)" /></td>
                        </tr>
                        <tr style='height:40px;'>
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
          echo "<tr'>";
          
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


            </div>

            <div class="text-center">
                <?php 
    
    if(isset($_GET['v'])){
        
        echo "<td align='center'></td>Lediga tider med Jenny den <span style='color: white; background: black;'>".$day."-".$month."-".$year."</span>:";
        
        include("eventform.php");
        
    }
    ?>

            </div>
            <br>
            <br>



        </div>
    </div>


    <!-- Contact Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Kontakta Oss</h4>
                </div>
                <div class="modal-body">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    <p>Email: Info@loox.se</p>
                    <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                    <p>Ring: 0046761828192</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Forgot Password -->
    <div class="modal fade" id="forgotPWModal" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Glömt Lösenord?</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="text" class="form-control" placeholder="Email">
                        <button class="btn btn-success sendButton" data-dismiss="modal">Skicka</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <footer class="footer">

        <div class="container ">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-6">
                    <p class="text-muted">© Loox</p>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 space">
                    <div class="flex">
                        <!-- Twitter -->
                        <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Läs Mer Om Loox här: https://loox.se ">Tweet</a>
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/">
                            <img class="social margin-left-10px" src="../pictures/facebookBlack.png">
                        </a>
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/">
                            <img class="social margin-left-10px" id="instagramSocial" src="../pictures/instagram.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </footer>

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

    <script src="../javascript/star.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/assets/javascripts/bootstrap.js"></script>
    <script src="../javascript/hairdresser.js"></script>
    <script src="../javascript/about.js"></script>

</body>

</html>
