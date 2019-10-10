<?php

namespace TimoPaul\DreamRobot\Request;

use TimoPaul\DreamRobot\Request\PostRequest;

/**
 * curl AuthRequest Class
 *
 * @author   Timo Paul <mail@timopaul.biz>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://github.com/timopaul/dreamrobot
 */
class AuthRequest extends PostRequest
{
    const API_PATH = 'token.php';
    
    /**
     * @param array $parameter
     */
    public function __construct()
    {
        parent::__construct();
        $this->addData('grant_type', 'client_credentials');
    }
    
}