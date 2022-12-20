<x-leden-layout>
	<!-- content -->
    <div class="py-0">
        <div class="max-w-4xl mx-auto p-2 bg-white overflow-hidden border-t-[1px] border-gray-200 drop-shadow">
        	<div>
			
            <!-- Algemene gebruiker -->
			@if(Auth::user()->role_id == 5)
			<p>Welcome {{ auth()->user()->name }}</p>
			<p>Je hebt beperkt of nog geen toegang tot de omgeving.</p>
			<p>Neem gerust contact op met de ondersteuning om de toegankelijkheid van uw profiel te wijzigen.</p>
			
			
			@else
		    <!--Families info lijst & zoek container -->
			<x-famdisplay :info="$info" />
			@endif
			
			</div>
    	</div>
    </div>
</x-leden-layout>
