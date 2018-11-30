<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Storage;
use App\Download;
use App\JobHistory;

class DownloadJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $url;
  protected $history;
  protected $filename;

  /**
   * Create a new job instance.
   *
   * @var url validated resource url
   * @var history JobHistory instance
   *
   * @return void
   */
  public function __construct($url, JobHistory $history)
  {
    $this->url = $url;

    $this->history = $history;

    $this->filename = substr($this->url, strrpos($this->url, '/') + 1);

    // generate pending status
    $this->saveJobHistory("pending");
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    // generate downloading status
    $this->saveJobHistory("downloading");

    // save file
    $contents = file_get_contents($this->url);
    Storage::put("public/" . $this->filename, $contents);

    // generate complete status
    $this->saveJobHistory("complete");
  }

  /**
   * The job failed to process.
   *
   * @param  Exception  $exception
   * @return void
   */
  public function failed($exception)
  {
    // generate complete status
    $this->saveJobHistory("error");
  }

  /**
   * Save data to JobHistory
   *
   * @param  status job status
   * @return void
   */
  private function saveJobHistory($status)
  {
    switch ($status) {
      case 'pending':
        $this->history->url      = $this->url;
        $this->history->filename = substr($this->url, strrpos($this->url, '/') + 1);
        break;
      case 'complete':
        $this->history->link     = Storage::url($this->filename);
        break;
    }
    $this->history->status = $status;
    $this->history->save();
  }


}
