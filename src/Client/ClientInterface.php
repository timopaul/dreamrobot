<?php

namespace TimoPaul\DreamRobot\Client;

use stdClass;

use TimoPaul\DreamRobot\Request\Request;

/**
 * API Client Interface
 *
 * @author   Timo Paul <mail@timopaul.biz>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://github.com/mjaschen/collmex
 */
interface ClientInterface
{
    /**
     * Executes the actual HTTP request and creates the Response object
     *
     * @param   Request $request
     * @return  stdClass The response body
     * @throws  Exception\RequestFailedException
     */
    public function request(Request $request) : stdClass;
}
