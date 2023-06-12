<a class="flex items-center gap-2 px-4 py-2 text-xl text-white capitalize transition duration-300 {{ Request::is($href) ? 'bg-white/5' : 'hover:bg-white/5' }}"
    href="/{{ $href }}">
    {{ $slot }}
    {{ $name }}
</a>
