@extends('admin.layouts.main')
@section('content')
    <div class="max-w-full mx-auto mt-8">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-sm font-medium text-left text-gray-700">
                                        #
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Title
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Slug
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @if ($pages->count() < 1)
                                    <tr
                                        class="font-medium transition duration-300 ease-in-out bg-white border-b hover:bg-gray-100">
                                        <td colspan="4"
                                            class="px-6 py-4 text-sm text-center text-gray-400 whitespace-nowrap">
                                            Tidak ada data di temukan
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($pages as $page)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                            {{ ($pages->currentPage() - 1) * $pages->perPage() + $loop->iteration }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm font-medium title-hover text-slate-700 whitespace-nowrap dark:text-white">
                                            {{ $page->title }}
                                            <div class="flex items-center gap-2 font-light item-hover" style="opacity: 0">
                                                <a class="font-normal hover:text-blue-500"
                                                    href="/ngadmin/pages/view/{{ $page->slug }}">View</a>
                                                <span class="px-0.5 py-0.5 rounded-full bg-slate-600"></span>
                                                <a class="font-normal hover:text-blue-500"
                                                    href="/ngadmin/pages/change/{{ $page->slug }}">Edit</a>
                                                <span class="px-0.5 py-0.5 rounded-full bg-slate-600"></span>
                                                <a class="font-normal text-red-500 hover:text-red-700"
                                                    href="/ngadmin/pages/delete/{{ $page->id }}">Delete</a>
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm font-medium text-slate-700 whitespace-nowrap dark:text-white">
                                            {{ $page->slug }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-light whitespace-nowrap dark:text-white">
                                            @if ($page->published_at)
                                                <span class="px-2 py-1 text-white bg-blue-500 rounded-lg">Published</span>
                                            @else
                                                <span class="px-6 py-1 text-white bg-red-600 rounded-lg">Draft</span>
                                            @endif
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
    <div class="mt-10">
        @include('admin.layouts.partials.pagination', ['paginator' => $pages])
    </div>
@endsection
