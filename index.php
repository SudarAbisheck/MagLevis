<?php

require "connect.inc.php";

	$error_mess ="ERROR :";

 if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['datepicker']) && isset($_POST['sourcestn']) && isset($_POST['deststn']) && isset($_POST['age'])){
  $name = trim($_POST['firstname'])." ".trim($_POST['lastname']);
  $email = trim($_POST['email']);
  $doj = trim($_POST['datepicker']);
  $source_stn = trim($_POST['sourcestn']);
  $dest_stn = trim($_POST['deststn']);
  $age = trim($_POST['age']);

  

   $get_query = "select * from train where source_stn='".$source_stn."' and dest_stn='".$dest_stn."'";
  

    if($query_run = mysql_query($get_query)){
        if(mysql_num_rows($query_run) == 1){
            while($row = mysql_fetch_assoc($query_run)){
                $train_no = $row['train_no'];
                $train_name = $row['train_name'];
                $start_time = $row['start_time'];
                $end_time = $row['end_time'];
                $seat_series = $row['seat_series'];
                $total_seats = $row['total_seats'];
                $fare = $row['fare'];

                $train_avail_query = 'select * from train_schedule where train_no="'.$train_no.'" and doj="'.$doj.'"';
                    if($run = mysql_query($train_avail_query)){
                        while($t_row = mysql_fetch_assoc($run)){
                           $avail_seats = $t_row['avail_seats'];

                           $book_id_query = 'select * from book_id_count where 1';
                           if($run = mysql_query($book_id_query)){
                                while($t_row = mysql_fetch_assoc($run)){
                                    $id_serial = $t_row['id_serial'];
                                    $id_count = $t_row['id_count'];
                                    $id_count++;
                                    $booking_id = $id_serial . $id_count;
                                    $seat_no = $seat_series . ($total_seats - $avail_seats + 1); 
                                    $avail_seats --;

                                    $ticket_insert_query = 'insert into ticket values ("'.$booking_id.'","'.$name.'","'.$age.'","'.$email.'","'.$train_no.'","'.$doj.'","'.$seat_no.'")';

                                    $id_update_query = 'update book_id_count set id_count="'.$id_count.'"';

                                    $avail_seats_query = 'update train_schedule set avail_seats="'.$avail_seats.'" where train_no="'.$train_no.'" and doj="'.$doj.'"';

                                    $m_run = mysql_query($id_update_query);
                                    $s_run = mysql_query($ticket_insert_query);
                                    $seat_run = mysql_query($avail_seats_query);

                                    $location = 'print/?booking-id='.$booking_id;
                                    header('Location: '.$location);
                                }
                           }
                        }
                    }else{
                        $error_mess += " No train available on that date.";
                        }
            }
        }else{
            $error_mess += " Too much results returned.";
            }
    }else{
        $error_mess +=" Unable to run the query.";
        }

}

?>



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

		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/jquery-ui.min.css">
		<script src="js/vendor/modernizr-2.6.2.min.js"></script>
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<!-- Add your site or application content here -->
	   <header>
			<section id = "logo"><a href="">MagLevis</a></section>
			<ul id="nav">
				<li><a href="#book">Book Now</a></li>
				<li><a href="print/">Print</a></li>
				<li><a href="cancel/">Cancel</a></li>
			</ul>
			<section class="bottom_line" ></section>
	   </header>

	   <section class="big-space"></section>

	   <?php 

	   if($error_mess != "ERROR :")
	   {
	   	echo "<section id='error-report'><p>".$error_mess."</p></section>";
	   }
	   
	   ?>

	   <section class="main-wrapper">
			<section class="message">
				<p class="wel-message">Namasthe !</p>
				<p class="in-message">Enjoy the Magnetic ride with luxury.<br/>Book your Tickets soon.<br/>Hurry! Limited Seats Available..</p>
				<a href="#book" class='book-button'>Grab My Ticket</a>
			</section>
			<section class = "train-image"></section>
			<section class="divider-line"></section>
			<section class="form-wrapper">
				<h1 id="book">Book your Tickets !!</h1>
				<form name="bookform"  onsubmit="return (validate());" method="post" action="index.php">
					<p class="all-required">* All fields are required</p>
					<div class="div-form">
					<label>
					<div>First name</div><input id="firstname" type="text" name="firstname" /><span id="fname-error" class="error"></span>
					</label>

					<label>
					<div>Last Name</div><input id="lastname" type="text" name="lastname" /><span id="lname-error" class="error"></span>
					</label>

					<label>
					<div>Email</div><input id="email" type="text" name="email" /><span id="email-error" class="error"></span>
					</label>

					<label>
					<div>Date of Journey</div><input id="datepicker" type="text" name="datepicker" readonly /><span id="date-error" class="error"></span>
					</label>

					<label>
						<div>Source Stn.</div>
						<select name="sourcestn"  value="0" >
							<option value="0" >Choose Source</option>
							<option value="Chennai">Chennai</option>
							<option value="Delhi">Delhi</option>
							<option value="Mumbai">Mumbai</option>
							<option value="Kolkata">Kolkata</option>
						  </select><span id="source-error" class="error"></span>
					</label>

					<label>
						<div>Destination Stn.</div>
						<select name="deststn" value="0" >
							<option value="0">Choose Destination</option>
							<option value="Chennai">Chennai</option>
							<option value="Delhi">Delhi</option>
							<option value="Mumbai">Mumbai</option>
							<option value="kolkata">Kolkata</option>
						  </select> <span id="dest-error" class="error"></span>
					</label>

					<label>
					<div>Age (13-60)</div><input id="age" type="number" name="age" min="13" max="60"/><span id="age-error" class="error"></span>
					</label>

					<label>
					<div><span id="one"></span> + <span id="two"></span> =</div><section id = "refresh" onclick="captchaLoad()"></section>
					<input id="captcha" type="text" name="captcha" />
					<span id="captcha-error" class="error"></span>
					</label>

					<input type="submit" value="Submit" />
					</div>
				</form>
			</section>
	   </section>

	   <section class="big-space2"></section>

	   <footer>
		<section class="top-line"></section>
		<section class="copyrights"><p>&copy; All Rights Reserved. <a href="">MagLevis</a>. Designed by <a href="http://sudarabisheck.com" target="_blank">Sudar Abisheck</a></p></section>
	   </footer>


		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script src="js/plugins.js"></script>
		<script src="js/main.js"></script>
        <script src="js/validation.js"></script>

		<script src="js/vendor/jquery-ui.min.js"></script>
		<script>
		  $(function() {
			$( "#datepicker" ).datepicker({ 
				minDate: "+0d",
				maxDate: "+1w",
				dateFormat: "yy-mm-dd"
			});
		  });
		</script>
		
		
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
