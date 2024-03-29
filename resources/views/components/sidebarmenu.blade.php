<nav class="mt-5">
    @can('view-any', App\Models\Cluster::class)
        <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="{{ 'bxs-dashboard' }}">
            Dashboard
        </x-sidebar-link>
    @endcan
    @role('super-admin')
    @can('view-any', App\Models\User::class)
        <x-sidebar-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')" icon="{{ 'bx-user' }}">
            Usuarios
        </x-sidebar-link>
    @endcan
    @endrole
    @if (Auth::user()->can('create', Spatie\Permission\Models\Role::class) ||
                Auth::user()->can('create', Spatie\Permission\Models\Permission::class))
        <hr class="mt-3" />
        @can('create', Spatie\Permission\Models\Role::class)
            <x-sidebar-link href="{{ route('roles.index') }}" :active="request()->routeIs('roles.index')" icon="{{ 'bx-tag-alt' }}">
                Roles
            </x-sidebar-link>
        @endcan
        @can('create', Spatie\Permission\Models\Permission::class)
            <x-sidebar-link href="{{ route('permissions.index') }}" :active="request()->routeIs('permissions.index')" icon="{{ 'bx-badge-check
                ' }}">
                Permissions
            </x-sidebar-link>
        @endcan
    @endif
</nav>
