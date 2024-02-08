<?php

namespace App\Events;

use GuzzleHttp\Client;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HelloEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $client;
    public $text;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($text)
    {
        // $this->client = new Client([
        //     'verify' => base_path('cacert.pem'),
        // ]);
        $this->text = $text;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return new Channel('hello-channel');
    }

    public function broadcastWith()
    {

        return [
            'data' => $this->text,
        ];
    }
}