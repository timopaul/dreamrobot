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
     * @param   array $datas
     * @return  void
     */
    public function setDatas(array $datas) : void
    {
        $this->data = $datas;
    }
    
    /**
     * @param   string $key
     * @param   mixed $value
     * @return  void
     */
    public function addData(string $key, $value) : void
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
    
    
    public function toUtf8($text) {
      if (is_array($text)) {
        foreach ($text as $k => $v) {
          $text[$k] = $this->toUtf8($v);
        }
        return $text;
      }
      $charset = mb_detect_encoding($text, mb_detect_order(), true);
      return iconv($charset, 'UTF-8', $text);
    }
    
    
    public function toJson(array $str) : string
    {
      return json_encode($str, JSON_PRESERVE_ZERO_FRACTION);
    }

    
}
