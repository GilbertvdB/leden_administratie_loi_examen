<div class="class="max-w-2xl mx-auto">
    	<div class="w-44 h-screen border bg-white float-left text-lg">
 		<ul>
 		<li><a href="{{ route('dashboard') }}" class="block hover:bg-indigo-100 py-1 pl-2" >Dashboard</a></li>
 		<li><details><summary class="cursor-pointer list-none hover:bg-indigo-100 flex item-center py-1 pl-2">
 		<div>Families</div>
 		<div class="ml-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
 		</summary>
 			<ul>
 				@can('create', App\Models\Familie::class)
 				<li><a href="{{ route('familie.create') }}" class="block hover:bg-indigo-100 py-1 pl-6" >Toevoegen</a></li>
 				@endcan
 				<li><a href="{{ route('ledendash') }}" class="block hover:bg-indigo-100 py-1 pl-6 active:bg-gray-200" >Zoeken</a></li>
 			</ul>
 			</li></details
 		<li><a href="{{ route('familielid.index') }}" class="block hover:bg-indigo-100 py-1 pl-2" >Leden</a></li>
  		<li><a href="#" class="block hover:bg-indigo-100 py-1 pl-2">Datas</a></li>
  		<li><a href="#" class="block hover:bg-indigo-100 py-1 pl-2">Staffels</a></li>
  		<li>@can('update', App\Models\User::class)
			<a href="{{ route('admin.index') }}" class="block hover:bg-indigo-100 py-1 pl-2">Authenticatie</a>
			@endcan</li>
  		</ul>
  		@can('update', App\Models\User::class)
  		<details><summary class="cursor-pointer list-none hover:bg-indigo-100 flex item-center py-1 pl-2">
  		<div>Admin</div>
 		<div class="ml-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
  		</summary>
  		<div class="">
      		<a href="{{ route('familie.create') }}" class="block hover:bg-gray-200 py-1 pl-6" >Familie</a>
     		<a href="{{ route('familielid.index') }}" class="block hover:bg-gray-200 py-1 pl-6" >Familielid</a>  <!-- Change to create -->
      		<a href="{{ route('soortlid.index') }}" class="block hover:bg-gray-200 py-1 pl-6">Soortlid</a>
      		<a href="{{ route('boekjaar.index') }}" class="block hover:bg-gray-200 py-1 pl-6">Boekjaar</a>
      		<a href="{{ route('contributie.create') }}" class="block hover:bg-gray-200 py-1 pl-6">Contributie</a>
    		<a href="{{ route('familie.create') }}" class="block hover:bg-gray-200 py-1 pl-6" >Add/Edit Families</a>
    		<a href="{{ route('contributie.index') }}" class="block hover:bg-gray-200 py-1 pl-6">Edit Contributies</a>
    		@can('update', App\Models\User::class)
    		<a href="{{ route('admin.index') }}" class="block hover:bg-gray-200 py-1 pl-6">Permissions</a>
    		@endcan
    	</div>
        </details>
        @endcan
        <!--  
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link> -->
      </div>
</div>
