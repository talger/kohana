<?php

if (!defined('SYSPATH')) {
  define('SYSPATH', true);
}

if (!defined('APPPATH')) {
  define('APPPATH', true);
}

if (!defined('EXT')) {
  define('EXT', 'php');
}


class_alias('arr_Core', 'arr');
class_alias('cookie_Core', 'cookie');
class_alias('date_Core', 'date');
class_alias('download_Core', 'download');

class_alias('format_Core', 'format');
class_alias('inflector_Core', 'inflector');
class_alias('num_Core', 'num');
class_alias('request_Core', 'request');
class_alias('url_Core', 'url');
class_alias('security_Core', 'security');
class_alias('valid_Core', 'valid');
