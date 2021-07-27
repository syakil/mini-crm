<?php

namespace App\Listeners\Companie;

use App\Events\Companies\CompaniesEmail;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\Companies\CompaniesEmail as Send;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail
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
     * @param  CompaniesEmail  $event
     * @return void
     */
    public function handle(CompaniesEmail $event)
    {
        Mail::to($event->companies->email)->send(new Send($event->companies));
    }
}
