<?php

namespace TimoPaul\DreamRobot\Client;

use stdClass;

use TimoPaul\DreamRobot\Client\AbstractClient;
use TimoPaul\DreamRobot\Client\ClientInterface;
use TimoPaul\DreamRobot\Request\Request;
use TimoPaul\DreamRobot\Request\AuthRequest;
use TimoPaul\DreamRobot\Request\Exception\FailedRequestException;

/**
 * curl Client Class
 *
 * @author   Timo Paul <mail@timopaul.biz>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://github.com/timopaul/dreamrobot
 */
class Curl extends AbstractClient implements ClientInterface
{
    /**
     *
     * @var TimoPaul\DreamRobot\Client\Curl 
     */
    static private $instance;
  
    /**
     * @var resource
     */
    protected $curl;

    /**
     * @var TimoPaul\DreamRobot\Request\Request
     */
    protected $token;
    
    /**
     *
     * @var type 
     */
    protected $request;
    
    /**
     * @param string $user
     * @param string $password
     * @param string $customer
     */
    public function __construct(string $user, string $password)
    {
        parent::__construct();
        $this->auth($user, $password);
    }
    
    static public function getInstance(string $user, string $password) : self
    {
        if ( ! (static::$instance instanceof TimoPaul\DreamRobot\Client\Curl)) {
            static::$instance = new self($user, $password);
        }
        
        return static::$instance;
    }
    
    /**
     * get an valid oAuth Token
     *
     * @return void
     * @throws RequestFailedException
     */
    public function auth(string $user, string $password) : void
    {
        $request = new AuthRequest();
        $request->setoption(CURLOPT_USERPWD, $user . ':' . $password);
        
        $response = $this->send($request);
        
        if ( ! property_exists($response, 'access_token')) {
            $msg = 'Unable to get access token from request!';
            throw new FailedRequestException($msg);
        }
        
        $this->token = $response->access_token;
    }
    
    
    public function send(Request $request) : stdClass
    {
        $this->request = $request;
        
        $this->initCurl();
        
        $this->setPath($request->getPath());
        $this->setMethod($request->getMethod());
        $this->setHeader($request->getHeader());
        $this->setOptions($request->getOptions());
        
        $response = $this->parseResponse($this->executeCurl());
		$response->code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        
        $this->destroyCurl();
        
        return $response;
    }
    

    /**
     * Creates curl ressource.
     *
     * @return void
     */
    protected function initCurl()
    {
        $this->curl = curl_init();
        $this->setCurlOption(CURLOPT_SSL_VERIFYPEER, true);
        $this->setCurlOption(CURLOPT_RETURNTRANSFER, true);
    }
    
    
    protected function executeCurl() : string
    {
        return curl_exec($this->curl);
    }
    
    
    protected function setCurlOption($name, $value) : void
    {
        curl_setopt($this->curl, $name, $value);
    }
    
    
    protected function setPath($path) : void
    {
        $this->setCurlOption(CURLOPT_URL, $this->apiUrl . $path);
    }
    
    
    protected function setMethod($method = 'POST') : void
    {
        $this->setCurlOption(CURLOPT_CUSTOMREQUEST, strtoupper($method));
        if ('POST' == $method) {
           $this->setCurlOption(CURLOPT_POST, true);
        }
    }
    
    
    protected function setHeader($header = []) : void
    {
        $this->setCurlOption(CURLOPT_HTTPHEADER, $header);
    }
    
    
    protected function setOptions($options = []) : void
    {
        foreach ($options as $k => $v) {
            $this->setCurlOption($k, $v);
        }
    }
    
    /**
     * Closes curl ressource.
     *
     * @return void
     */
    protected function destroyCurl()
    {
        if ( ! empty($this->curl)) {
            curl_close($this->curl);
        }
    }
    
    
    protected function getToken() : string
    {
        return $this->token;
    }
    
    
    public function createRequest($class) : Request
    {
        $request = new $class();
        $request->addHeader('Authorization: Bearer ' . $this->getToken());
        return $request;
    }

}
