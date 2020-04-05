<?php

namespace App\Jobs;

use App\Models\Department;
use Illuminate\Bus\Queueable;
use App\Observers\DepartmentObserver;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncScodoc implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (Department::all() as $department) {
            (new DepartmentObserver)->updated($department);
        }
    }
}
