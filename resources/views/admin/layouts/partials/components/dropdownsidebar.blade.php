@if (count($items) > 0)
    <button
        class="flex items-center justify-between w-full px-4 py-2 text-xl text-white capitalize transition duration-300 sidebar-dropdown hover:bg-white/5">
        <span class="flex items-center gap-2">
            {{ $slot }}
            {{ $name }}
        </span>
        <ion-icon class="transition duration-500 dropdown-arrow"
            style="transform: rotate({{ Request::is($path) ? '180' : '0' }}deg);" name="chevron-down-outline"></ion-icon>
    </button>
    <ul class="dropdown-content" style="display: {{ Request::is($path) ? 'block' : 'none' }};"
        aria-expanded="{{ Request::is($path) ? 'true' : 'false' }}">
        @foreach ($items as $item)
            <li>
                <a class="flex items-center gap-2 px-12 py-2 text-lg text-white capitalize transition duration-300 {{ Request::is($item['href']) ? 'bg-white/5' : 'hover:bg-white/5' }}"
                    href="/{{ $item['href'] }}">
                    {{ $item['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
