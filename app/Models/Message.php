<?php

namespace App\Models;

use App\Events\SendMail;
use App\Mail\NewMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

/**
 * Class for table "messages"
 *
 * @property int $id
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 */
class Message extends Model
{
    protected static function boot()
    {
        parent::boot();

        self::created(function($model){
            event(new SendMail($model->message));
        });
    }
}
