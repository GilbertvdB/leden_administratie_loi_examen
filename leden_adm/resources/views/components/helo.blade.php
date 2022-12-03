<x-leden-layout>
    <div class="max-w-4xl mx-auto bg-white p-4 sm:p-6 lg:p-8 overflow-auto">
        <h1>Testing passing request from controller to controller</h1>
        <p>Passing a collection to the controller method and test if it displays as a request.</p>
        <br>
	
	@if(auth()->user()->email == "admin@ledenadm.com")
	This data for Admin
	@endif
	<br>
	@if(auth()->user()->email == "penny@ledenadm.com")
	This data for Penny
	@endif
	<br>
	<ul>

    <li>

        <a href="www.a.com">Projects</a>

    </li>

    @can('isPenny')

    <li>

        <a href="www.b.com">Penningmeester</a>

    </li>

    @endcan

</ul>
<br>
<div>

info  <details><summary>Info</summary>{{ $info }}</details>
<br><br>


<div class="border">
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
		
	<details class="clear-left"><summary><span>{{ $familie->naam }}</span>@if($notComplete)
    					<span class="pl-2 text-xs text-red-800">Incompleet</span>
    					@endif<span class="float-right">&euro;{{ $sum }}</span></summary>
		
		<div><span>{{ $familie->adres }}</span></div>
		<div <p class="pl-2 text-sm"> <a href="{{ route('familie.show', ['familie' => $familie->id]) }}">Naar Profiel</a> | 
      		<a href="{{ route('contributie.show', ['contributie' => $familie->id]) }}">Contributies</a></p></div>
		<div>
		@foreach( $familie->familieLeden as $lid)
			<div class="float-left mr-10">{{ $lid->naam }}@unless ($lid->naam and $lid->geboortedatum and $lid->soortlid and $lid->LidContributie->bedrag)
    					<span class="pl-2 text-xs text-red-800">Incompleet</span>
    					@endunless</div>
			<div class="float-left mr-10">{{ $lid->geboortedatum }}</div> 
			<div class="float-left mr-10">{{ $lid->soortlid }}</div>
			<br>
		@endforeach
		</div>
	</details>
@endforeach
</div>

{{ $info->links() }}

</div

	

</div>  


<!-- OLD -->
	<div class="">
	<span class="font-bold px-2">Familie</span><span class="font-bold float-right">Contributie</span>
    <hr class="mt-2 border-indigo-200">

    @php($families = $info->pluck('id')->unique()->values())
    
    @foreach ($families as $familie)
    	@php($leden = $info->where('id', '==', $familie))
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
		
		<!-- Pagination prev & next link -->
		<div class="mt-2">
		{{ $info->links() }}
		</div>
	
	</div>

</x-leden-layout>