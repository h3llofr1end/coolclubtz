<?php

namespace Tests\Unit;

use App\Events\SendMail;
use App\Models\Message;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class MessageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAfterModelICanGetEvent()
    {
        Event::fake([
            SendMail::class
        ]);

        $model = new Message();
        $model->message = 'Test';
        $model->save();

        Event::assertDispatched(function (SendMail $event) use ($model) {
           return $event->message === $model->message;
        });
    }
}
