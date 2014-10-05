<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MagLevis</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/print.css">

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
       <header>
            <section id = "logo"><a href="../">MagLevis</a></section>
            <ul id="nav">
                <li><a href="../#book">Book Now</a></li>
                <li><a href="../cancel/">Cancel Ticket</a></li>
            </ul>
            <section class="bottom_line" ></section>
       </header>

       <section class="big-space"></section>
       <section class="main-wrapper">

       <?php

             if(isset($_GET['booking-id'])){
                $booking_id = $_GET['booking-id'];
                
                if(!($booking_id == "" || $booking_id == null)){

                    require "connect.inc.php";

                    $query = 'select ti.name, ti.age, ti.train_no, ti.email, ti.doj, ti.seat_no, tr.train_name, tr.source_stn, tr.dest_stn, tr.start_time, tr.end_time, tr.fare from ticket ti join train tr on ti.train_no = tr.train_no where ti.booking_id = "'.$booking_id.'"';
                    if($run = mysql_query($query)){
                        if(mysql_num_rows($run)==1){
                            while($row = mysql_fetch_assoc($run)){
                                $name = $row['name'];
                                $age = $row['age'];
                                $doj = $row['doj'];
                                $train_no = $row['train_no'];
                                $train_name = $row['train_name'];
                                $seat_no = $row['seat_no'];
                                $fare = $row['fare'];
                                $source_stn = $row['source_stn'];
                                $dest_stn = $row['dest_stn'];
                                $start_time = $row['start_time'];
                                $end_time = $row['end_time'];
                                $email = $row['email'];
                                $qrcode = '<img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl='.$booking_id.'&choe=UTF-8" title="Booking-ID : '.$booking_id.'" alt="QR code"/>';
                            }
                            $subject ="MagLevis Ticket";
                            $body = '
                            <html>
                            <head><title>Maglevis Ticket</title>
                            </head>
                            <body>
                            <h1>Maglevis</h1>


                            <p><b>Your ticket has been booked.</b></p>
                            <p>To print your ticket please <a href=http://maglevis.hol.es/print/?booking_id='.$booking_id.' style="color:#16A085;">click here.<a></p>

                            <br/>
                            <br/>
                            <p>If this mail is not intended for you, please ignore it.</p>

                            </body>
                            </html>

                            ';

                            // Always set content-type when sending HTML email
                            $headers = "MIME-Version: 1.0" . "\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\n";
                            $headers .= 'From: MagLevis <noreply@maglevis.hol.es>';

                            if(mail($email, $subject, $body, $headers))
                                echo '<section id="email-mess">Your Ticket has been successfully sent to <b>'.$email.'</b>. Please check your email spam folder incase you didn\'t find our mail in your inbox.</section>';
                            else
                                echo '<section id="email-mess" style="border: 1px solid #f00;">Email sending Failed :(</section>';


        ?>
       
            
            <section id="ticket-wrapper">
               <section id="ticket-logo">MagLevis</section>
               <section id="qrcode"> <?php echo $qrcode; ?> </section>
               <section class="ticket-details">
                    <p><b>Booking-ID</b> : <?php echo $booking_id; ?></p>
                    <p><b>Name</b> : <?php echo $name; ?></p>
                    <p><b>Train Name</b> : <?php echo $train_name; ?></p>
                    <p><b>Seat No.</b> : <?php echo $seat_no; ?></p>
                    <p><b>Source Station</b> : <?php echo $source_stn; ?></p>
                    <p><b>Departure Time</b> : <?php echo $start_time; ?></p>
               </section>
               <section class="ticket-details">
                    <p><b>Date Of Journey</b> : <?php echo $doj; ?></p>
                    <p><b>Age</b> : <?php echo $age; ?></p>
                    <p><b>Train No</b> : <?php echo $train_no; ?></p>
                    <p><b>Fare</b> : Rs.<?php echo $fare; ?></p>
                    <p><b>Destination Station</b> : <?php echo $dest_stn; ?></p>
                    <p><b>Arrival Time</b> : <?php echo $end_time; ?></p>
               </section>
            </section>
            <p id="print" onclick="window.print()">Print</p>
       

       <?php 
                           } else echo '<section id="email-mess" style="border: 1px solid #f00;">Invalid Booking-ID</section>';
                    }
         }
           else echo '<section id="email-mess" style="border: 1px solid #f00;">No proper Booking-ID is entered</section>';
           }
           else{
        ?>

        <section class="form-wrapper">
                <h1 id="book">Print Ticket</h1>
                <form id="form"   method="get" action="">
                    <div class="div-form">
                    <label>
                    <div>Booking ID</div><input id="booking-id" type="text" name="booking-id" /><span id="fname-error" class="error"></span>
                    </label>

                    <input type="submit" value="Submit" />
                    </label>

                    </div>
                </form>
            </section>

    <?php  }  ?>


       </section>
       <section class="big-space2"></section>

       <footer>
        <section class="top-line"></section>
        <section class="copyrights"><p>&copy; All Rights Reserved. <a href="../">MagLevis</a>. Designed by <a href="http://sudarabisheck.com" target="_blank">Sudar Abisheck</a></p></section>
       </footer>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

        
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <!--<script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>  -->
    </body>
</html>