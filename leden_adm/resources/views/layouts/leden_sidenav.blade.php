<div class="class="max-w-2xl mx-auto">
    	<div class="w-44 h-screen border bg-white float-left">
 		<ul>
 		<li><a href="{{ route('dashboard') }}" class="block hover:bg-gray-200 py-1 pl-2" >Dashboard</a></li>
 		<li><a href="{{ route('ledendash') }}" class="block hover:bg-gray-200 py-1 pl-2" >Leden</a></li>
 		<li><a href="#" class="block hover:bg-gray-200 py-1 pl-2" >Contributies</a></li>
 		<li><a href="#" class="block hover:bg-gray-200 py-1 pl-2" >Families</a></li>
  		<li><a href="#" class="block hover:bg-gray-200 py-1 pl-2">Staffels</a></li>
  		<li><a href="#" class="block hover:bg-gray-200 py-1 pl-2">Contact</a></li>
  		</ul>
  		<details><summary class="cursor-pointer">Admin tables</summary>
  		<div class="pl-6">
  		<a href="{{ route('familie.create') }}" class="block hover:bg-gray-200 py-1 pl-2" >Familie</a>
 		<a href="{{ route('familielid.index') }}" class="block hover:bg-gray-200 py-1 pl-2" >Familielid</a>  <!-- Change to create -->
  		<a href="{{ route('soortlid.index') }}" class="block hover:bg-gray-200 py-1 pl-2">Soortlid</a>
  		<a href="{{ route('boekjaar.index') }}" class="block hover:bg-gray-200 py-1 pl-2">Boekjaar</a>
  		<a href="{{ route('contributie.create') }}" class="block hover:bg-gray-200 py-1 pl-2">Contributie</a>
		<a href="{{ route('familie.create') }}" class="block hover:bg-gray-200 py-1 pl-2" >Add/Edit Families</a>
		<a href="{{ route('contributie.index') }}" class="block hover:bg-gray-200 py-1 pl-2">Edit Contributies</a>
		@can('update', App\Models\User::class)
		<a href="{{ route('admin.index') }}" class="block hover:bg-gray-200 py-1 pl-2">Permissions</a>
		@endcan
		</div>
        </details>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
        <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
      </div>
</div>
