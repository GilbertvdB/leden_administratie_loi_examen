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
    					@endif<span class="float-right">{{ $sum }}</span></summary>
		
		<div><span>{{ $familie->adres }}</span></div>
		<div class="text-sm">Naar Profiel | Naar Contributies</div>
		<div>
		@foreach( $familie->familieLeden as $lid)
			<div class="float-left mr-10">{{ $lid->naam }}@unless ($lid->naam and $lid->geboortedatum and $lid->soortlid and $lid->LidContributie->bedrag)
    					<span class="pl-2 text-xs text-red-800">Incompleet</span>
    					@endunless</div>
			 
			<div class="float-left mr-10">{{ $lid->geboortedatum }}</div> 
			<div class="float-left mr-10">{{ $lid->soortlid }}</div>
			@php($bedrag = ($lid->lidContributie) ? $lid->lidContributie->bedrag : '' )
			<div class="float-left mr-10">{{ $bedrag }}</div>
			<br>
		@endforeach
		</div>
	</details>
@endforeach
</div>

{{ $info->links() }}

</div

	

</div>  

</x-leden-layout>