<div class="border-blue-200 p-2">

    <!-- Title -->
	<h1 class="font-bold leading-5 text-2xl">Leden Contributies</h1>
	<h2 class="mt-1 text-Gray-600 text-xl">Jaar 2022</h2>
	<br>
	
	<!--  Search Bar -->
	<div class="mb-2">
    	<div class="border w-fit flex flex-row h-10 rounded-3xl border-indigo-200">
    	<div>
            <form id="searchbar" action="{{ route('ledendash')}}" method="POST">
                @csrf
                <input type="search" class="text-sm mt-1 h-8 border-none outline-red rounded-3xl" name="search" placeholder="Zoek familie..." value="{{ request('search') }}">
        	</form>
    	</div>
    	<div class="bg-indigo-200 ml-2 p-2 hover:bg-indigo-300 cursor-pointer rounded-full">
        	 <button type="submit" form="searchbar">
        	 <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
             </svg></button>
        </div>	
	</div>	
	</div>
	<!-- Display fam info table -->
	<div class="border border-indigo-200">
@foreach($info as $familie)

	<!-- Bereken totaal familie contributie -->
	@php $sum = 0;
	foreach($familie->familieLeden as $lid) {
		if(empty($lid->lidContributie->bedrag)) {
			$sum += 0; }
		else { $sum += ($lid->lidContributie->bedrag); } 
		}	 
	@endphp
	
	<!-- Lid profiel check -->	
	@php($notComplete = '')
	@if($familie->familieLeden->isNotEmpty())
    	@foreach ($familie->familieLeden as $check)
    		@unless ($check->naam and $check->geboortedatum and $check->soortlid and $check->LidContributie->bedrag)
    			@php($notComplete = True)
    			@break
    		@endunless 
    	@endforeach
	@else
		@php($notComplete = True)
	@endif
		
	<details class="border-b-[1px] border-indigo-200 open:shadow-[-3px_-1px_0_0_rgba(199,210,254,1)]">
	<summary class="bg-white relative cursor-pointer py-2 px-2 list-none hover:bg-blue-50">
	<span class="font-bold">{{ $familie->naam }}</span>@if($notComplete)
    					<span class="pl-2 text-xs text-red-800">Incompleet</span>
    					@endif<span class="ml-auto font-bold float-right focus:outline-none">&euro;{{ $sum }}</span></summary>
		
		<div><span class="pl-2">{{ $familie->adres }}</span>
			</div>
		<div class="mt-2"><span class="pl-2 text-sm"> <a href="{{ route('familie.show', ['familie' => $familie->id]) }}">Naar Profiel</a> | 
      		<a href="{{ route('contributie.show', ['contributie' => $familie->id]) }}">Contributies</a></span></div>
		<div>
		@foreach( $familie->familieLeden as $lid)
			<div class="flex flex-row pl-2">
				<div class="basis-2/5">{{ $lid->naam }}@unless ($lid->naam and $lid->geboortedatum and $lid->soortlid and $lid->LidContributie->bedrag)
    					<span class="pl-2 text-xs text-red-800">Incompleet</span>
    					@endunless</div>
			<div class="basis-1/5">{{ $lid->geboortedatum }}</div> 
			<div class="basis-1/5">{{ $lid->soortlid }}</div>
			</div>
			
		@endforeach
		</div>
	</details>
@endforeach
</div>

<div class="">
	{{ $info->links() }}
	</div>

</div>	
<br>
