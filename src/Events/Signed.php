<?php

namespace Qihucms\SignIn\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Qihucms\SignIn\Models\SignIn;

class Signed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sign_in;

    /**
     * Create a new event instance.
     *
     * @param SignIn $sign_in
     * @return void
     */
    public function __construct(SignIn $sign_in)
    {
        $this->sign_in = $sign_in;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('sign.' . $this->sign_in->user_id);
    }
}
