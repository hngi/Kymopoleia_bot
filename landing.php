<?php
/**
 * A lightweight example script for demonstrating how to
 * work with the Slack API.
 */
  
// Include our Slack interface classes
require_once 'slack-interface/class-slack.php';
require_once 'slack-interface/class-slack-access.php';
require_once 'slack-interface/class-slack-api-exception.php';
 
use Slack_Interface\Slack;
use Slack_Interface\Slack_API_Exception;

// Define Slack application identifiers
// Even better is to put these in environment variables so you don't risk exposing
// them to the outer world (e.g. by committing to version control)
define( 'SLACK_CLIENT_ID', '774475015110.774931713412' );
define( 'SLACK_CLIENT_SECRET', 'd5320591afa67c006636261d0afe74ca' );

//
// HELPER FUNCTIONS
//
 
/**
 * Initializes the Slack handler object, loading the authentication
 * information from a text file. If the text file is not present,
 * the Slack handler is initialized in a non-authenticated state.
 *
 * @return Slack    The Slack interface object
 */
function initialize_slack_interface() {
    // Read the access data from a text file
    if ( file_exists( 'access.txt' ) ) {
        $access_string = file_get_contents( 'access.txt' );
    } else {
        $access_string = '{}';
    }
 
    // Decode the access data into a parameter array
    $access_data = json_decode( $access_string, true );
 
    $slack = new Slack( $access_data );
     
    return $slack;
}
 
/**
 * Executes an application action (e.g. 'send_notification').
 * 
 * @param Slack  $slack     The Slack interface object
 * @param string $action    The id of the action to execute
 *
 * @return string   A result message to show to the user
 */
function do_action( $slack, $action ) {
    $result_message = '';
 
    switch ( $action ) {
        default:
            break;
    }
 
    return $result_message;
}
 
//
// MAIN FUNCTIONALITY
//
 
// Setup the Slack interface
$slack = initialize_slack_interface();
 
// If an action was passed, execute it before rendering the page
$result_message = '';
if ( isset( $_REQUEST['action'] ) ) {
    $action = $_REQUEST['action'];
    $result_message = do_action( $slack, $action );
}
 
//
// PAGE LAYOUT
//
?>
 
<!-- <html>
    <head>
        <title>Slack Integration Example</title>
         
        <style>
            body {
                font-family: Helvetica, sans-serif;
                padding: 20px;
            }
             
            .notification {
                padding: 20px;
                background-color: #fafad2;
            }
 
            input {
                padding: 10px;
                font-size: 1.2em;
                width: 100%;
            }
        </style>
    </head>
     
    <body>
        <h1>Slack Integration Example</h1>
 
        
 
        <form action="" method="post">
            <input type="hidden" name="action" value="send_notification"/>
            <p>
                <input type="text" name="text" placeholder="Type your notification here and press enter to send." />
            </p>
        </form>
    </body>
</html> -->

<!-- <?php if ( $slack->is_authenticated() ) : ?>
    <form action="" method="post">
        <input type="hidden" name="action" value="send_notification"/>
        <p>
            <input type="text" name="text" placeholder="Type your notification here and press enter to send." />
        </p>
    </form>
<?php else : ?>
    <p>
        <a href="https://slack.com/oauth/authorize?scope=incoming-webhook,commands&client_id=<?php echo $slack->get_client_id(); ?>"><img alt="Add to Slack" height="40" width="139" src="https://platform.slack-edge.com/img/add_to_slack.png" srcset="https://platform.slack-edge.com/img/add_to_slack.png 1x, https://platform.slack-edge.com/img/add_to_slack@2x.png 2x"></a>
    </p>
<?php endif; ?> -->


<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>KymopoleiaBot</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='landingpage.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>

<body>
    <header class="header">
        <section class="navigation">
            <div class="logo"> <i class="fa fa-robot" style="color: white"></i> <span class="logocolor">Kymopoleia</span>Bot</div>
            <ul>
                <!-- <li><a href="#">Home</a></li> -->
                <!-- <li><a href="#">Features</a></li> -->
                <!-- <li><a href="signup.php"><span class="loginbutton">Sign Up</span> </a></li> -->
                <li><a href="logout.php"><span class="loginbutton">Logout</span></a></li>
            </ul>
        </section>

        <section class="introduction">
            <h2>Do Extra With <span class="introspan">KYMOPOLEIA BOT </span> ... In Slack!</h2>
            <p class="introp">Join thousands of teams that use KymopoleiaBot to automate storage of Conversations on Slack workspace to an external drive</p>
            <br>
            <?php if ( $slack->is_authenticated() ) : ?>
                <form action="" method="post">
                    <input type="hidden" name="action" value="send_notification"/>
                    <p>
                        <input type="text" name="text" placeholder="Type your notification here and press enter to send." />
                    </p>
                </form>
            <?php else : ?>
                <p>
                    <a href="https://slack.com/oauth/authorize?scope=incoming-webhook,commands&client_id=<?php echo $slack->get_client_id(); ?>"><img alt="Add to Slack" height="40" width="139" src="https://platform.slack-edge.com/img/add_to_slack.png" srcset="https://platform.slack-edge.com/img/add_to_slack.png 1x, https://platform.slack-edge.com/img/add_to_slack@2x.png 2x"></a>
                </p>
            <?php endif; ?>
            <br>
            <a href="#"><button class="introbutton"> <i class="fa fa-slack" style="color: orangered; font-size: 30px; margin-right: 10px"></i> Add to Slack</button></a>
            <br>
            <br>
            <p class="introp2">Start your free trial today. No credit card required.</p>
        </section>
    </header>
</body>

</html>
