<?php

namespace App\Listeners;

use Mail;
use App\Events\JobApplied;
use App\Mail\JobAppliedCompanyMailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobAppliedCompanyListener implements ShouldQueue
{
    use InteractsWithQueue;

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
     * @param  JobApplied  $event
     * @return void
     */
    public function handle(JobApplied $event)
    {
        try {
            Mail::send(new JobAppliedCompanyMailable($event->job, $event->jobApply));
        } catch (\Exception $e) {
            // Log email error but don't fail the job application
            \Log::error('Failed to send job applied email to company: ' . $e->getMessage());
        }
    }

    /**
     * Handle a job failure.
     *
     * @param  JobApplied  $event
     * @param  \Exception  $exception
     * @return void
     */
    public function failed(JobApplied $event, $exception)
    {
        // Log the failure but don't throw - application was already saved
        \Log::error('JobAppliedCompanyListener failed: ' . $exception->getMessage());
    }

}
