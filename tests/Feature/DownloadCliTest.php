<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DownloadCliTest extends TestCase
{
  protected $url = 'https://news.nationalgeographic.com/content/dam/news/2018/05/17/you-can-train-your-cat/02-cat-training-NationalGeographic_1484324.ngsversion.1526587209178.adapt.1900.1.jpg';

  /**
  * Test list of DownloadingJob
  *
  * @return void
  */
  public function testDownloadsList()
  {
    $this->artisan('download:list')
      ->assertExitCode(0);
  }

  /**
  * Test url parameter validation
  *
  * @return void
  */
  public function testUrlValidation()
  {
    $this->artisan('download:url', ['url' => 'none'])
      ->expectsOutput('The url format is invalid.')
      ->assertExitCode(400);;
  }

  /**
  * Test dispatching DownloadingJob
  *
  * @return void
  */
  public function testDownloadsUrl()
  {
    $this->artisan('download:url', ['url' => $this->url])
      ->expectsOutput('Job queueud.')
      ->assertExitCode(0);;
  }
}
