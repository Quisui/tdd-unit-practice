<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Repository') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mx-auto">
                <div class="card text-left">
                    <div class="card-body">
                        <form action="{{route('repositories.store')}}" method="post" class="max-w-mg">
                            @csrf
                            <label class="block font-medium text-sm text-gray-700">URL *</label>
                            <input class="form-input w-full rounded-md shadow-sm" type="text" name="url">
                            <label class="block font-medium text-sm text-gray-700 mt-2">Description *</label>
                            <textarea class="form-input w-full rounded-md shadow-sm" type="text" name="description">
                            </textarea>
                            <hr class="my-4" />
                            <button type="submit" value="save" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>