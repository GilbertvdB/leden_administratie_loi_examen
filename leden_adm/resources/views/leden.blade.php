<x-leden-layout>
	<!-- content -->
    <div class="py-0">
        <div class="max-w-4xl mx-auto p-2 bg-white overflow-hidden border-t-[1px] border-gray-200 drop-shadow">
        	
        <div>
        <form action="{{ route('zoek_lid') }}" method="POST">
    	@csrf
    	<input type="text" name="search" value="{{ request('search') }}">
    	<button type="submit">Search</button>
		</form>
        </div>
        
        <div>
        <br>
        SearchTerm = {{ $searchterm }}
        <br>
        </div>
        	<!-- Leden info tabel -->
		<div class="border border-sky-200 rounded">
        <table class="min-w-full">
          <thead class="border-b border-sky-200 text-left">
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
          
          <tr class=" border-b border-sky-200 last:border-0 hover:bg-sky-100">
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
                    <x-dropdown-link :href="route('familie.show', $lid->familie_id )" class="hover:text-sky-500">
                        {{ __('Profiel') }}
                    </x-dropdown-link>
					<x-dropdown-link :href="route('contributie.show', $lid->familie_id )" class="hover:text-sky-500">
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
			{{ $leden->appends(['search' => $searchterm])->links() }}
		</div>
    	
    	
    	</div>
    </div>
</x-leden-layout>
