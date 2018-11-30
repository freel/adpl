<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\DownloadJob;
use App\JobHistory;
use Validator;

class DownloadApiController extends Controller
{

  /**
   * Return JobHistory list
   *
   * @return json
   */
  public function index()
  {
    $jobs = JobHistory::get();

    return response()->json([
      'data' => $jobs->toArray()
    ], 200);
  }

  /**
   * Validate url and pending new Job
   *
   * @return json
   */
  public function store(Request $request)
  {
    $validator = Validator::make(['url' => $request->url], ['url' => 'url']);
    if($validator->fails()){
      return response()->json([
        'data' => $validator->errors()->toArray()
      ], 400);
    }

    DownloadJob::dispatch($request->url, new JobHistory);

    return response()->json([
      'data' => $request->url
    ], 201);
  }
}
