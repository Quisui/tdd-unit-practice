<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Repository') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mx-auto">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title">{{$repository->url}}</h4>
                        <p class="card-text">{{$repository->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>