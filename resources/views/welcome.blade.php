<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link ref="stylesheet" href="/css/app.css" type="text/css">
</head>

<body class="bg-gray-200">
    @forelse ($repositories as $repository)
    <div class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <img src="{{$repository->user->profile_photo_url}}" alt="" class="w-12 h-12 rounder-full mr-2">
        <div class="card-body mt-2">
            <h4 class="card-title">{{$repository->url}}</h4>
            <p class="card-text">{{$repository->description}}</p>
        </div>
        <div class="card-footer">
            {{$repository->created_at->diffForHumans()}}
        </div>
    </div>
    @empty
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">No repositories</h4>
        </div>
    </div>

    @endforelse
</body>

</html>