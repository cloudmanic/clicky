## Overview

A PHP composer based package for speaking to http://getclicky.com

## Requirements

1. PHP 5.3+
2. Composer

## How To Use

Here is a list of functions you can call with this library.

```php
// Site Id & Admin Site Key
Cloudmanic\Clicky\Track::init($site_id, $site_admin_key);

// Track a page view.
Cloudmanic\Clicky\Track::set_ip('98.137.149.56');
Cloudmanic\Clicky\Track::set_refer('http://cloudmanic.com');
Cloudmanic\Clicky\Track::set_user_agent('php-script');
Cloudmanic\Clicky\Track::set_href('http://localhost/blah.php');
Cloudmanic\Clicky\Track::set_title('LH : Blah : Signup');
Cloudmanic\Clicky\Track::log_action('pageview');

// Track a goal action.
Cloudmanic\Clicky\Track::set_goal(array('name' => 'My First Goal', 'revenue' => '5.00'));
Cloudmanic\Clicky\Track::log_action('goal');

// Track a download
Cloudmanic\Clicky\Track::set_ip('98.137.149.56');
Cloudmanic\Clicky\Track::set_user_agent('php-script');
Cloudmanic\Clicky\Track::set_href('/some/download.zip');
Cloudmanic\Clicky\Track::log_action('download');

// Track click
Cloudmanic\Clicky\Track::set_ip('98.137.149.56');
Cloudmanic\Clicky\Track::set_href('/blog');
Cloudmanic\Clicky\Track::log_action('click');

// Track outbound
Cloudmanic\Clicky\Track::set_ip('98.137.149.56');
Cloudmanic\Clicky\Track::set_href('http://yahoo.com');
Cloudmanic\Clicky\Track::log_action('outbound');

// Track custom
Cloudmanic\Clicky\Track::set_session('123');
Cloudmanic\Clicky\Track::set_custom(array('isloggedin' => 'Yes'));
Cloudmanic\Clicky\Track::log_action('custom');

echo Cloudmanic\Clicky\Track::get_last_request(); // Show the url request we just made.
// Site Id & Admin Site Key
Cloudmanic\Clicky\Track::init($site_id, $site_admin_key);

// Track a page view.
Cloudmanic\Clicky\Track::set_ip('98.137.149.56');
Cloudmanic\Clicky\Track::set_refer('http://cloudmanic.com');
Cloudmanic\Clicky\Track::set_user_agent('php-script');
Cloudmanic\Clicky\Track::set_href('http://localhost/blah.php');
Cloudmanic\Clicky\Track::set_title('LH : Blah : Signup');
Cloudmanic\Clicky\Track::log_action('pageview');

// Track a goal action.
Cloudmanic\Clicky\Track::set_goal(array('name' => 'My First Goal', 'revenue' => '5.00'));
Cloudmanic\Clicky\Track::log_action('goal');

// Track a download
Cloudmanic\Clicky\Track::set_ip('98.137.149.56');
Cloudmanic\Clicky\Track::set_user_agent('php-script');
Cloudmanic\Clicky\Track::set_href('/some/download.zip');
Cloudmanic\Clicky\Track::log_action('download');

// Track click
Cloudmanic\Clicky\Track::set_ip('98.137.149.56');
Cloudmanic\Clicky\Track::set_href('/blog');
Cloudmanic\Clicky\Track::log_action('click');

// Track outbound
Cloudmanic\Clicky\Track::set_ip('98.137.149.56');
Cloudmanic\Clicky\Track::set_href('http://yahoo.com');
Cloudmanic\Clicky\Track::log_action('outbound');

// Track custom
Cloudmanic\Clicky\Track::set_session('123');
Cloudmanic\Clicky\Track::set_custom(array('isloggedin' => 'Yes'));
Cloudmanic\Clicky\Track::log_action('custom');

echo Cloudmanic\Clicky\Track::get_last_request(); // Show the url request we just made.
```

## Author(s) 

* Company: Cloudmanic Labs, [http://cloudmanic.com](http://cloudmanic.com)

* By: Spicer Matthews [http://spicermatthews.com](http://spicermatthews.com)