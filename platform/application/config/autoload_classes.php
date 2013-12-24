<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Auto-load Classes in PHP5 Way - A Location Map
|
|  An example:
|  $autoload['classes'] = array(
|      'Markdown_Parser' => APPPATH.'third_party/markdown/markdown.php',
|  );
| -------------------------------------------------------------------
*/

$autoload['classes'] = array(
    'Markdownify' => APPPATH.'third_party/markdownify/markdownify.php',
    'Markdownify_Extra' => APPPATH.'third_party/markdownify/markdownify_extra.php',
    'Markdown_Parser' => APPPATH.'third_party/markdown/markdown.php',
    'MarkdownExtra_Parser' => APPPATH.'third_party/markdown/markdown.php',
);
