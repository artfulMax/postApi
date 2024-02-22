<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSubmissionInfo
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param  SubmissionSaved  $event
     */
    public function handle(SubmissionSaved $event): void
    {
        $data = $event->data;
        Log::info("Submission Saved Successfully with name:".$data['name']." email:" . $data['email']);
    }
}
