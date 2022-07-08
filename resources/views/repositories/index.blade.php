<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Repositories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="text-right mb-4"><a href="{{route('repositories.create')}}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md text-xs">Add new repo</a></p>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Url</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($repositories as $repository)
                        <tr>
                            <td class="border px-4 py-2">
                                {{$repository->id}}
                            </td>
                            <td class="border px-4 py-2">
                                {{$repository->url}}
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('repositories.show', $repository) }}">Check Repos</a>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('repositories.edit', $repository) }}">Edit</a>
                            </td>
                            <td class="border px-4 py-2">
                                <form action="{{route('repositories.destroy', $repository)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="px-4 rounded-md bg-red-500">
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                There are no repos created yet
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>