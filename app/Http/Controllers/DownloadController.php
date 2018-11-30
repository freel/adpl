<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\DownloadJob;
use App\JobHistory;

class DownloadController extends Controller
{

  /**
   * Return a page with url adding form and JobHistory list
   *
   * @return view
   */
  public function index()
  {
    $jobs = JobHistory::get()->toArray();

    return view('download', [
      'jobs' => $jobs,
      'headers' => JobHistory::headers(),
    ]);
  }

  /**
   * Validate url and pending new Job
   *
   * @return view
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'url' => 'required|url',
    ]);

    DownloadJob::dispatch($request->url, new JobHistory);

    return redirect()->route('index');;
  }

}
