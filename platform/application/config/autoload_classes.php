<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Auto-load Classes in PHP5 Way - A Location Map
|  An Example:
|  $autoload['classes'] = array(
|      'PHPMailer' => APPPATH.'third_party/phpmailer/class.phpmailer.php',
|  );
| -------------------------------------------------------------------
*/

$autoload['classes'] = array(
    'PHPMailer' => APPPATH.'third_party/phpmailer/class.phpmailer.php',
    'Markdownify' => APPPATH.'third_party/markdownify/markdownify.php',
    'Markdownify_Extra' => APPPATH.'third_party/markdownify/markdownify_extra.php',
    'Markdown_Parser' => APPPATH.'third_party/markdown/markdown.php',
    'MarkdownExtra_Parser' => APPPATH.'third_party/markdown/markdown.php',
    'Textile' => APPPATH.'libraries/Textile.php',
);
