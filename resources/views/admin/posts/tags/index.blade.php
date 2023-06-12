@extends('admin.layouts.main')
@section('content')
    <div class="rounded-md shadow-md bg-white">
        <div class="max-w-full mx-auto">
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="py-2 inline-block min-w-full">
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-white border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-700 px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                            name
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                            slug
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                            action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tags->count() < 1)
                                        <tr
                                            class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                            <td colspan="8"
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center">
                                                Tidak ada data di temukan
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($tags as $tag)
                                        <tr
                                            class="article-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 w-2/3 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                {{ $tag->name }}
                                            </td>
                                            <td class="px-6 py-4 w-1/3 whitespace-nowrap text-sm text-gray-500">
                                                {{ $tag->slug }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                <div class="flex items-center gap-2">
                                                    <a href="/{{ Request::path() . '/delete/' . $tag->id }}"
                                                        class="px-4 py-1.5 rounded-md text-white shadow-md bg-red-500 hover:bg-red-600 active:bg-red-500 transition duration-300">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
