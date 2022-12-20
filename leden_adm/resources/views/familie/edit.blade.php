<x-leden-layout>
    <div class="mx-auto overflow-auto">
		<div class="max-w-4xl mx-auto p-2 border-t-[1px] overflow-auto bg-white shadow">
    	
    	<!-- FAMILIE EDIT SECTION -->
    	<h1 class="text-2xl">Profiel Familie {{ $familie->naam }}</h1>
    	<br>
    	<div class="text-lg">
    		Wijzig of verwijder familie profiel:
    	</div>
    	
    	
    	<div class="border border-sky-200 p-2">
    	<div>
    		<!-- Verwijder Familie profiel link -->
    		@can('delete', $familie)
            <div>
            	<span>Profiel - </span>
                <span class="text-sm" >
					<button  data-modal-toggle="popup-modal" id="{{$familie->id}}" class="hover:text-sky-500"> Verwijder</button>
                </span>
            </div>
            @endcan
        
        <!-- Wijzig Familie profiel -->        
        <div>
        <form method="POST" action="{{ route('familie.update', $familie) }}">
        @csrf
        @method('patch')

        <!-- Naam -->
        <div class="flex flex-row items-center">
        	<label class="basis-1/5">Familie Naam</label>
        	@can('update', $familie)
        		<input type="text" name="naam" value="{{ $familie->naam }}" required class="border-none focus:ring-0 shadow-xl my-1 focus:bg-sky-50">
        	@else<span class="py-2 pl-3">{{ $familie->naam }}</span> 
        		@endcan
        </div>
        
        <!-- Adres -->
        <div class="flex flex-row items-center">
        	<label class="basis-1/5">Familie Adres</label>
        	@can('update', $familie)
        		<input type="text" name="adres" value="{{ $familie->adres }}" required class="border-none focus:ring-0 shadow-xl my-1 focus:bg-sky-50">
        	@else<span class="py-2 pl-3"> {{ $familie->adres }}</span>
				@endcan
        </div>
        
        </div>
          	@can('update', $familie)
			 <x-primary-button class="mt-4">
                {{ __('Wijzig') }}
            </x-primary-button>
			
			<x-back-button class="ml-1 mt-4" onclick="history.back()">
            	{{ __('Terug') }}
            </x-back-button>
            @endcan
            
            <div>
        	<x-input-error :messages="$errors->get('naam')" class="mt-2" />
        	<x-input-error :messages="$errors->get('adres')" class="mt-2" />
        </div>
        </form>
        </div>
            
            <hr class="border-[1px] border-gray-200 my-2"> 
        
        <!-- delete confirmation modal -->
		<x-Delete-Form-modal :action="route('familie.destroy', $familie)"/>
        
       <div> 
    </div>
</x-leden-layout>