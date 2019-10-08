<?php

namespace TimoPaul\DreamRobot\Client;

use TimoPaul\DreamRobot\Request\Exception\FailedRequestException;

use stdClass;

/**
 * Abstract Client Class
 *
 * @author   Timo Paul <mail@timopaul.biz>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://github.com/mjaschen/collmex
 */
abstract class AbstractClient
{
    /**
     * The DreamRobot API endpoint URL template
     */
    const API_URL = 'https://api.dreamrobot.de/rest/%s/';

    /**
     * The DreamRobot API endpoint URL
     *
     * @var string
     */
    protected $apiUrl;

    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $user
     * @param string $password
     * @param string $customer
     */
    public function __construct(string $user, string $password)
    {
        $this->user        = $user;
        $this->password    = $password;
        $this->apiUrl = sprintf(static::API_URL, SHOPMODULE_DREAMROBOT_API_VERSION);
    }
    
    
    protected function getUserPwd() : string
    {
        return $this->user . ':' . $this->password;
    }
    
    
    protected function parseResponse(string $response) : stdClass
    {
        if ($response === false) {
            $error = curl_error($this->curl);
            $errno = curl_errno($this->curl);
            $msg = 'Curl request failed: ' . $error . ' (' . $errno . ' )';
            throw new FailedRequestException($msg);
        }
        
        $responseObject = json_decode($response);
        
        if ( ! is_object($responseObject) && is_array($responseObject)) {
          $responseObject = new stdClass;
        }
        
        if (property_exists($responseObject, 'error')
            && is_array($responseObject->error)
            && 0 < count($responseObject->error)
        ) {
          
            $callback = function($e) {
                return $e->code . ' ' . $e->error . ': ' . $e->description;
            };
            $errors = array_map($callback, $responseObject->error);
            $msg = 'Curl request failed:' . "\n\t" . implode("\n\t", $errors);
            throw new FailedRequestException($msg . "\n");
        }
        
        return $responseObject;
    }

}
