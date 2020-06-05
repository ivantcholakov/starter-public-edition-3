<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_twig extends CI_Parser_driver {

    protected $config;
    protected $environment_options;
    private $ci;

    public function initialize()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->environment_options = array(
            'debug' => false,
            'charset' => 'UTF-8',
            'base_template_class' => 'Twig_Template',
            'strict_variables' => false,
            'autoescape' => 'html',
            'cache' => false,
            'auto_reload' => null,
            'optimizations' => -1,
        );

        $this->config = array(
            'debug' => false,
            'charset' => null,
            'cache' => false,
            'full_path' => false,
        );

        $this->config = array_merge($this->environment_options, $this->config);

        if ($this->ci->config->load('parser_twig', TRUE, TRUE))
        {
            $defaults = $this->ci->config->item('parser_twig');

            $this->config = array_merge($this->config, $defaults);
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

        log_message('info', 'CI_Parser_twig Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        if (!isset($options['charset']) || trim($options['charset']) == '')
        {
            $options['charset'] = $this->ci->config->item('charset');
        }

        $options['charset'] = strtoupper($options['charset']);

        if (is_object($data))
        {
            $data = get_object_vars($data);
        }

        if (!is_array($data))
        {
            if (empty($data))
            {
                $data = array();
            }
            else
            {
                $data = (array) $data;
            }
        }

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

        $parser = new Twig_Environment(new Parser_Twig_Loader_Filesystem($ci->load->locations('views')),
            array_only($options, array_keys($this->environment_options))
        );
        $this->_extend_parser($parser, $options);

        $template = $parser->render($template, $data);

        return $this->output($template, $return, $ci, $is_mx);
    }

    public function parse_string($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        if (!isset($options['charset']) || trim($options['charset']) == '')
        {
            $options['charset'] = $this->ci->config->item('charset');
        }

        $options['charset'] = strtoupper($options['charset']);

        if (is_object($data))
        {
            $data = get_object_vars($data);
        }

        if (!is_array($data))
        {
            if (empty($data))
            {
                $data = array();
            }
            else
            {
                $data = (array) $data;
            }
        }

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        // Don't use the cache on string parsing, otherwise
        // the cache would be overloaded with too much files
        // that should be cleaned periodically.
        $options['cache'] = false;

        $parser = new Twig_Environment(new Twig_Loader_Chain(array(new Parser_Twig_Loader_String, new Parser_Twig_Loader_Filesystem($ci->load->locations('views')))),
            array_only($options, array_keys($this->environment_options))
        );
        $this->_extend_parser($parser, $options);

        $template = $parser->render($template, $data);

        return $this->output($template, $return, $ci, $is_mx);
    }

    protected function _extend_parser(& $parser, & $options)
    {
        if (isset($options['timezone']) && $options['timezone'] != '')
        {
            $parser->getExtension('core')->setTimezone($options['timezone']);
        }

        if (!empty($options['helpers']) && is_array($options['helpers']))
        {
            foreach ($options['helpers'] as & $item)
            {
                $item = trim(@ (string) $item);

                if ($item != '')
                {
                    $this->ci->load->helper($item);
                }
            }

            unset($item);
        }

        if (!empty($options['extensions']) && is_array($options['extensions']))
        {
            foreach ($options['extensions'] as & $item)
            {
                if (!is_array($item))
                {
                    $item = array((string) $item);
                }

                switch (count($item))
                {
                    case 1:

                        $parser->addExtension(new $item[0]);
                        break;

                    default:

                        if ($item[1] !== false)
                        {
                            $parser->addExtension(new $item[0]);
                        }

                        break;
                }
            }

            unset($item);
        }

        if (!empty($options['functions']) && is_array($options['functions']))
        {
            foreach ($options['functions'] as & $item)
            {
                if (!is_array($item))
                {
                    $item = array((string) $item);
                }

                switch (count($item))
                {
                    case 1:

                        $parser->addFunction(new Twig_SimpleFunction($item[0], $item[0]));
                        break;

                    case 2:

                        $parser->addFunction(new Twig_SimpleFunction($item[0], $item[1]));
                        break;

                    case 3:

                        $parser->addFunction(new Twig_SimpleFunction($item[0], $item[1], $item[2]));
                        break;

                    default:

                        if ($item[3] !== false)
                        {
                            $parser->addFunction(new Twig_SimpleFunction($item[0], $item[1], $item[2]));
                        }

                        break;
                }
            }

            unset($item);
        }

        if (!empty($options['filters']) && is_array($options['filters']))
        {
            foreach ($options['filters'] as & $item)
            {
                if (!is_array($item))
                {
                    $item = array((string) $item);
                }

                switch (count($item))
                {
                    case 1:

                        $parser->addFilter(new Twig_SimpleFilter($item[0], $item[0]));
                        break;

                    case 2:

                        $parser->addFilter(new Twig_SimpleFilter($item[0], $item[1]));
                        break;

                    case 3:

                        $parser->addFilter(new Twig_SimpleFilter($item[0], $item[1], $item[2]));
                        break;

                    default:

                        if ($item[3] !== false)
                        {
                            $parser->addFilter(new Twig_SimpleFilter($item[0], $item[1], $item[2]));
                        }

                        break;
                }
            }

            unset($item);
        }

        if (!empty($options['tests']) && is_array($options['tests']))
        {
            foreach ($options['tests'] as & $item)
            {
                if (!is_array($item))
                {
                    $item = array((string) $item);
                }

                switch (count($item))
                {
                    case 1:

                        $parser->addTest(new Twig_SimpleTest($item[0], $item[0]));
                        break;

                    case 2:

                        $parser->addTest(new Twig_SimpleTest($item[0], $item[1]));
                        break;

                    case 3:

                        $parser->addTest(new Twig_SimpleTest($item[0], $item[1], $item[2]));
                        break;

                    default:

                        if ($item[3] !== false)
                        {
                            $parser->addTest(new Twig_SimpleTest($item[0], $item[1], $item[2]));
                        }

                        break;
                }
            }

            unset($item);
        }

        $parser->addExtension(new Twig_Extension_Sandbox(new Twig_Sandbox_SecurityPolicy(
            !empty($options['sandbox_tags']) && is_array($options['sandbox_tags']) ? $options['sandbox_tags'] : array(),
            !empty($options['sandbox_filters']) && is_array($options['sandbox_filters']) ? $options['sandbox_filters'] : array(),
            !empty($options['sandbox_methods']) && is_array($options['sandbox_methods']) ? $options['sandbox_methods'] : array(),
            !empty($options['sandbox_properties']) && is_array($options['sandbox_properties']) ? $options['sandbox_properties'] : array(),
            !empty($options['sandbox_functions']) && is_array($options['sandbox_functions']) ? $options['sandbox_functions'] : array()
        )));
    }

}
