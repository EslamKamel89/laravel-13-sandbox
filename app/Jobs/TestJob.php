<?php

namespace App\Jobs;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Attributes\Backoff;
use Illuminate\Queue\Attributes\Timeout;
use Illuminate\Queue\Attributes\Tries;

#[Tries(3)]
#[Timeout(10)]
#[Backoff(5, 10, 20)]
class TestJob implements ShouldQueue {
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct() {
        //
    }

    public function handle(): void {
        info('TestJob executes');
        throw new Exception('Job Failed!!');
    }
}
