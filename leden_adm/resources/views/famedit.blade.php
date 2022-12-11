<x-leden-layout>
<div class="mx-auto overflow-auto">
	<div class="max-w-4xl mx-auto p-2 border-t-[1px] overflow-auto bg-white shadow">
        
        <!-- FAMILIE CREATE SECTION -->
        @empty($familie)
    	<h1 class="text-lg">Voeg Familie toe</h1>
    	<div  class="border-[1px] border-sky-200 border-box pl-2">

        	<form method="POST" action="{{ route('familie.store') }}">
        	@csrf
        
            <!-- Naam -->
            <div class="flex flex-row items-center">
            	<label class="basis-1/5">Familie Naam</label><input type="text" name="naam" value="{{ old('naam') }}"  placeholder="Naam Achternaam" required class="border-none focus:ring-0 shadow-xl my-1 focus:bg-sky-50">
            </div>
            
            <!-- Adres -->
            <div class="flex flex-row items-center">
            	<label class="basis-1/5">Familie Adres</label><input type="text" name="adres" value="{{ old('adres') }}"  placeholder="Straatnaam 00-A"required class="border-none focus:ring-0 shadow-xl my-1 focus:bg-sky-50">
            </div>
            
            <div class="grid grid-cols-5">
            	<div class="col-start-2 col-end-3">
            		@can('create', App\Models\Familie::class)
            		<button type="submit" class="hover:text-sky-500"><u>> Toevoegen </u></button>
            		@endcan
            	</div>
            </div>
        
            <div>
            	<x-input-error :messages="$errors->get('naam')" class="mt-2" />
            	<x-input-error :messages="$errors->get('adres')" class="mt-2" />
            </div>		
        	</form>
    	</div>
        	<hr class="border-[1px] border-gray-200 my-2">
		@endempty

       <!-- FAMILIE PROFIEL SECTION -->
        @isset($familie)		
    	<h1 class="text-2xl">Profiel Familie {{ $familie->naam }}</h1>
    	
    	<div class="text-lg">
    		<a href="{{ route('contributie.show', ['contributie' => $familie->id]) }}" class="hover:text-sky-500">Naar Contributies</a>
    	</div>
    	<br>
    	
    	<div class="border border-sky-200 p-2">
        	<div>
        		<!-- Aanpassen Familie profiel link -->
        		@can('update', $familie)
                <div><span>Profiel -</span>
                    <span class="text-sm" >
                    	<a href="{{ route('familie.edit', $familie) }}" class="hover:text-sky-500">Aanpassen</a>
                    </span> 
                </div>
                @endcan
            
            <!-- Show Familie profiel -->        
            <div>
                <!-- Naam -->
                <div class="flex flex-row items-center">
                	<label class="basis-1/5">Familie Naam</label>
                		<span class="py-2 pl-3">{{ $familie->naam }}</span> 
                </div>
                
                <!-- Adres -->
                <div class="flex flex-row items-center">
                	<label class="basis-1/5">Familie Adres</label>
                		<span class="py-2 pl-3"> {{ $familie->adres }}</span>
                </div>
            </div>
    
            </div>
    			<hr class="border-[1px] border-gray-200 my-2">
	
	
    	<!-- FAMILIELID SECTION -->
    	
    	<div class="mt-4">
    		<span class="text-2xl">Familieleden</span>
    	</div> 
	
    	<!-- FAMILIELID CREATE SECTION -->
    	@can('create', App\Models\Familielid::class)
    	<details><summary class="block inline-flex items-center px-4 py-2 mt-2 bg-sky-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-600 active:bg-sky-700">
    		+ Toevoegen</summary>
    	<div>
        	<form method="POST" action="{{ route('familielid.store') }}">
        	@csrf
        	<!-- Familie Id nummer -->
        	<input type="hidden" name="familie_id" value="{{ $familie->id }}" >
            
            <!-- Naam -->
            <div class="flex flex-row items-center">
            <label class="basis-1/5">Naam</label><input type="text" name="naam" value="{{ old('naam') }}" placeholder="Naam Achternaam" required class="border-none focus:ring-0 shadow-xl my-1 bg-sky-50">
            </div>
            
            <!-- Geboortedatum -->
            <div class="flex flex-row items-center">
            <label class="basis-1/5">Geboortedatum</label><input type="date" name="geboortedatum" value="{{ old('geboortedatum') }}" min="1922-01-01" max="2200-12-31" required class="border-none focus:ring-0 shadow-xl my-1 bg-sky-50">
            </div>			
            
            <div class="grid grid-cols-5">
            	<div class="col-start-2 col-end-3">
            		<button type="submit" class="hover:text-sky-500"><u>> Toevoegen</u></button>
            	</div>
            </div>

            <div>
            <x-input-error :messages="$errors->get('naam')" class="mt-2" />
            <x-input-error :messages="$errors->get('geboortedatum')" class="mt-2" />
            </div>
            </form>
        </div>
        </details>
        	
		@endcan
			<hr class="border-[1px] border-gray-200 my-2">
	
        <!-- FAMILIELID EDIT SECTION -->	
    	@isset($leden)
    	@foreach ($leden as $lid)
    	<div>
    	
    	<div>
    	<!-- Verwijder Familielid profiel link -->
    	@can('delete', $lid)
            <div>
            <span>Profiel -</span>
            	<span class="text-sm" >
            		<button  data-modal-toggle="popup-modal" id="{{$lid->id}}" class="hover:text-sky-500"> Verwijder{{ $lid->id }}</button>
            	</span>
            </div>
            @endcan
        	
            <form method="POST" action="{{ route('familielid.update', $lid) }}">
            @csrf
            @method('patch')
            <div>
            
                <div class="flex flex-row items-center">
                	<label class="basis-1/5">Naam</label>
                	@can('update', $lid)
                		<input type="text" name="naam" value="{{ $lid->naam }}" required class="border-none focus:ring-0 shadow-xl my-1 focus:bg-sky-50">
                	@else<span class="py-2 pl-3"> {{ $lid->naam }}</span>
					@endcan
                </div>
                
                <div class="flex flex-row items-center">
                <label class="basis-1/5">Geboortedatum</label>
                @can('update', $lid)
                	<input type="text" name="geboortedatum" value="{{ $lid->geboortedatum }}" placeholder="{{ $lid->geboortedatum }}" onfocusin="(this.type='date')" onfocusout="(this.type='text')" required class="border-none focus:ring-0 shadow-xl my-1 focus:bg-sky-50 focus:py-0 focus:h-10 focus:border-0">
                @else<span class="py-2 pl-3"> {{ $lid->geboortedatum }}</span>
				@endcan
                </div>
                
                <div class="flex flex-row items-center">
                <label class="basis-1/5">Soortlid</label><span class="py-2 pl-3">{{ $lid->soortlid }}</span>
                </div>
                
                <div class="grid grid-cols-5">
                	<div class="col-start-2 col-end-3">
                		@can('update', $lid)
                		<button type="submit" class="hover:text-sky-500"><u>> Wijzig</u></button>
                		@endcan
                	</div>
            	</div>
            </div>
            
            <div>
            	<x-input-error :messages="$errors->get('naam')" class="mt-2" />
            	<x-input-error :messages="$errors->get('geboortedatum')" class="mt-2" />
            </div>
            </form>
        </div>
        	<hr class="border-[1px] border-gray-200 my-2">
    	
		@endforeach
    	<br>
    	@endisset <!-- leden -->
        @endisset <!-- familie -->	
        </div>
	</div>
	
	<!-- delete confirmation modal -->
	
	<x-Delete-Form-modal :action="route('familielid.destroy', 'lid')"/>
	
</div>
</div>
</x-leden-layout>