<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NotificationChannels\Telegram\TelegramUpdates;

class TelegramBotController extends Controller
{
    public function update()
    {
//        $updates = TelegramUpdates::create()
//            // (Optional). Get's the latest update. NOTE: All previous updates will be forgotten using this method.
//            // ->latest()
//
//            // (Optional). Limit to 2 updates (By default, updates starting with the earliest unconfirmed update are returned).
//            ->limit(10)
//
//            // (Optional). Add more params to the request.
//            ->options([
//                'timeout' => 0,
//            ])
//            ->get();
//
//        dd($updates);
    }
}
