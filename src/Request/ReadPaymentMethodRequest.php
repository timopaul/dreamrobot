<?php

namespace TimoPaul\DreamRobot\Request;

use TimoPaul\DreamRobot\Request\GetRequest;

/**
 * @author   Timo Paul <mail@timopaul.biz>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://github.com/timopaul/dreamrobot
 */
class ReadPaymentMethodRequest extends GetRequest
{
    const API_PATH = 'system/payment_method/';
}