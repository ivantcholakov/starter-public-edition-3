A PHP Application Starter, Version 3, Based on CodeIgniter
==========================================================

Note
----

This is an older version of the platform. Further efforts will be applied on Application Starter 4, which supports multiple applications.
See https://github.com/ivantcholakov/starter-public-edition-4/

Requirements
------------

PHP 5.2.4+ (officially, actually the platform works on PHP 5.2.0), Apache 2.2 - 2.4.
For database support seek information within CodeIgniter 3.0-dev documentation.

For UTF-8 encoded sites it is highly recommendabe the following PHP extensions to be installed:

* **mbstring**;
* **iconv**;
* **pcre** compiled with UTF-8 support (the "u" modifier should work).

Installation
------------

Download source and place it on your web-server within its document root or within a sub-folder.
Make the folder platform/writable to be writable. It is to contain CodeIgniter's cache, logs and other things that you might add.
Open the site with a browser on an address like this: http://localhost/starter-public-edition-3/www/

On your web-server you may move one level up the content of the folder www, so the segment www from the address to disappear.
Also you can move the folder platform to a folder outside the document root of the web server for increased security.
After such a rearangement open the file config.php (www/config.php before rearrangement), find the setting $PLATFORMPATH and change this path accordingly.
Don't forget to check platform/writable folder, it should be writable.

Have a look at the files .htaccess and robots.txt and adjust them for your site.
The PHP configuration files of the application you may find at platform/application/config/ folder.

The platform auto-detects its base URL address nevertheless its public part is on the document root of the web-server or not.
I don't expect you to be forced to set it up manually within platform/application/config/config.php.

Features
--------

* CodeIgniter 3.0-dev, http://codeigniter.com/, https://github.com/EllisLab/CodeIgniter
* On a web-server you can place your site (www folder) within a subdirectory.
* Support for the old CI 2.x class/file name convention. When you port your older libraries, models, and controllers,
you would not be forced to rename them according to the new strict "ucfirst" naming convention.
* Native PHP session support by default.
* Modular Extensions - HMVC for CodeIgniter, https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
* Enhanced bootsrapping process, see the content of the folder platform/core/bootstrap/.
* In addition to the normal MVC execution, it is possible to run non-MVC scripts, look at the folder www/non-mvc/ for examples.
* Enhanced rooting has been implemented. Within a module you are able to place controllers in this way:
```
    modules/demo/controllers/page/Page.php     -> address: site_url/demo/page/[index/method]  
    modules/demo/controllers/page/Other.php    -> address: site_url/demo/page/other/[index/method]
```
* SEO Friendly URLs in CodeIgniter, http://www.einsteinseyes.com/blog/techno-babble/seo-friendly-urls-in-codeigniter-2-0-hmvc/
* Hack 2. Prevent Model-Controller Name Collision, http://net.tutsplus.com/tutorials/php/6-codeigniter-hacks-for-the-masters/

Instead of:

```php
// Filename: Welcome.php
class Welcome extends Base_Controller {
    // ...
}
```

you can write:

```php
// Filename: Welcome_controller.php
class Welcome_controller extends Base_Controller {
    // ...
}
```

Thus the class name Welcome is available to be used as a model name instead of those ugly names Welcome_model, Welcome_m, etc.
The technique of this hack is available, but it is not mandatory.

* Hack 4. Running CodeIgniter from the Command Line, http://net.tutsplus.com/tutorials/php/6-codeigniter-hacks-for-the-masters/ - see the file www/cli.php.
* Form Validation Callbacks in HMVC in Codeigniter, http://www.mahbubblog.com/php/form-validation-callbacks-in-hmvc-in-codeigniter/
* Making CodeIgniter’s Profiler AJAX compatible, http://dragffy.com/blog/posts/making-codeigniters-profiler-ajax-compatible
* CodeIgniter Form Validation External Callbacks, https://gist.github.com/1503599, http://ellislab.com/forums/viewthread/205469/
* User Agent Helper Functions for CodeIgniter, https://github.com/ivantcholakov/codeigniter-user-agent-helper
* Template library for CodeIgniter by Phil Sturgeon, http://philsturgeon.co.uk/code/codeigniter-template
* CodeIgniter Asset Library by Phil Sturgeon.
* UTF-8 string support for CodeIgniter based on Kohana's implementation, https://github.com/ivantcholakov/codeigniter-utf8
* PHP fallback function http_build_url(), https://github.com/ivantcholakov/http_build_url
* MY_Model, https://github.com/ivantcholakov/codeigniter-base-model
* Some basic javascripts + normalize.css.
* cURL library for CodeIgniter, https://github.com/philsturgeon/codeigniter-curl
* A simple Event System for CodeIgniter, https://github.com/ericbarnes/CodeIgniter-Events
* Support for database stored settings (Settings library).
* Textile, A Humane Web Text Generator, http://textile.thresholdstate.com/
* Markdown Extra - A text-to-HTML conversion tool, http://michelf.com/projects/php-markdown/
* Markdownify - A HTML-to-text conversion tool, http://milianw.de/projects/markdownify/
* Mustache, Logic-less templates, https://github.com/bobthecow/mustache.php
* PHPMailer, http://phpmailer.worxware.com/, https://github.com/Synchro/PHPMailer
* A CodeIgniter compatible email-library powered by PHPMailer, https://github.com/ivantcholakov/codeigniter-phpmailer
* A PHP class for transliteration, https://github.com/ivantcholakov/transliterate
* AES (256, 192, 128) Symmetric Encryption, Compatible with OpenSSL, https://github.com/ivantcholakov/gibberish-aes-php
* HTML Purifier, http://htmlpurifier.org/
* MY_Lang, language translations: Support has been implemented for placeholders %s, %d, etc.
* Translation within views by using i18n tag, http://devzone.zend.com/1441/zend-framework-and-translation/

