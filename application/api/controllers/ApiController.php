<?php

namespace Shaarli\Api\Controllers;

use \Slim\Container;

/**
 * Abstract Class ApiController
 *
 * Defines REST API Controller dependencies injected from the container.
 *
 * @package Api\Controllers
 */
abstract class ApiController
{
    /**
     * @var Container
     */
    protected $ci;

    /**
     * @var \ConfigManager
     */
    protected $conf;

    /**
     * @var \LinkDB
     */
    protected $linkDb;

    /**
     * @var int|null JSON style option.
     */
    protected $jsonStyle;

    /**
     * ApiController constructor.
     * 
     * Note: enabling debug mode displays JSON with readable formatting.
     *
     * @param Container $ci Slim container.
     */
    public function __construct(Container $ci)
    {
        $this->ci = $ci;
        $this->conf = $ci->get('conf');
        $this->linkDb = $ci->get('db');
        if ($this->conf->get('dev.debug', false)) {
            $this->jsonStyle = JSON_PRETTY_PRINT;
        } else {
            $this->jsonStyle = null;
        }
    }
}
