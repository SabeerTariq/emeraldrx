<?php

namespace App\Listeners;

use Mail;
use App\Events\JobPosted;
use App\Mail\JobPostedMailable;
use App\Mail\JobPostedMailableFront;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobPostedListener implements ShouldQueue
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
     * @param  JobPosted  $event
     * @return void
     */
    public function handle(JobPosted $event)
    {
        try {
            Mail::send(new JobPostedMailableFront($event->job));
        } catch (\Exception $e) {
            // Log email error but don't fail the job posting
            \Log::error('Failed to send job posted email (front): ' . $e->getMessage());
        }
        
        try {
            Mail::send(new JobPostedMailable($event->job));
        } catch (\Exception $e) {
            // Log email error but don't fail the job posting
            \Log::error('Failed to send job posted email (admin): ' . $e->getMessage());
        }
    }

    /**
     * Handle a job failure.
     *
     * @param  JobPosted  $event
     * @param  \Exception  $exception
     * @return void
     */
    public function failed(JobPosted $event, $exception)
    {
        // Log the failure but don't throw - job was already saved
        \Log::error('JobPostedListener failed: ' . $exception->getMessage());
    }

}
