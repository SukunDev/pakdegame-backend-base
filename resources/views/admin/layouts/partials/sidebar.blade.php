<div class="fixed inset-y-0 min-w-[18rem] left-0 z-50">
    <div class="flex flex-col h-full bg-slate-900">
        <div class="block py-4 mx-auto">
            <a class="flex items-center gap-2" href="/">
                <h1 class="text-2xl font-medium text-white">Pakde<span class="font-normal">Game</span></h1>
            </a>
        </div>
        <ul>
            <li>
                @component('admin.layouts.partials.components.sidebarlink', ['name' => 'dashboard', 'href' => 'ngadmin'])
                    <ion-icon class="text-2xl" name="home-outline"></ion-icon>
                @endcomponent
            </li>
            <li>
                @component('admin.layouts.partials.components.dropdownsidebar', [
                    'name' => 'posts',
                    'path' => 'ngadmin/posts*',
                    'items' => [
                        ['name' => 'semua article', 'href' => 'ngadmin/posts'],
                        ['name' => 'Tulis Article', 'href' => 'ngadmin/posts/write'],
                        ['name' => 'category', 'href' => 'ngadmin/posts/categories'],
                        ['name' => 'tags', 'href' => 'ngadmin/posts/tags'],
                    ],
                ])
                    <ion-icon class="text-2xl" name="document-text-outline"></ion-icon>
                @endcomponent
            </li>
            <li>
                @component('admin.layouts.partials.components.dropdownsidebar', [
                    'name' => 'pages',
                    'path' => 'ngadmin/pages*',
                    'items' => [
                        ['name' => 'semua halaman', 'href' => 'ngadmin/pages'],
                        ['name' => 'tulis halaman', 'href' => 'ngadmin/pages/write'],
                    ],
                ])
                    <ion-icon class="text-2xl" name="document-outline"></ion-icon>
                @endcomponent
            </li>
            <li>
                @component('admin.layouts.partials.components.dropdownsidebar', [
                    'name' => 'settings',
                    'path' => 'ngadmin/settings',
                    'items' => [['name' => 'general', 'href' => 'ngadmin/settings']],
                ])
                    <ion-icon class="text-2xl" name="settings-outline"></ion-icon>
                @endcomponent
            </li>
        </ul>
    </div>
</div>
