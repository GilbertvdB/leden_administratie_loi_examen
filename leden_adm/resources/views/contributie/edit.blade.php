<x-leden-layout>
    <div class="max-w-4xl mx-auto p-2 border overflow-auto bg-white sm:p-6 lg:p-8">
	<h1 class="text-xl">Contributie aanpassen</h1>
	<br>
	
	<div class="form max-w-xl" >
		<form name="lid" method="POST" action="{{ route('contributie.update', $lid->id) }}">
            @csrf
			@method('patch')
            <!-- Naam -->
            <div>
                <x-input-label for="naam" :value="__('Naam')" />

                <x-text-input id="naam" class="block mt-1 w-full" type="text" name="naam" value="{{ $lid->naam }}" readonly />

                <x-input-error :messages="$errors->get('naam')" class="mt-2" />
            </div>

            <!-- Geboortedatum -->
            <div class="mt-4">
                <x-input-label for="geboortedatum" :value="__('Geboortedatum')" />

                <x-text-input id="geboortedatum" class="block mt-1 w-full" type="text" name="geboortedatum" value="{{ $lid->geboortedatum }}" readonly/>

                <x-input-error :messages="$errors->get('geboortedatum')" class="mt-2" />
            </div>
            
            @if($contributie)
            	@php( $leeftijd = $contributie->leeftijd )
            @else
            	@php( $leeftijd = $leeftijd_info )
            @endif
            <!-- Leeftijd -->
            <div class="mt-4">
                <x-input-label for="leeftijd" :value="__('Leeftijd')" />

                <x-text-input id="leeftijd" class="block mt-1 w-full" type="text" name="leeftijd" value="{{ $leeftijd }}" readonly/>

                <x-input-error :messages="$errors->get('leeftijd')" class="mt-2" />
            </div>
			
			@if($contributie)
			<!-- Bedrag -->
            <div class="mt-4">
                <x-input-label for="bedrag" :value="__('Bedrag')" />

                <x-text-input id="bedrag" class="block mt-1 w-full" type="text" name="bedrag" value="{{ $contributie->bedrag }}" />

                <x-input-error :messages="$errors->get('bedrag')" class="mt-2" />
            </div>
			@endif
			
			<!-- Soortlid -->
            <div class="mt-4">
                <x-input-label for="soortlid" :value="__('Soortlid')" />
                	<div class="block mt-1 w-full">
					<input type="radio" id="jeugd" name="soortlid" value="Jeugd" class="text-sky-500 focus:ring-sky-500"> 
					<label for="jeugd">Jeugd</label>
					<input type="radio" id="aspirant" name="soortlid" value="Aspirant" class="ml-8 text-sky-500 focus:ring-sky-500" > 
					<label for="aspirant">Aspirant</label>
					<input type="radio" id="junior" name="soortlid" value="Junior" class="ml-8 text-sky-500 focus:ring-sky-500" > 
					<label for="junior">Junior</label>
					<input type="radio" id="senior" name="soortlid" value="Senior" class="ml-8 text-sky-500 focus:ring-sky-500" > 
					<label for="senior">Senior</label>
					<input type="radio" id="oudere" name="soortlid" value="Oudere" class="ml-8 text-sky-500 focus:ring-sky-500" > 
					<label for="oudere">Oudere</label>
					</div>
                <x-input-error :messages="$errors->get('soorlid')" class="mt-2" />

                <script> document.lid.soortlid.value='<?php echo $lid->soortlid ?>';
                 </script>

            </div>
            <br>
            
			<!-- Staffels info box -->
        	<div class="">
            	<x-staffels-info class="text-sm"/>
        	</div>
			
            <div class="flex items-center justify-start mt-4">

                <x-primary-button class="mt-4">
                    {{ __('Wijzig') }}
                </x-primary-button>
                
                <x-back-button class="ml-1 mt-4" onclick="history.back()">
                	{{ __('Terug') }}
                </x-back-button>	
                
            </div>
        </form>
    </div>
</x-leden-layout>