<?php

namespace TimoPaul\DreamRobot\Request;

/**
 * Abstract Request Class
 *
 * @author   Timo Paul <mail@timopaul.biz>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://github.com/mjaschen/collmex
 */
abstract class AbstractRequest
{
    const API_PATH = '';
    
    const METHOD = 'POST';
  
    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    private $header = [
        'Content-Type: application/json encoding=utf-8',
        'Accept: application/json',
        'Accept-Charset: utf-8',
    ];
    
    /**
     * @var array
     */
    private $data = [];
    
    /**
     * @var array
     */
    private $options = [];


    /**
     * @param array $parameter
     */
    public function __construct(array $parameter = [])
    {
        $path = static::API_PATH;
        foreach ($parameter as $k => $v) {
            $path = str_replace('{' . $k . '}', $v, $path);
        }
        $this->path = $path;
    }
    
    /**
     * @return  string
     */
    public function getMethod() : string
    {
      return static::METHOD;
    }
    
    /**
     * @return  string
     */
    public function getPath() : string
    {
        return $this->path;
    }
    
    /**
     * @return  string
     */
    public function getHeader() : array
    {
        return $this->header;
    }
    
    /**
     * @param   array $header
     * @return  void
     */
    public function setHeader(array $header) : void
    {
        $this->header = $header;
    }
    
    /**
     * @param   string $header
     * @return  void
     */
    public function addHeader(string $header) : void
    {
        $this->header[] = $header;
    }
    
    /**
     * @return  string
     */
    public function getDatas() : array
    {
        return $this->data;
    }
    
    /**
     * @param   string $key
     * @param   string $value
     * @return  void
     */
    public function setData(string $key, string $value) : void
    {
        $this->data[$key] = $value;
    }
    
    /**
     * @return  string
     */
    public function getOptions() : array
    {
      return $this->options;
    }
    
    /**
     * 
     * @param   string $key
     * @param   string $value
     * @return  void
     */
    public function setOption(string $key, string $value) : void
    {
        $this->options[$key] = $value;
    }

    
}
