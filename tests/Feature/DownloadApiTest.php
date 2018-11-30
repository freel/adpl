<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DownloadApiTest extends TestCase
{
  protected $url = 'https://news.nationalgeographic.com/content/dam/news/2018/05/17/you-can-train-your-cat/02-cat-training-NationalGeographic_1484324.ngsversion.1526587209178.adapt.1900.1.jpg';

  /**
  * Test url parameter request
  *
  * @return void
  */
  public function testUrlRequest()
  {
    $this->json('POST', '/api')
      ->assertStatus(400)
      ->assertJson([
        'data' => [
          'url' => ["The url format is invalid."],
        ]
      ]);
  }

  /**
  * Test url parameter validation
  *
  * @return void
  */
  public function testUrlValidation()
  {
    $this->json('POST', '/api', ['url' => 'none'])
      ->assertStatus(400)
      ->assertJson([
        'data' => [
          'url' => ["The url format is invalid."],
        ]
      ]);
  }

  /**
  * Test dispatching DownloadingJob
  *
  * @return void
  */
  public function testDownloadsUrl()
  {
    $this->json('POST', '/api', ['url' => $this->url])
      ->assertStatus(201)
      ->assertJson([
        "data" => true,
      ]);
  }

  /**
  * Test list of DownloadingJob
  *
  * @return void
  */
  public function testDownloadsList()
  {
    $this->json('GET', '/api')
      ->assertStatus(200)
      ->assertJson([
        "data" => true,
      ]);
  }
}
