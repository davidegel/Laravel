<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\UserEvent;
use Pusher\Pusher;

class FireUserEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        if($event->TokenIdUser()) {
            /*
            $fatture = $event->getFatture();
            $f = $fatture::where('user_id', $event->getUser()->id)
            ->update(['nome_fattura' => 'fattura uno letta']);
            */
            $options = array(
                'cluster' => 'eu', 
                'encrypted' => true
            );
     
           //Remember to set your credentials below.
            $pusher = new Pusher(
                '0aa8ac4953f4fcd5e8cc',
                '8e20846b0ee0fd110323',
                '495949',
                $options
            );
            
            $message = "Hello User";
            
            //Send a message to notify channel with an event name of notify-event
            $pusher->trigger('notify', 'notify-event', $message); 
            return true;
        }else {

            return false;
        }
    }
}
