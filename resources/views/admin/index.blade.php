@extends('admin.layouts.main')
@section('content')
    @component('admin.layouts.partials.components.cards', [
        'items' => [
            [
                'name' => 'total article',
                'amount' => 1,
                'slot' => '<ion-icon class="text-white/75 text-7xl -rotate-12" name="document-text-outline"></ion-icon>',
            ],
            [
                'name' => 'views bulan ini',
                'amount' => 1,
                'slot' => '<ion-icon class="text-white/75 text-7xl -rotate-12" name="pie-chart-outline"></ion-icon>',
            ],
            [
                'name' => 'views hari ini',
                'amount' => 1,
                'slot' => '<ion-icon class="text-white/75 text-7xl -rotate-12" name="analytics-outline"></ion-icon>',
            ],
        ],
    ])
    @endcomponent
    <p class="text-lg font-medium">Statistic</p>
    <div class="px-4 py-4 bg-white border border-gray-200 rounded-md shadow-md">
        <div id="statisticChart"
            style="position: relative; height: 380px; width: 100%; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
        </div>
    </div>
    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-2">
            <p class="text-lg font-medium capitalize">popular article</p>
            <div class="px-4 py-4 mt-4 bg-white border rounded-md shadow-md">
                <div class="max-w-full mx-auto">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-4">
                            <div class="inline-block min-w-full pb-2 sm:px-4">
                                <div class="overflow-y-auto">
                                    <table class="min-w-full">
                                        <thead class="border-b">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-700 capitalize">
                                                    id</th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-700 capitalize">
                                                    title</th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-700 capitalize whitespace-nowrap">
                                                    views count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="font-medium align-top transition duration-300 ease-in-out border-b rounded-md hover:bg-gray-200">
                                                <td class="px-6 py-4 text-sm text-gray-500">3</td>
                                                <td class="px-6 py-4 text-sm text-gray-500"><span class="line-clamp-1">Cara
                                                        Install Laravel Di Windows 10</span></td>
                                                <td class="px-6 py-4 text-sm text-gray-500">105</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-4">
            <p class="text-lg font-medium capitalize">last visitor</p>
            <div class="px-4 py-4 mt-4 bg-white border rounded-md shadow-md">
                <div class="max-w-full mx-auto">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-4">
                            <div class="inline-block min-w-full pb-2 sm:px-4">
                                <div class="overflow-y-auto">
                                    <table class="min-w-full">
                                        <thead class="border-b">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-700 capitalize">
                                                    #</th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-700 capitalize">
                                                    ip</th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-700 capitalize whitespace-nowrap">
                                                    slug</th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-700 capitalize whitespace-nowrap">
                                                    user agent</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="font-medium align-top transition duration-300 ease-in-out border-b rounded-md hover:bg-gray-200">
                                                <td class="px-6 py-4 text-sm text-gray-500">3</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">196.34.0.1</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    <span class="line-clamp-1">/mantab-sekali-cok-hahaha</span>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    <span class="line-clamp-1">Mozilla/5.0 AppleWebKit/537.36 (KHTML, like
                                                        Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)
                                                        Chrome/103.0.5060.134 Safari/537.36</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            new Morris.Line({
                element: 'statisticChart',
                resize: true,
                data: [{
                    "date": "2023-06-01",
                    "views": 12,
                }, {
                    "date": "2023-06-02",
                    "views": 10,
                }, {
                    "date": "2023-06-03",
                    "views": 123,
                }, {
                    "date": "2023-06-04",
                    "views": 24,
                }, {
                    "date": "2023-06-05",
                    "views": 34,
                }, {
                    "date": "2023-06-06",
                    "views": 13,
                }, {
                    "date": "2023-06-07",
                    "views": 426,
                }, {
                    "date": "2023-06-08",
                    "views": 21,
                }, {
                    "date": "2023-06-09",
                    "views": 34,
                }, {
                    "date": "2023-06-10",
                    "views": 35,
                }, {
                    "date": "2023-06-11",
                    "views": 364,
                }, {
                    "date": "2023-06-12",
                    "views": 324,
                }],
                xkey: 'date',
                xLabels: 'day',
                ykeys: ['views'],
                labels: ['Views'],
                lineColors: ['#0440bc'],
                lineWidth: 2,
                hideHover: 'auto',
                smooth: false
            });
        });
    </script>
@endsection
