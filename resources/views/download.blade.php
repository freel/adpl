<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
        {{-- input form --}}
        <div class="">
          <form class="" action="{{ route('store') }}" method="post">
            {{csrf_field()}}
            {{method_field('POST')}}
            <span>Download URL: </span>
            <input type="text" name="url" value="">
            <input type="submit" name="" value="Submit">
          </form>
        </div>
        {{-- Errors --}}
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        {{-- Job list --}}
        <table>
          <tr>
            @foreach ($headers as $value)
              <td>{{ $value }}</td>
            @endforeach
            <td>link</td>
          </tr>
          @foreach ($jobs as $job)
            <tr>
              @foreach ($headers as $value)
                <td>{{ $job[$value] }}</td>
              @endforeach
              <td>
                @if ($job["link"] != null)
                  <a href="{{ $job["link"] }}">{{ $job["filename"] }}</a>
                @endif
              </td>
            </tr>
          @endforeach
        </table>
    </body>
</html>
