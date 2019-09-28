<?php
namespace Slack_Interface;
 
/**
 * A basic Slack interface you can use as a starting point
 * for your own Slack projects.
 */
class Slack {
 
    private static $api_root = 'https://slack.com/api/';
 
    public function __construct() {
         
    }
/**
 * Returns the Slack client ID.
 * 
 * @return string   The client ID or empty string if not configured 
 */
	public function get_client_id() {
	    // First, check if client ID is defined in a constant
	    if ( defined( 'SLACK_CLIENT_ID' ) ) {
	        return SLACK_CLIENT_ID;
	    }
	 
	    // If no constant found, look for environment variable
	    if ( getenv( 'SLACK_CLIENT_ID' ) ) {
	        return getenv( 'SLACK_CLIENT_ID' );
	    }
	         
	    // Not configured, return empty string
	    return '';
	}
	 
	/**
	 * Returns the Slack client secret.
	 * 
	 * @return string   The client secret or empty string if not configured
	 */
	private function get_client_secret() {
	    // First, check if client secret is defined in a constant
	    if ( defined( 'SLACK_CLIENT_SECRET' ) ) {
	        return SLACK_CLIENT_SECRET;
	    }
	 
	    // If no constant found, look for environment variable
	    if ( getenv( 'SLACK_CLIENT_SECRET' ) ) {
	        return getenv( 'SLACK_CLIENT_SECRET' );
	    }
	 
	    // Not configured, return empty string
	    return '';
	} 

	/**
	 * @var Slack_Access    Slack authorization data
	 */
	private $access;
	 
	/**
	 * Sets up the Slack interface object.
	 *
	 * @param array $access_data An associative array containing OAuth
	 *                           authentication information. If the user
	 *                           is not yet authenticated, pass an empty array.
	 */
	public function __construct( $access_data ) {
	    if ( $access_data ) {
	        $this->access = new Slack_Access( $access_data );
	    }
	}

	/**
	 * Checks if the Slack interface was initialized with authorization data.
	 *
	 * @return bool True if authentication data is present. Otherwise false.
	 */
	public function is_authenticated() {
	    return isset( $this->access ) && $this->access->is_configured();
	}

}