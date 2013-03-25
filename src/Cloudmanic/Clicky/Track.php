<?php 

namespace Cloudmanic\Clicky;

//
// By: Spicer Matthews
// Company: Cloudmanic Labs, LLC (http://cloudmanic.com)
// Modified From: 
//

class Track
{
	private static $_site_id;
	private static $_sitekey_admin;
	private static $_actions = array('pageview', 'download', 'outbound', 'click', 'custom', 'goal');
	private static $_api_url = 'http://in.getclicky.com/in.php';
	private static $_auth_params = '';
	private static $_request_params = '';
	private static $_last_request = '';
	
	//
	// Set clicky configs.
	//
	public static function init($site_id, $sitekey_admin)
	{
		if(empty($site_id) || empty($sitekey_admin))
		{
			die('Clicky: Must have the site_id and sitekey_admin set in the clicky.php file.');
		}
	
		self::$_site_id = $site_id;
		self::$_sitekey_admin = $sitekey_admin;
		self::$_auth_params = '?site_id=' . self::$_site_id . '&sitekey_admin=' . self::$_sitekey_admin;
	}
	
	// ------------------- Setters --------------------- //

	//
	// Set custom data. We pass in an index'ed array.
	//
	public static function set_custom($data)
	{
		if(! is_array($data))
		{
			return false;
		}
		
		// Custom data, must come in as array of key=>values
		foreach($data AS $key => $row) 
		{
			self::$_request_params .= "&custom[" . urlencode($key) . "]=" . urlencode($row);
		}
	}

	//
	// Set a goal. Goals can come in as integer or array, for convenience.
	// $goal (int) - The id of the goal.
	// $goal (array) - array('id', 'name', 'revenue'). Pass in id or name not both.
	//
	public static function set_goal($goal)
	{
		if(is_numeric($goal)) 
		{
		  self::$_request_params .= "&goal[id]=$goal";
		  return true;
		} 
		  
		if(is_array($goal))
		{
			if(isset($goal['id']) && (! is_numeric($goal['id']))) 
			{
				return false;
			}
			
			foreach($goal AS $key => $row) 
			{
				self::$_request_params .= "&goal[" . urlencode($key) . "]=" . urlencode($row);
			}
		}
	}
	
	//
	// Set ip address.
	//
	public static function set_ip($ip = NULL)
	{
		// Default to server var if set.
		if(is_null($ip) && isset($_SERVER['REMOTE_ADDR'])) 
		{
		  $ip = $_SERVER['REMOTE_ADDR']; 
		}
		
		// Validate the ip address.
		if(! preg_match("#^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$#", $ip)) 
		{
			show_error('Clicky: Not a valid IP address.');
		}
		
		self::$_request_params .= "&ip_address=$ip";
	}

	//
	// Set session.
	//
	public static function set_session($session)
	{		
		// We need either a session_id or an ip_address...
		if(! is_numeric($session)) 
		{
			show_error('Clicky: Not a valid session id must be a numberic.');
		}
		
		self::$_request_params .= "&session_id=$session";
	}
	
	//
	// Set refer. We should only call this once per session.
	//
	public static function set_refer($ref)
	{
		self::$_request_params .= '&ref=' . urlencode($ref);
	}
	
	//
	// Set user agent. We should only call this once per session.
	//
	public static function set_user_agent($ua)
	{
		self::$_request_params .= '&ua=' . urlencode($ua);
	}

	//
	// Set href. 
	//
	public static function set_href($href)
	{
		self::$_request_params .=  "&href=" . urlencode($href);
	}
	
	//
	// Set page title. 
	//
	public static function set_title($title)
	{
		self::$_request_params .=  "&title=" . urlencode($title);
	}
	
	// ------------------- Get Data -------------------- //
		
	// 
	// Returns the full url request of the last request to clicky.
	//
	public static function get_last_request()
	{
		return self::$_last_request;
	}

	// ------------------- Request Functions ----------- //
	
	//
	// Based On: http://goo.gl/jxW5u
	// This function allows you to log visitor actions to Clicky from an internal script. 
	// For example, some sites use internal redirect scripts for external links; 
	// Clicky would not normally be able to track these, but with this script it is possible.
	//
	public static function log_action($type)
	{		
		// If we did not pass in the correct type we default to a "pageview".
		if(! in_array($type, self::$_actions))
		{
			return false;
		}
		
		self::$_last_request = self::$_api_url . self::$_auth_params . self::$_request_params . "&type=" . $type;
		
		return file_get_contents(self::$_last_request) ? true : false;
	}
	
	// 
	// Clear all request vars.
	//
	public static function clear()
	{
		self::$_request_params = '';
	}
}

/* End File */