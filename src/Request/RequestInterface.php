<?php

namespace TimoPaul\DreamRobot\Request;

/**
 * API Request Interface
 *
 * @author   Timo Paul <mail@timopaul.biz>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://github.com/mjaschen/collmex
 */
interface RequestInterface
{
    /**
     * @return  string
     */
    public function getMethod() : string;
    
    /**
     * @return  string
     */
    public function getPath() : string;
    
    /**
     * @return  string
     */
    public function getHeader() : array;
    
    /**
     * @param   array $header
     * @return  void
     */
    public function setHeader(array $header) : void;
    
    /**
     * @param   string $header
     * @return  void
     */
    public function addHeader(string $header) : void;
    
    /**
     * @return  string
     */
    public function getDatas() : array;
    
    /**
     * @param   string $key
     * @param   string $value
     * @return  void
     */
    public function setDatas(array $datas) : void;
    
    /**
     * @param   string $key
     * @param   mixed $value
     * @return  void
     */
    public function addData(string $key, $value) : void;
    
    /**
     * @return  string
     */
    public function getOptions() : array;
    
    /**
     * @param   string $key
     * @param   string $value
     * @return  void
     */
    public function setOption(string $key, string $value) : void;
    
    
}
