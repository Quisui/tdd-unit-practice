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
                        <form action="{{route('repositories.update', $repository)}}" method="post" class="max-w-mg">
                            @csrf
                            @method('PUT')
                            <label class="block font-medium text-sm text-gray-700">URL *</label>
                            <input class="form-input w-full rounded-md shadow-sm" type="text" name="url" value="{{$repository->url}}">
                            <label class="block font-medium text-sm text-gray-700 mt-2">Description *</label>
                            <textarea class="form-input w-full rounded-md shadow-sm" type="text" name="description">
                            {{$repository->description}}
                            </textarea>
                            <hr class="my-4" />
                            <button type="submit" value="edit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>