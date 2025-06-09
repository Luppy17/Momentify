<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 justify-between px-3"
>
    {{-- Top Section --}}
    <div class="flex flex-col gap-4">
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
        {{-- @if (auth()->user()->is_user == 1) --}}
            <x-sidebar.link
                title="Momentify"
                href="{{ route('momentify.index') }}"
                :isActive="request()->routeIs('momentify.index')"
            >
                <x-slot name="icon">
                    <x-heroicon-o-camera class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>
            </x-sidebar.link>
        {{-- @endif --}}

        {{-- Event Detail Link --}}
        @if (auth()->user()->is_admin || auth()->user()->is_event_manager || auth()->user()->is_photographer)
            <x-sidebar.link
                title="Event Detail"
                href="{{ route('eventdetails.index') }}"
                :isActive="request()->routeIs('eventdetails.index')"
            >
                <x-slot name="icon">
                    <x-heroicon-o-calendar class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>
            </x-sidebar.link>
        @endif

        {{-- User Role Management - Admin Only --}}
        @if(auth()->user()->is_admin)
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

        {{-- Configuration --}}
        @if (auth()->user()->is_admin || auth()->user()->is_event_manager)
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
        @endif
    </div>

    {{-- Bottom Section --}}
    <div class="pt-4 mt-4 border-t border-gray-300 dark:border-gray-600">
        <x-sidebar.link
            title="Settings"
            href="{{ route('profile.edit') }}"
            :isActive="request()->routeIs('profile.edit')"
        >
            <x-slot name="icon">
                <x-heroicon-o-cog class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    </div>
</x-perfect-scrollbar>
