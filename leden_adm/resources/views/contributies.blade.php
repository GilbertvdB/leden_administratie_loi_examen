<x-leden-layout>
    <div class="max-w-4xl mx-auto p-2 border overflow-auto bg-white">
        <div class="flex flex-column">
        <h1 class="text-2xl">Contributies Familie {{ $fam_naam }}</h1>
        <div class="p-2"><a href="{{ route('familie.show', ['familie' => $fam_id]) }}">Naar Profiel</a></div>
        </div>
        <br>
        
        <!-- Set default boekjaar -->
        @php($jaar = session('jaar'))
       	@empty($jaar)
       		@php( $jaar = date("Y"))
       	@endempty
        
		@php($view = $fam_leden->where('jaar', $jaar))

		
	<!-- Incompleet profiel -->
    @if($incompleet->isNotEmpty())
    <details><summary>Incompleet</summary>
    <div>
    	<p class="pl-2 italic text-red-700">Incompleet contributie profiel voor:</p>
    	<table class="table-auto border-separate border-spacing-0 border border-red-300">
        <thead class="text-left">
          <tr class="bg-zinc-100">
            <th class="p-2">Naam</th>
            <th>Geboortedatum</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach ($incompleet as $lid)
          <tr class="hover:bg-blue-50">
            <td class="p-2">{{ $lid->naam }}</td>
            <td >{{ $lid->geboortedatum }}</td>
            @can('update', App\Models\Contributie::class)
                	<td>
                	<x-dropdown-link :href="route('contributie.edit', $lid->l_id)">
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
    </details>
    <br>
    
    		<!--  Boekjaar selectie -->
 			<div>
            @include('boekjaar.index')
            </div>
<div class="flex flex-row">	
    
    <!-- DISPLAY INFO TABLE -->
    @if($view->isNotEmpty())
    
    <div class="flex-none">
    	
        <!--  <table class="table-auto border-separate border-spacing-2 border border-blue-200"> -->
        <table class="table-auto px-2 border-separate border-spacing-0 border border-blue-200">
            <thead class="text-left">  
                <tr class="bg-zinc-100">
                <th>Id</th>
                  <th>Naam</th>
                  <th>Geboortedatum</th>
                  <th>Leeftijd</th>
                  <th>Soortlid</th>
                  <th>Bedrag</th>
                  <th>Boekjaar</th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($view as $lid)
              <tr class="hover:bg-blue-50">
                <td class="pr-2">{{ $lid->id }}</td>
                <td class="pr-2">{{ $lid->naam }}</td>
                <td class="pr-2">{{ $lid->geboortedatum }}</td>
                <td class="text-center pr-2">{{ $lid->leeftijd }}</td>
                <td class="pr-2">{{ $lid->soortlid }}</td>
                <td class="pr-2">&euro;{{ $lid->bedrag }}</td>
                <td class="pr-2">{{ $lid->jaar }}</td>
                @can('update', App\Models\Contributie::class)
                	<td>@if($jaar == date("Y"))<x-dropdown-link :href="route('contributie.edit', $lid->l_id)">
                                            {{ __('Wijzig') }}
                                        </x-dropdown-link>@endif</td>
                	 @endcan
                	 
                	<!-- alternate 
                	<td>
                	<button type="submit"><u class="text-xs">> Wijzig </u></button>
                	</td> 	-->
              </tr>
              </form>
            @endforeach
        </tbody>
        </table>
        <x-input-error :messages="$errors->get('soortlid')" class="mt-2" />
		<x-input-error :messages="$errors->get('bedrag')" class="mt-2" />
		@if(session('status'))
    		<div class="mt-2">
        	{{ session('status') }}
    		</div>
    	@endif
	</div> 
    <!-- Staffels info box -->
	<div class="shrink">
    	<x-staffels-info />
	</div>
</div>

@else
	<div class="p-2">Geen informatie om weer te geven voor het boekjaar {{ $jaar }}.</div>
@endif
</div>
</x-leden-layout>