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
                <li><a href="../print/">Print</a></li>
            </ul>
            <section class="bottom_line" ></section>
       </header>

       <section class="big-space"></section>

       <section class="main-wrapper" style="height: 400px;">

        <?php

             if(isset($_GET['booking-id'])){
                $booking_id = $_GET['booking-id'];
                
                if(!($booking_id == "" || $booking_id == null)){

                    require "connect.inc.php";

                    $query = 'delete from ticket where booking_id="'.$booking_id.'"';
                    if($run = mysql_query($query)){
                        if(@mysql_affected_rows($run)==0)
                            echo '<section id="email-mess" style="border: 1px solid #f00;">Invalid Booking-ID</section>';
                        else
                            echo '<section id="email-mess">Ticket cancelled</section>';
                    }
                                                

                }
                else echo '<section id="email-mess" style="border: 1px solid #f00;">No proper Booking-ID is entered</section>';
            }
            else {

        ?>

            <section class="form-wrapper">
                <h1 id="book">Ticket Cancellation</h1>
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

        <?php } ?>
       </section>

       <section class="big-space2"></section>

       <footer>
        <section class="top-line"></section>
        <section class="copyrights"><p>&copy; All Rights Reserved. <a href="../">MagLevis</a>. Designed by <a href="http://sudarabisheck.com" target="_blank">Sudar Abisheck</a></p></section>
       </footer>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

        
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
