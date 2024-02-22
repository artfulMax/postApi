<?php

namespace App\Jobs;

use App\Events\SubmissionSaved;
use App\Models\Submissions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;

    /**
     * ProcessSubmission constructor.
     * Create a new job instance.
     *
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }


    public function handle(): void
    {
        $data = [
            'name' =>  $this->request['name'],
            'email' =>  $this->request['email'],
            'message' =>  $this->request['message'],
        ];
        try {
            Submissions::create($data);

            SubmissionSaved::dispatch($data);
        } catch (\Exception $exception){
            Log::error('Submission failed with error:' . $exception->getMessage());
        }
    }
}
