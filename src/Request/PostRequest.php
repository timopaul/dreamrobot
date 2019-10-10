<?php

namespace TimoPaul\DreamRobot\Request;

use TimoPaul\DreamRobot\Request\Request;

/**
 * curl PostRequest Class
 *
 * @author   Timo Paul <mail@timopaul.biz>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://github.com/timopaul/dreamrobot
 */
abstract class PostRequest extends Request
{
    private $body;
    
    /**
     * @param   array $data
     * @return  string
     */
    protected function buildRequestBody($data) : string
    {
        return $this->toJson($this->toUtf8($data));
    }
    
    /**
     * @return  string
     */
    public function getOptions() : array
    {
        $options = parent::getOptions();
        $this->body = $this->buildRequestBody($this->getDatas());
        $options[CURLOPT_POSTFIELDS] = $this->body;
        return $options;
    }
    
}
