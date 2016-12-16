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
 * Filename->TestController.php
 * Project->xmach
 * Description->Controller for test
 *
 * Created by DM on 2016/12/16 上午9:46.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
 */
namespace App\Http\Controllers;

use BaiduVoice;

class TestController extends Controller
{
    public function index()
    {
        dd(BaiduVoice::getToken());
        return '';
    }
}