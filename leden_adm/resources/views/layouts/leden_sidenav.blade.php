<div class="class="max-w-2xl mx-auto">
    	<div class="w-44 h-screen border bg-white float-left text-lg">
 		<ul>
 		<li><a href="{{ route('ledendash') }}" class="block hover:text-sky-500 py-1 pl-2 {{ (request()->routeIs('familie.index')) ? 'text-sky-500' : '' }}" >Dashboard</a></li>
 		<li><details><summary class="cursor-pointer list-none hover:text-sky-500 flex item-center py-1 pl-2">
 		<div>Families</div>
 		<div class="ml-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
 		</summary>
 			<ul>
 				@can('create', App\Models\Familie::class)
 				<li><a href="{{ route('familie.create') }}" class="block hover:text-sky-500 hover:bg-gray-100 py-1 pl-6 {{ (request()->routeIs('familie.create')) ? 'text-sky-500' : '' }}" >Toevoegen</a></li>
 				@endcan
 				<li><a href="{{ route('ledendash') }}" class="block hover:text-sky-500 hover:bg-gray-100 py-1 pl-6 active:bg-gray-200 {{ (request()->routeIs('familie.index')) ? 'text-sky-500' : '' }}" >Zoeken</a></li>
 			</ul>
 			</li></details
 		<li><a href="{{ route('familielid.index') }}" class="block hover:text-sky-500 py-1 pl-2 {{ (request()->routeIs('familielid*')) ? 'text-sky-500' : '' }}" >Leden</a></li>
  		<li><a href="{{ route('staffels') }}" class="block hover:text-sky-500 py-1 pl-2 {{ (request()->routeIs('staffels')) ? 'text-sky-500' : '' }}">Staffels</a></li>
  		<li>@can('update', App\Models\User::class)
			<a href="{{ route('admin.index') }}" class="block hover:text-sky-500 py-1 pl-2 {{ (request()->routeIs('admin*')) ? 'text-sky-500' : '' }}">Authenticatie</a>
			@endcan</li>
  		</ul>
      </div>
</div>
