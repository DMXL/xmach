<?php
/**
 *
 *
 *   ______                        _____           __
 *  /_  __/__  ____ _____ ___     / ___/__  ______/ /___
 *   / / / _ \/ __ `/ __ `__ \    \__ \/ / / / __  / __ \
 *  / / /  __/ /_/ / / / / / /   ___/ / /_/ / /_/ / /_/ /
 * /_/  \___/\__,_/_/ /_/ /_/   /____/\__,_/\__,_/\____/
 *
 *
 *
 * Filename->WechatController.php
 * Project->xmach
 * Description->Controller for Wechat api.
 *
 * Created by DM on 2016/12/13 下午5:00.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
 */
namespace App\Http\Controllers;

use Log;

class WechatController extends Controller
{

    /**
     * Overtrue wechat实例
     *
     * @var \EasyWeChat\Foundation\Application
     */
    private $wechat;

    /**
     * WechatController实例化
     */
    public function __construct()
    {
        // 获取wechat singleton
        $this->wechat = app('wechat');
    }

    /**
     * 处理微信服务器验证
     */
    public function verify()
    {
        return $this->wechat->server->serve();
    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.');

        $wechatServer = $this->wechat->server;

        $wechatServer->setMessageHandler(function($message){
            // 注意，这里的 $message 不仅仅是用户发来的消息，也可能是事件
            // 当 $message->MsgType 为 event 时为事件
            if ($message->MsgType === 'event') {
                switch ($message->Event) {
                    case 'subscribe':
                        return self::respondSubscription($message->EventKey);
                        break;
                    default:
                        break;
                }
            } else if ($message->MsgType === 'text'){
                return self::respondText($message->Content);
            }

            return '';
        });

        Log::info('return response.');

        return $wechatServer->serve();
    }

    /**
     * 处理关注事件
     *
     * @param $qrscene
     * @return string
     */
    public static function respondSubscription($qrscene)
    {
        $welcomeText = "欢迎关注中核瑞能科技有限公司官方微信公众号！";

        if(isset($qrscene))
            return $welcomeText." KEY=".$qrscene;

        return $welcomeText;
    }

    /**
     * 处理文字消息
     *
     * @param $content
     * @return string
     */
    public static function respondText($content)
    {
        $response = '收到文本消息 '.$content;
        return $response;
    }
}