How to use this feature:

Enable the configuration option 'parse_i18n':
```php
$config['parse_i18n'] = TRUE;
```
Then in your views you can use the following syntax:
```php
<i18n>translate_this</i18n>
```
or with parameters
```php
<i18n replacement="John,McClane">dear</i18n>
```
where $lang['dear'] = 'Dear Mr. %s %s,';

Here is a way how to translate title, alt, placeholder and value attributes:

```php
<img src="..." i18n:title="click_me" />
```
or with parameters
```php
<img src="..." i18n:title="dear|John,McClane" />
```

You can override the global setting 'parse_i18n' within the controller by inserting the line:
```php
$this->parse_i18n = TRUE; // or FALSE
```

Parsing of <i18n> tags is done on the final output buffer only when
the MIME-type is 'text/html'.

* KCAPTCHA Version 2.0 - A Port for CodeIgniter, https://github.com/ivantcholakov/codeigniter-kcaptcha
* Method chaining on Loader class has been implemented, see https://github.com/EllisLab/CodeIgniter/issues/2165

Instead of:

```php
$this->load->library('settings');
$this->load->helper('url');
$this->load->library('template');
```

you can write:

```php
$this->load
    ->library('settings')
    ->helper('url')
    ->library('template')
;
```

* Parser class: Driver support has been implemented. A Mustache driver has been added.

Instead of:

```php
$this->load->library('parser');
```

write the following:

```php
$this->load->parser();
```

Quick tests:

```php
// The default parser.
$this->load->parser();
echo $this->parser->parse_string('Hello, {name}!', array('name' => 'John'), TRUE);

echo '<br />';

// Mustache parser.
$this->load->parser('mustache');
echo $this->mustache->parse_string('Hello, {{name}}!', array('name' => 'John'), TRUE);

echo '<br />';

// Parsing a Mustache type of view.
$email_content = $this->mustache->parse('email.mustache', array('name' => 'John'), TRUE);
echo $email_content;

echo '<br />';
```

* Parser class: A Textile driver has been added.

```php
$this->load->parser('textile');
echo $this->textile->parse_string('h1. Hello!', NULL, TRUE);
echo $this->textile->parse('hello.textile', NULL, TRUE);
```

* Parser class: A Markdown driver has been added.

```php
$this->load->parser('markdown');
echo $this->markdown->parse_string('# Hello!', NULL, TRUE);
echo $this->markdown->parse('hello.markdown', NULL, TRUE);
```

* Parser class: A Markdownify driver has been added.

```php
$this->load->parser('markdownify');
echo $this->markdownify->parse_string('<h1>Hello!</h1>', NULL, TRUE);
echo $this->markdownify->parse('hello.html', NULL, TRUE);
```

* CodeIgniter Checkbox Helper, https://gist.github.com/mikedfunk/4004986
* Less.php compiler, https://github.com/oyejorge/less.php
* Parser class: A LESS driver has been added.

```php
$this->load->parser('less');
echo $this->less->parse_string('@color: #4D926F; #header { color: @color; } h2 { color: @color; }', NULL, TRUE);
echo $this->less->parse(FCPATH.'assets/less/lib/bootstrap-3/bootstrap.less', NULL, TRUE);
```

* LESS-assets compiler has been added.

Have a look at platform/application/config/less_compile.php file. It contains a list of files (sources, destinations)
to be used for LESS to CSS compilation. You may edit this list according to your needs. Before compilation, make sure
that destination files (if exist) are writable and their containing folders are writable too.

LESS-compilation is to be done from command-line. Open a terminal at the folder platform/www/ and write the following
command:

```bash
php cli.php less compile
```

* A way for database classes/drivers modification: Files under platform/core/framework/database/ folder may be copied
into platform/applications/{application_name}/database.
The copied files can be modified/customized. See https://github.com/ivantcholakov/starter-public-edition-4/issues/5
* CodeIgniter Cache Helper, https://github.com/stevenbenner/codeigniter-cache-helper
* auto_link() helper accepts attributes, https://github.com/EllisLab/CodeIgniter/wiki/auto-link
* Menu Library, https://github.com/nihaopaul/Spark-Menu, https://github.com/Barnabas/Spark-Menu (the original spark-source)
* Function print_d() (enhanced debug print), https://github.com/vikerlane/print_d

Credits
-------

* Many thanks to Irida Design OOD (http://iridadesign.com) for sponsoring this project.

License Information
-------------------

For my original code:  
Author: Ivan Tcholakov ivantcholakov@gmail.com, 2012-2014.  
License: The MIT License (MIT), http://opensource.org/licenses/MIT

CodeIgniter:  
Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)  
License: Open Software License (OSL 3.0), http://opensource.org/licenses/OSL-3.0

CodeIgniter configuration file:  
Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)  
License: Academic Free License (AFL 3.0), http://opensource.org/licenses/AFL-3.0

Third parties:  
License information is to be found directly within code and/or within additional files at corresponding folders.
