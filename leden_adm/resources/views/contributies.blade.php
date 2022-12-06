<x-leden-layout>
    <div class="max-w-4xl mx-auto p-2 border-t-[1px] overflow-auto bg-white drop-shadow">
        <div>
        	<h1 class="text-2xl">Contributies Familie {{ $familie_naam }}</h1>
        </div>
        <div class="text-lg">
        	<a href="{{ route('familie.show', ['familie' => $familie_id]) }}" class="hover:text-sky-500">Naar Profiel</a>
        </div>
        <br>
        <!-- Set default boekjaar -->
        @php($jaar = session('jaar'))
       	@empty($jaar)
       		@php( $jaar = date("Y"))
       	@endempty
        
		@php($contributies_leden = $fam_leden->where('jaar', $jaar))

    
		<!--  Boekjaar selectie -->
		<div>
        @include('boekjaar.index')
        </div>
		
		<!-- Boekjaar info tabel -->
		<div>	
        @if($contributies_leden->isNotEmpty())
        <table class="table-auto border-separate border-spacing-0 border border-sky-200">
            <thead class="text-left">  
                <tr class="bg-zinc-100">
                  <th class="p-2 pr-6">Naam</th>
                  <th class="pr-6">Geboortedatum</th>
                  <th class="pr-6">Leeftijd</th>
                  <th class="pr-6">Soortlid</th>
                  <th class="pr-6">Bedrag</th>
                  <th class="pr-6">Boekjaar</th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($contributies_leden as $lid)
              <tr class="hover:bg-sky-50">
                <td class="p-2 pr-6">{{ $lid->naam }}</td>
                <td>{{ $lid->geboortedatum }}</td>
                <td>{{ $lid->leeftijd }}</td>
                <td>{{ $lid->soortlid }}</td>
                <td>&euro;{{ $lid->bedrag }}</td>
                <td>{{ $lid->jaar }}</td>
                @can('update', App\Models\Contributie::class)
                	<td>@if($jaar == date("Y"))
                		<x-dropdown-link :href="route('contributie.edit', $lid->l_id)" class="hover:bg-sky-50 active:bg-sky-100">
                        	{{ __('Wijzig') }}
                        </x-dropdown-link
                        >@endif
                    </td>
               	@endcan
              </tr>
              </form>
            @endforeach
        	</tbody>
        </table>
	
        <!-- Staffels info box -->
    	<div class="w-2/5">
        	<br>
        	<details><summary class="list-none cursor-pointer">Staffels</summary>
        	<x-staffels-info class="text-sm"/>
        	</details>
    	</div>
	</div>
	
	<!-- Boekjaar geen data bericht -->
	@else
		<div class="text-lg">Geen informatie beschikbaar voor boekjaar {{ $jaar }}.</div>
	@endif

    <!-- Incompleet lid contributie profiel -->
    <br>
    @if($incompleet->isNotEmpty())
    <div>
    	<p class="italic text-red-700">Incompleet contributie profiel voor:</p>
    	<table class="table-auto border-separate border-spacing-0 border border-gray-200">
            <thead class="text-left">
              <tr class="bg-zinc-100">
                <th class="p-2">Naam</th>
                <th>Geboortedatum</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($incompleet as $lid)
              <tr class="hover:bg-sky-50">
                <td class="p-2">{{ $lid->naam }}</td>
                <td >{{ $lid->geboortedatum }}</td>
                @can('update', App\Models\Contributie::class)
				<td>
                	<x-dropdown-link :href="route('contributie.edit', $lid->l_id)" class="hover:bg-sky-50">
                    	{{ __('Wijzig') }}
                    </x-dropdown-link>
            	</td>
            	 @endcan
              </tr>
             @endforeach 
            </tbody>
        </table>         
    </div>
    <br>
    @endif

</div>
</x-leden-layout>