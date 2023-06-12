@extends('admin.layouts.main')
@section('content')
    <button id="tambahButtonKategori"
        class="px-4 py-2 rounded-md text-white shadow-md bg-slate-500 hover:bg-slate-600 active:bg-slate-500 transition duration-300">
        <span class="flex items-center gap-2">
            <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path
                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
            </svg>
            Tambah Kategori
        </span>
    </button>
    <div id="kategoriPanel" class="px-4 py-4 rounded-md bg-white shadow-md border border-gray-200"
        style="display: {{ $errors->has('name') ? 'block' : 'none' }}">
        <form class="space-y-4" action="/{{ Request::path() }}/create" method="POST">
            @csrf
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="nameForm">name</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="name" id="nameForm" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button
                class="capitalize px-4 py-2 rounded-md text-white shadow-md bg-green-500 hover:bg-green-600 active:bg-green-500 transition duration-300">
                submit
            </button>
        </form>
    </div>
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
                                    @if ($categories->count() < 1)
                                        <tr
                                            class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                            <td colspan="8"
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center">
                                                Tidak ada data di temukan
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($categories as $category)
                                        <tr
                                            class="article-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 w-2/3 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                {{ $category->name }}
                                            </td>
                                            <td class="px-6 py-4 w-1/3 whitespace-nowrap text-sm text-gray-500">
                                                {{ $category->slug }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                <div class="flex items-center gap-2">
                                                    <a href="/{{ Request::path() . '/delete/' . $category->id }}"
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
