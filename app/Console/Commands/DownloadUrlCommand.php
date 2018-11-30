<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Validator;
use App\Jobs\DownloadJob;
use App\JobHistory;

class DownloadUrlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:url {url : resource URL}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download particular resource by specified url';

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
     * Add Job to Queue after validating url argument
     *
     * @return mixed
     */
    public function handle()
    {
      // Validate URL
      $validator = Validator::make(['url'=>$this->argument('url')],['url'=>'url']);
      if($validator->fails()){
        $this->error($validator->errors()->first());
        return 400;
      }

      // Add job to queue
      DownloadJob::dispatch($this->argument('url'), new JobHistory);

      $this->info("Job queueud.");
    }
}
