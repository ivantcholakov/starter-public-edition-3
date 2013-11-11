<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="container">

    <div id="body">

        <h1 class="my_section">Application Starter 3 Public Edition by Ivan Tcholakov, 2013</h1>

        <p>
            Project repository: <a href="https://github.com/ivantcholakov/starter-public-edition-3/" target="_blank">https://github.com/ivantcholakov/starter-public-edition-3/</a>
        </p>

        <p>
            Note: This is an old version of the platform. Further efforts will be applied on Application Starter 4, which supports multiple applications.
        </p>

        <h2>Self-Diagnostics</h2>

        <p><?php echo $diagnostics; ?></p>

    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>

</div>
