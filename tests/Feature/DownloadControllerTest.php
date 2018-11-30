<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DownloadControllerTest extends TestCase
{
  protected $url = 'https://news.nationalgeographic.com/content/dam/news/2018/05/17/you-can-train-your-cat/02-cat-training-NationalGeographic_1484324.ngsversion.1526587209178.adapt.1900.1.jpg';

  /**
  * Test url redirect
  *
  * @return void
  */
  public function testUrlRedirect()
  {
    $this->post('/')
      ->assertStatus(302)
      ->assertRedirect('/');
  }

  /**
  * Test url parameter request
  *
  * @return void
  */
  public function testUrlRequest()
  {
    $this->followingRedirects()
      ->post('/')
      ->assertStatus(200)
      ->assertSee("The url field is required.");
  }

  /**
  * Test url parameter validation
  *
  * @return void
  */
  public function testUrlValidation()
  {
    $this->followingRedirects()
      ->post('/', ['url' => 'none'])
      ->assertStatus(200)
      ->assertSee("The url format is invalid.");
  }

  /**
  * Test dispatching DownloadingJob
  *
  * @return void
  */
  public function testDownloadsUrl()
  {
    $this->followingRedirects()
      ->post('/', ['url' => $this->url])
      ->assertStatus(200)
      ->assertSee("02-cat-training-NationalGeographic_1484324.ngsversion.1526587209178.adapt.1900.1.jpg");
  }

  /**
  * Test list of DownloadingJob
  *
  * @return void
  */
  public function testDownloadsList()
  {
    $this->get('/')
      ->assertStatus(200)
      ->assertSee("Download URL:")
      ->assertSeeInOrder(['id', 'filename', 'status', 'link']);
  }
}
