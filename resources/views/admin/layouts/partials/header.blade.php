<header class="px-4 py-[1rem] flex items-center justify-between border-b bg-white">
    <div class="flex items-center gap-4">
        <button>
            <ion-icon class="text-2xl" name="menu-outline"></ion-icon>
        </button>
    </div>
    <div class="flex items-center gap-4">
        <button class="relative">
            <ion-icon class="text-2xl" name="notifications-outline"></ion-icon>
        </button>
        <form method="POST" action="/auth/signout">
            @csrf
            <button type="submit">
                <ion-icon class="text-2xl" name="log-out-outline"></ion-icon>
            </button>
        </form>
    </div>
</header>
