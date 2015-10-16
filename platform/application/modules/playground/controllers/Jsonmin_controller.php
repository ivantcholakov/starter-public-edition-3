<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Jsonmin_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->parser()
        ;

        $this->template
            ->title('JSON Minification Test')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $input = null;
        $output = null;

        $clear_form = (bool) $this->input->post('test_form_clear');
        $is_example = (bool) $this->input->post('test_form_example');

        if ($clear_form) {

            // Do nothing, all has been already initialized.

        } elseif ($is_example) {

            $input = @ file_get_contents($this->load->path('test.json'));

            try {
                $output = $this->parser->parse_string($input, null, true, 'jsonmin');
            } catch(Exception $e) {
                $output = $e->getMessage();
            }

        } else {

            $validation_rules = array(
                array(
                    'field' => 'input',
                    'label' => 'Input JSON source',
                    'rules' => 'trim'
                ),
            );

            $this->form_validation->set_rules($validation_rules);

            if ($this->form_validation->run()) {

                $input = $this->input->post('input');

                try {
                    $output = $this->parser->parse_string($input, null, true, 'jsonmin');
                } catch (Exception $e) {
                    $output = $e->getMessage();
                }

            } elseif (validation_errors()) {

                $output = null;

                $this->template->set('error_message', '<ul>'.validation_errors('<li>', '</li>').'</ul>');
                $this->template->set('validation_errors', validation_errors_array());
            }
        }

        $this->template
            ->set('clear_form', $clear_form)
            ->set('is_example', $is_example)
            ->set('input', $input)
            ->set('output', $output)
            ->enable_parser_body('i18n')
            ->build('jsonmin');
    }

}
