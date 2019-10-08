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
    
    /**
     * @param   array $data
     * @return  string
     */
    protected function buildRequestBody($data) : string
    {
        return json_encode($data);
    }
    
    /**
     * @return  string
     */
    public function getOptions() : array
    {
        $options = parent::getOptions();
        $postData = $this->buildRequestBody($this->getDatas());
        $options[CURLOPT_POSTFIELDS] = $postData;
        return $options;
    }
    
}
