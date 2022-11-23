<div class="border border-blue-200 p-2">
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->

<h1 class="font-bold leading-5 text-2xl">Leden Contributie</h1>
	<h2 class="mt-1 text-Gray-600 text-xl">Jaar 2022</h2>
	<br>
	<span class="font-bold px-2">Familie</span><span class="font-bold float-right">Contributie</span>
    <hr class="mt-2 border-indigo-200">

    @php($families = $fam_contributies_info->pluck('id')->unique()->values())
    
    @foreach ($families as $familie)
    	@php($leden = $fam_contributies_info->where('id', '==', $familie))
    	@php($familieNaam = $leden->value('familie'))
    	@php($familieContributie = $leden->sum('bedrag'))
    	@php($familieAdres = $leden->value('adres'))
    	@php($fam_id = $leden->value('id'))
    	@php($notComplete = '')
    	
    	<!-- Incompleet profile check -->
    	@foreach ($leden as $check)
    		@unless ($check->naam and $check->geboortedatum and $check->soortlid and $check->bedrag)
    		@php($notComplete = True)
    		@break
    		@endunless 
    	@endforeach
    	
    	
		<div>
            <details class="border-b-[1px] border-indigo-200 open:shadow-[-3px_-1px_0_0_rgba(199,210,254,1)]" >
    		<summary class="bg-white relative cursor-pointer py-2 px-2 list-none hover:bg-blue-50">
        			<div class="flex items-center">
        			<h3 flex flex-col>
    					<strong class="font-bold">{{ $familieNaam}}</strong>
    					@if($notComplete)
    					<span class="pl-2 text-xs text-red-800">Incompleet</span>
    					@endif
    					<br>
  					<!--  <small class="text-Gray-600 text-sm">Adres: {{ $familieAdres }}</small> -->	
  					</h3>
  						<span class="ml-auto font-bold focus:outline-none" >&euro;{{ $familieContributie }}</span>
      				</div>
      		</summary>
      		<p class="pl-2"> <a href="{{ route('familie.show', ['familie' => $fam_id]) }}">Naar Profiel</a> | 
      		<a href="{{ route('contributie.show', ['contributie' => $fam_id]) }}">Contributies</a></p>
      			
            <p class="pl-2">Adres: {{ $familieAdres }}</p>
            <ul class="pl-2">
            	@foreach ($leden as $lid)
            	<li><div class="grid grid-cols-3">
            			<div>{{ $lid->naam }} @unless ($lid->naam and $lid->geboortedatum and $lid->soortlid and $lid->bedrag)
    					<span class="pl-2 text-xs text-red-800">Incompleet</span>
    					@endunless</div>
            			<div class="text-center"> {{ $lid->geboortedatum }}</div>
            			<div><span class="float-right">{{ $lid->soortlid }}</span></div>
            		</div>
            	</li>
            	@endforeach
             </ul>
            </details>
            @endforeach
		</div>
</div>
	
</div>	
<br>
