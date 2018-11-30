<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\JobHistory;

class DownloadListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List of download Jobs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * List all Jobs from JobHistory as table
     *
     * @return mixed
     */
    public function handle()
    {
      $jobs = JobHistory::get()->toArray();
      $headers = JobHistory::headers();
      $this->table($headers, $jobs);
    }
}
