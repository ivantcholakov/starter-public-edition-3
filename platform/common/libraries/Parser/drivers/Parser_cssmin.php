<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015 - 2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_cssmin extends CI_Parser_driver {

    protected $config;
    private $ci;

    public function initialize()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(
            'implementation' => 'yui_css_compressor',
            'raise_php_limits' => TRUE,
            'memory_limit' => '128M',
            'max_execution_time' => 60,
            'pcre_backtrack_limit' => 1000 * 1000,
            'pcre_recursion_limit' => 500 * 1000,
            'safe' => TRUE,
            'full_path' => FALSE,
        );

        if ($this->ci->config->load('parser_cssmin', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_cssmin'));
        }

        // Injecting configuration options directly.

        if (isset($this->_parent) && !empty($this->_parent->params) && is_array($this->_parent->params))
        {
            $this->config = array_merge($this->config, $this->_parent->params);

            if (array_key_exists('parser_driver', $this->config))
            {
                unset($this->config['parser_driver']);
            }
        }

        log_message('info', 'CI_Parser_cssmin Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        $ci = $this->ci;
        $is_mx = false;

        if (!$return || !$options['full_path'])
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        if (!$options['full_path'])
        {
            $template = $ci->load->path($template);
        }

        switch ($options['implementation'])
        {
            case 'cssnano':
                $parser = new Cssnano_Parser($options);
                $template = $parser->parse($template);
                break;

            case 'minifycss':
                $parser = new MatthiasMullie\Minify\CSS($template);
                $template = $parser->minify();
                break;

            default:

                // For security reasons don't parse PHP content.
                $template = @ file_get_contents($template);

                $options['raise_php_limits'] = !empty($options['raise_php_limits']);

                $parser = new tubalmartin\CssMin\Minifier($options['raise_php_limits']);

                if ($options['raise_php_limits'])
                {
                    if ($options['memory_limit'] != '')
                    {
                        $parser->setMemoryLimit($options['memory_limit']);
                    }

                    if ($options['max_execution_time'] != '')
                    {
                        $parser->setMaxExecutionTime($options['max_execution_time']);
                    }

                    if ($options['pcre_backtrack_limit'] != '')
                    {
                        $parser->setPcreBacktrackLimit($options['pcre_backtrack_limit']);
                    }

                    if ($options['pcre_recursion_limit'] != '')
                    {
                        $parser->setPcreRecursionLimit($options['pcre_recursion_limit']);
                    }
                }

                $template = $parser->run($template);

                break;
        }

        return $this->output($template, $return, $ci, $is_mx);
    }

    public function parse_string($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        switch ($options['implementation'])
        {
            case 'cssnano':
                $parser = new Cssnano_Parser($options);
                $template = $parser->parseString($template);
                break;

            case 'minifycss':
                $parser = new MatthiasMullie\Minify\CSS($template);
                $template = $parser->minify();
                break;

            default:

                $options['raise_php_limits'] = !empty($options['raise_php_limits']);

                $parser = new tubalmartin\CssMin\Minifier($options['raise_php_limits']);

                if ($options['raise_php_limits'])
                {
                    if ($options['memory_limit'] != '')
                    {
                        $parser->setMemoryLimit($options['memory_limit']);
                    }

                    if ($options['max_execution_time'] != '')
                    {
                        $parser->setMaxExecutionTime($options['max_execution_time']);
                    }

                    if ($options['pcre_backtrack_limit'] != '')
                    {
                        $parser->setPcreBacktrackLimit($options['pcre_backtrack_limit']);
                    }

                    if ($options['pcre_recursion_limit'] != '')
                    {
                        $parser->setPcreRecursionLimit($options['pcre_recursion_limit']);
                    }
                }

                $template = $parser->run($template);

                break;
        }

        return $this->output($template, $return, $ci, $is_mx);
    }

}
