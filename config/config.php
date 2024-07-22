<?php

//Param for use Doctine ORM
define('USE_DOCTRINE', false);

//Database Connection
define('DB_HOST', 'localhost');
define('DB_NAME', 'provatesi');
define('DB_USER', 'root');
define('DB_PASS', 'pippo');

//Web APP parameter for custom app
define('MAX_VIP', 3);
define('MAX_POST_EXPLORE', 10);
define('MAX_WARNINGS', 3);
define('MAX_IMAGE_SIZE', 5242880); // 5MB
define('ALLOWED_IMAGE_TYPE',['image/jpeg', 'image/png', 'image/jpg']);

//session coockie expiration
define('COOKIE_EXP_TIME', 2592000); // 30 days in seconds