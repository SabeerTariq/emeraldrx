<?php

namespace App\Listeners;

use Mail;
use App\Events\JobApplied;
use App\Mail\JobAppliedJobSeekerMailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobAppliedJobSeekerListener implements ShouldQueue
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
            Mail::send(new JobAppliedJobSeekerMailable($event->job, $event->jobApply));
        } catch (\Exception $e) {
            // Log email error but don't fail the job application
            \Log::error('Failed to send job applied email to job seeker: ' . $e->getMessage());
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
        \Log::error('JobAppliedJobSeekerListener failed: ' . $exception->getMessage());
    }

}
