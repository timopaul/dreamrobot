<?php

namespace TimoPaul\DreamRobot\Request;

use TimoPaul\DreamRobot\Request\Request;

/**
 * curl GetRequest Class
 *
 * @author   Timo Paul <mail@timopaul.biz>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://github.com/timopaul/dreamrobot
 */
abstract class GetRequest extends Request
{
    const METHOD = 'GET';
    
    /**
     * @return  string
     */
    public function getPath() : string
    {
        $datas = $this->getDatas();
        if (0 < count($datas)) {
            $delimiter = strpos($this->path, '?') ? '&' : '?';
            $this->path .= $delimiter . $this->buildRequestParameter($datas);
        }
        return parent::getPath();
    }
    
    /**
     * @param   array $data
     * @return  string
     */
    protected function buildRequestParameter($data) : string
    {
        return http_build_query($data);
    }

    
}
