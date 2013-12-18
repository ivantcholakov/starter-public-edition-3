<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <div class="page-header">
                <h1>Application Starter 3 Public Edition</h1>
            </div>

            <p>
                Project repository: <a href="https://github.com/ivantcholakov/starter-public-edition-3/" target="_blank">https://github.com/ivantcholakov/starter-public-edition-3/</a>
            </p>

            <p>
                Note: This is an older version of the platform. Further efforts will be applied on Application Starter 4, which supports multiple applications.
                See <a href="https://github.com/ivantcholakov/starter-public-edition-4/" target="_blank">https://github.com/ivantcholakov/starter-public-edition-4/</a>
            </p>

            <h2>Self-Diagnostics</h2>

            <p><?php echo $diagnostics; ?></p>

            <h2>Captcha Test</h2>

            <p>

                <div>
                    <img id="captcha_image"
                        class="img-thumbnail"
                        src="<?php echo $this->captcha->src.'?nocache='.rand(100000000, 999999999); ?>"
                        style="cursor: pointer;"
                        title="Click on the image if you want to change the proposed text."
                    />
                </div>

                <div id="captcha_test"></div>

            </p>
