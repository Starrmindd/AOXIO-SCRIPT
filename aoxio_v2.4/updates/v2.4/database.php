<?php
session_start();
error_reporting(1);

$db_config_path = '../application/config/database.php';

if (!isset($_SESSION["license_code"])) {
    $_SESSION["error"] = "Invalid purchase code!";
    header("Location: index.php");
    exit();
}

if (isset($_POST["btn_admin"])) {

    $_SESSION["db_host"] = $_POST['db_host'];
    $_SESSION["db_name"] = $_POST['db_name'];
    $_SESSION["db_user"] = $_POST['db_user'];
    $_SESSION["db_password"] = $_POST['db_password'];


    /* Database Credentials */
    defined("DB_HOST") ? null : define("DB_HOST", $_SESSION["db_host"]);
    defined("DB_USER") ? null : define("DB_USER", $_SESSION["db_user"]);
    defined("DB_PASS") ? null : define("DB_PASS", $_SESSION["db_password"]);
    defined("DB_NAME") ? null : define("DB_NAME", $_SESSION["db_name"]);

    /* Connect */
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection->query("SET CHARACTER SET utf8");
    $connection->query("SET NAMES utf8");

    /* check connection */
    if (mysqli_connect_errno()) {
        $error = 0;
    } else {
        
        mysqli_query($connection, "UPDATE settings SET version = '2.4' WHERE id = 1;");

        mysqli_query($connection, "ALTER TABLE `services` CHANGE `tax` `tax` DECIMAL(10,2) NULL DEFAULT NULL;");

        mysqli_query($connection, "UPDATE `lang_values` SET `label` = 'Ultramsg', `keyword` = 'ultramsg', `english` = 'Ultramsg' WHERE `lang_values`.`keyword` = 'ultramsg-api';");

        mysqli_query($connection, "ALTER TABLE `business` CHANGE `tax_amount` `tax_amount` VARCHAR(11) NULL DEFAULT NULL;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `cancelation_time` VARCHAR(255) NOT NULL DEFAULT '0' AFTER `time_interval`;");
        mysqli_query($connection, "ALTER TABLE `settings` ADD `reminder_before` VARCHAR(255) NOT NULL DEFAULT '1' AFTER `time_zone`;");

        mysqli_query($connection, "INSERT INTO `features` (`name`, `slug`, `is_limit`, `basic`, `standared`, `premium`, `plus`) VALUES ('Events', 'events', '1', '5', '10', '50', '5000');");

        mysqli_query($connection, "ALTER TABLE `business` ADD `enable_event` INT(2) NULL DEFAULT '0' AFTER `enable_onsite`;");


        // import database table
        $query = '';
          $sqlScript = file('sql/events.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }


        // import database table
        $query = '';
          $sqlScript = file('sql/event_ticket.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/event_category.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/event_venue.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/event_booking.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/payment_user_event.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }



        mysqli_query($connection, "INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Enable Default Timezone', 'enable-default-timezone', 'Enable Default Timezone'),
        ('user', 'Enable to use company timezone for your all booking customers', 'enable-default-timezone-title', 'Enable to use company timezone for your all booking customers'),
        ('user', 'Contact Message from', 'contact-message-from', 'Contact Message from'),
        ('user', 'Events', 'events', 'Events'),
        ('user', 'Tickets', 'tickets', 'Tickets'),
        ('user', 'Venues', 'venues', 'Venues'),
        ('user', 'Website', 'website', 'Website'),
        ('user', 'Vedio URL', 'vedio-url', 'Vedio URL'),
        ('user', 'Is seatable ?', 'is-seatable-', 'Is seatable ?'),
        ('user', 'Is seatable ?', 'is-seatable', 'Is seatable ?'),
        ('user', 'Total attendee', 'total-attendee', 'Total attendee (Maximum )'),
        ('user', 'Venue Image', 'venue-image', 'Venue Image'),
        ('user', 'Total Seat', 'total-seat', 'Total Seat'),
        ('user', 'Seating info', 'seating-info', 'Seating info'),
        ('user', 'Event Image', 'event-image', 'Event Image'),
        ('user', 'Audience Type', 'audience-type', 'Audience Type'),
        ('user', 'Youtube Vedio URL', 'youtube-vedio-url', 'Youtube Vedio URL'),
        ('user', 'External Link', 'external-link', 'External Link'),
        ('user', 'Contact Number', 'contact-number', 'Contact Number'),
        ('user', 'Artists', 'artists', 'Artists (if  any artist of this event)'),
        ('user', 'Is this organized by other ?', 'is-other-organizer', 'Is this organized by other ?'),
        ('user', 'Organizer Name', 'organizer-name', 'Organizer Name'),
        ('user', 'Organizer Phone', 'organizer-phone', 'Organizer Phone'),
        ('user', 'Organizer Email', 'organizer-email', 'Organizer Email'),
        ('user', 'Organizer Website', 'organizer-website', 'Organizer Website'),
        ('user', 'Meta Tags', 'meta-tags', 'Meta Tags'),
        ('user', 'Meta Description', 'meta-description', 'Meta Description'),
        ('user', 'Ticket Name', 'ticket-name', 'Ticket Name'),
        ('user', 'Ticket Details', 'ticket-details', 'Ticket Details'),
        ('user', 'Ticket Price', 'ticket-price', 'Ticket Price'),
        ('user', 'Sales Start', 'sales-start', 'Sales Start'),
        ('user', 'ticket Description', 'ticket-description', 'ticket Description'),
        ('user', 'Ticket Per Attendee', 'ticket-per-attendee', 'Ticket Per Attendee'),
        ('user', 'Sales End', 'sales-end', 'Sales End'),
        ('user', 'Venue', 'venue', 'Venue'),
        ('user', 'Event', 'event', 'Event'),
        ('user', 'Venue Info', 'venue-info', 'Venue Info'),
        ('user', 'Ticket Info', 'ticket-info', 'Ticket Info'),
        ('user', 'Countdown', 'countdown', 'Countdown'),
        ('user', 'Organizer Info', 'organizer-info', 'Organizer Info'),
        ('user', 'Book a ticket', 'book-a-ticket', 'Book a ticket'),
        ('user', 'Event Info', 'event-info', 'Event Info'),
        ('user', 'Maximum', 'maximum', 'Maximum'),
        ('user', 'Ticket', 'ticket', 'Ticket'),
        ('user', 'Total Ticket', 'total-ticket', 'Total Ticket'),
        ('user', 'Total Price', 'total-price', 'Total Price'),
        ('user', 'Event booked successfully', 'event-booked-successfully', 'Event booked successfully'),
        ('user', 'Event booking number', 'event-booking-number', 'Event booking number'),
        ('user', 'You can not buy more than', 'ticket-limit-msg', 'You can not buy more than'),
        ('user', 'Booked new event', 'booked-new-event', 'Booked new event'),
        ('user', 'We are thrilled to inform you that your ticket booking for the upcoming', 'event-booking-confirmation', 'We are thrilled to inform you that your ticket booking for the upcoming event'),
        ('user', 'has been successfully confirmed', 'has-been-successfully-confirmed', 'has been successfully confirmed at'),
        ('user', 'Recently bookrd an event', 'recently-bookrd-an-event', 'Recently booked an event'),
        ('user', 'Recently booked an event', 'recently-booked-an-event', 'Recently booked an event'),
        ('user', 'Bookings', 'bookings', 'Bookings'),
        ('user', 'New Booking', 'new-booking', 'New Booking'),
        ('user', 'Booking', 'booking', 'Booking'),
        ('user', 'Sorry we have only ', 'sorry-we-have-only', 'Sorry !! we have only '),
        ('user', 'More tickets available.', 'more-tickets-available', 'More tickets available.'),
        ('user', 'This event is organized by', 'this-event-is-organized-by', 'This event is organized by'),
        ('user', 'Availlable tickets for', 'availlable-tickets-for', 'Availlable tickets for'),
        ('user', 'Add new ticket', 'add-new-ticket', 'Add new ticket'),
        ('user', 'Appointment Date', 'appointment-date', 'Appointment Date'),
        ('user', 'Appointment Time', 'appointment-time', 'Appointment Time'),
        ('user', 'Appointment Cancelation before', 'cancelation-time', 'Appointment Cancelation before'),
        ('user', 'Appointment Reminder before', 'reminder-before', 'Appointment Reminder before'),
        ('user', 'Set 0 to disable this feature', 'set-0-to-disable-this-feature', 'Set 0 to disable this feature'),
        ('user', 'You have an appointment', 'you-have-an-appointment', 'You have an appointment'),
        ('user', 'The wallet system is now enabled. All appointment payments will be credited to the admin account, with the remaining amount added to your wallet balance.', 'wallet-enable-alert', 'The wallet system is now enabled. All appointment payments will be credited to the admin account, with the remaining amount added to your wallet balance.'),
        ('user', 'Upcoming', 'upcoming', 'Upcoming');");

        mysqli_query($connection, "ALTER TABLE `staffs` ADD `holidays` TEXT NULL DEFAULT NULL AFTER `phone`;");

            
      /* close connection */
      mysqli_close($connection);

      $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://" . $_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
      $redir = str_replace('updates/v2.4/', '', $redir);
      header("refresh:5;url=" . $redir);
      $success = 1;
    }



}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aoxio &bull; Update Installer</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/libs/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,500,600,700&display=swap" rel="stylesheet">
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2">

                <div class="row">
                    <div class="col-sm-12 logo-cnt">
                        <p>
                           <img src="assets/img/logo.png" alt="">
                       </p>
                       <h1>Welcome to the Update Installer</h1>
                   </div>
               </div>

               <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">

                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="100" data-number-of-steps="3" style="width: 100%;"></div>
                            </div>
                            <div class="step" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-arrow-circle-right"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step active" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                        </div>

                        <div class="messages">
                            <?php if (isset($message)) { ?>
                            <div class="alert alert-danger">
                                <strong><?php echo htmlspecialchars($message); ?></strong>
                            </div>
                            <?php } ?>
                            <?php if (isset($success)) { ?>
                            <div class="alert alert-success">
                                <strong>Completing Updates ... <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Please wait 5 second </strong>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="tab-content">
                                        <div class="tab_1">
                                            <h1 class="step-title">Database</h1>
                                            <div class="form-group">
                                                <label for="email">Host</label>
                                                <input type="text" class="form-control form-input" name="db_host" placeholder="Host"
                                                value="<?php echo isset($_SESSION["db_host"]) ? $_SESSION["db_host"] : 'localhost'; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Database Name</label>
                                                <input type="text" class="form-control form-input" name="db_name" placeholder="Database Name" value="<?php echo @$_SESSION["db_name"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Username</label>
                                                <input type="text" class="form-control form-input" name="db_user" placeholder="Username" value="<?php echo @$_SESSION["db_user"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Password</label>
                                                <input type="password" class="form-control form-input" name="db_password" placeholder="Password" value="<?php echo @$_SESSION["db_password"]; ?>">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <a href="index.php" class="btn btn-success btn-custom pull-left">Prev</a>
                                        <button type="submit" name="btn_admin" class="btn btn-success btn-custom pull-right">Finish</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>


    </div>


</div>

<?php

unset($_SESSION["error"]);
unset($_SESSION["success"]);

?>

</body>
</html>

