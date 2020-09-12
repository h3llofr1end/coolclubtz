<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;

class MessageController extends Controller
{
    /**
     * Save message to DB
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        if ($request->cookie('rate-limit') !== null && $request->cookie('rate-limit') == 0) {
            return response()->json(['error' => 'Вы превысили лимит на отправку сообщений. Попробуйте позднее'], 400);
        }

        $message = new Message();
        $message->message = $request->post('message');
        $message->save();

        if (!$request->cookie('rate-limit')) {
            $cookie = cookie('rate-limit', env('MESSAGES_LIMIT_PER_HOUR', 5) - 1);
        } else {
            $cookie = cookie('rate-limit', $request->cookie('rate-limit') - 1);
        }

        return response()->json(['success' => 'Сообщение успешно отправлено'], 201)->withCookie($cookie);
    }
}
