<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    {{-- Dashboard Link --}}
    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    {{-- Momentify Link --}}
    <x-sidebar.link
        title="Momentify"
        href="{{ route('eventdetails.index') }}"
        :isActive="request()->routeIs('eventdetails.index')"
    >
        <x-slot name="icon">
            <x-heroicon-o-camera class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    {{-- User Dropdown --}}
    @if(auth()->user()->is_admin == 1)
        <x-sidebar.dropdown
            title="Users and Roles"
            :active="Str::startsWith(request()->route()->uri(), 'user-role-managements')"
        >
            <x-slot name="icon">
                <x-heroicon-o-user class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>

            <x-sidebar.link
                title="Admin"
                href="{{ route('role.management.admin.index') }}"
                :active="request()->routeIs('role.management.admin.index')"
            />
            <x-sidebar.link
                title="Event Manager"
                href="{{ route('role.management.event.manager.index') }}"
                :active="request()->routeIs('role.management.event.manager.index')"
            />
            <x-sidebar.link
                title="Photographer"
                href="{{ route('role.management.photographer.index') }}"
                :active="request()->routeIs('role.management.photographer.index')"
            />

            <x-sidebar.link
                title="User"
                href="{{ route('role.management.normal.user.index') }}"
                :active="request()->routeIs('role.management.normal.user.index')"
            />
        </x-sidebar.dropdown>
    @endif

    {{-- Configuration Dropdown --}}
    <x-sidebar.dropdown
        title="Configuration"
        :active="Str::startsWith(request()->route()->uri(), 'configuration')"
    >
        <x-slot name="icon">
            <x-heroicon-o-cog class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.link
            title="Event"
            href="{{ route('eventconfig.index') }}"
            :active="request()->routeIs('eventconfig.index')"
        />
    </x-sidebar.dropdown>

</x-perfect-scrollbar>
