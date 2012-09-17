<?php 
/*
 * Copyright (c) 2011, Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * All rights reserved.
 */


define('br', "<br />\n\r");
define('nl', "\r\n");
define('content', '<!-- conent:'. time() .' -->');
define('ip', $_SERVER['REMOTE_ADDR']);
define('is_post', ($_SERVER['REQUEST_METHOD'] == 'POST'));
define('is_ajax', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
define('site_url', 'http'. (isset($_SERVER['HTTPS']) ? 's' : '') .'://'. $_SERVER['SERVER_NAME'] . root_virtual);

define('minute', 60);
define('hour', 3600);
define('day', 86400);
define('month', 2592000);
define('year', 31536000);
