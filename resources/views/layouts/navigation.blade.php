
<nav class="flex flex-col h-full bg-white p-6 space-y-2">
    <!-- Logo -->
    <div class="flex items-center mb-8">
        <a href="{{ route('dashboard') }}" class="flex items-center text-blue-900 no-underline">
            <img src="{{ asset('images/icon-aquacentinel.png') }}" class="h-10 w-10" alt="AquaSentinel">
            <span class="ml-3 text-xl font-bold">AquaSentinel</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 space-y-1">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <i class="fas fa-chart-line w-5 mr-3 text-center"></i>
            {{ __('Dashboard') }}
        </x-nav-link>

        <x-nav-link :href="route('boya.index')" :active="request()->routeIs('boya.*')">
            <i class="fas fa-water w-5 mr-3 text-center"></i>
            {{ __('Mis Boyas') }}
        </x-nav-link>
        

    </div>

    <!-- User Section -->
    <div class="pt-6 mt-6 border-t border-gray-200 space-y-2">
        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
            <i class="fas fa-user w-5 mr-3 text-center"></i>
            {{ __('Mi Perfil') }}
        </x-nav-link>

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full text-left flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200">
                <i class="fas fa-sign-out-alt w-5 mr-3 text-center"></i>
                {{ __('Cerrar Sesión') }}
            </button>
        </form>
    </div>

    <!-- App Version -->
    <div class="pt-4 text-xs text-gray-500 text-center">
        v1.0.0
    </div>
</nav>

<style>
    .nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        color: #6b7280;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-bottom: 0.25rem;
    }

    .nav-link:hover {
        background-color: #EAF6FF;
        color: #084B8A;
        transform: translateX(4px);
    }

    .nav-link.active {
        background-color: #0A75D1;
        color: white;
        box-shadow: 0 4px 12px rgba(10, 117, 209, 0.3);
    }

    .nav-link.active i {
        color: white;
    }

    .nav-link i {
        color: #9ca3af;
        transition: color 0.3s ease;
    }

    .nav-link:hover i {
        color: #084B8A;
    }

    .nav-link.active:hover {
        background-color: #084B8A;
    }
</style>



