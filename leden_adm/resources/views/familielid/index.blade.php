<x-leden-layout>
    <div class="max-w-4xl mx-auto p-2 bg-white overflow-hidden border-t-[1px] border-gray-200 drop-shadow">
    	<div class="border-indigo-200 p-2">
        	<!-- Title -->
    		<h1 class="font-bold leading-5 text-2xl">Leden </h1>
    		<h2 class="mt-1 text-Gray-600 text-xl">Jaar 2022</h2>
    		<br>
 		
 		<!--  Search Bar -->
 		<div class="mb-1 grid grid-cols-6 gap-4">
        	<div class="col-end-7 col-span-2 place-self-end">
            	<div class="border border-indigo-200 w-fit flex flex-row h-10 rounded-3xl">
                	<div>
                        <form id="searchbar" action="{{ route('zoek_lid' )}}" method="POST">
                            @csrf
                            <input type="search" class="text-sm mt-1 h-8 border-none outline-red rounded-3xl" name="search" placeholder="Zoek..." value="{{ request('search') }}">
                    	</form>
                	</div>
                	<div class="bg-indigo-300 ml-2 p-2 hover:bg-indigo-400 active:bg-indigo-500 cursor-pointer rounded-full">
                    	 <button type="submit" form="searchbar">
                    	 <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                         </svg></button>
                    </div>	
        		</div>
        	</div>		
    	</div>
 		
 		
 		<!-- Leden info tabel -->
		<div class="border border-indigo-200 rounded">
        <table class="min-w-full">
          <thead class="border-b border-indigo-200 text-left">
          <tr class="bg-zinc-100">
            <th class="p-2">Naam</th>
            <th>Geboortedatum</th>
            <th>Leeftijd</th>
            <th>Soortlid</th>
            <th>Acties</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($leden as $lid)
          
          <tr class=" border-b border-indigo-200 last:border-0 hover:bg-indigo-100">
            <td class="p-2">{{ $lid->naam }}</td>
            <td>{{ $lid->geboortedatum }}</td>
            <td>@if($lid->lidContributie)
            		{{ $lid->lidContributie->leeftijd}}
            	@endif</td>
            <td>{{ $lid->soortlid}}</td>
            <td>
            <x-dropdown>
                <x-slot name="trigger">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('familie.show', $lid->familie_id )" class="hover:text-indigo-600">
                        {{ __('Profiel') }}
                    </x-dropdown-link>
					<x-dropdown-link :href="route('contributie.show', $lid->familie_id )" class="hover:text-indigo-600">
                        {{ __('Contributie') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
 			</td>
          </tr>
          @endforeach
          </tbody>
		</table>
		
		</div>	

		<div class="mt-1 mb-6">
			{{ $leden->links() }}
		</div>
    
    	</div>
    </div>
</x-leden-layout>