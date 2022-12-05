<x-leden-layout>
<div class="mx-auto overflow-auto">
	<div class="max-w-4xl mx-auto p-2 border-t-[1px] overflow-auto bg-white drop-shadow">
        
        <!-- FAMILIE CREATE SECTION -->
        @empty($familie)
    	<h1 class="text-lg">Voeg Familie toe</h1>
    	<div  class="border-[1px] border-indigo-200 border-box pl-2">

        	<form method="POST" action="{{ route('familie.store') }}">
        	@csrf
        
            <!-- Naam -->
            <div class="flex flex-row items-center">
            	<label class="basis-1/5">Familie Naam</label><input type="text" name="naam" value="{{ old('naam') }}"  required class="border-none shadow-xl my-1">
            </div>
            
            <!-- Adres -->
            <div class="flex flex-row items-center">
            	<label class="basis-1/5">Familie Adres</label><input type="text" name="adres" value="{{ old('adres') }}"  required class="border-none shadow-xl my-1">
            </div>
            
            <div class="grid grid-cols-5">
            	<div class="col-start-2 col-end-3">
            		@can('create', App\Models\Familie::class)
            		<button type="submit" class="hover:text-indigo-500"><u>> Toevoegen </u></button>
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

       <!-- FAMILIE EDIT SECTION -->
        @isset($familie)		
    	<h1 class="text-2xl">Profiel Familie {{ $familie->naam }}</h1>
    	
    	<div class="text-lg">
    		<a href="{{ route('contributie.show', ['contributie' => $familie->id]) }}" class="hover:text-indigo-500">Naar Contributies</a>
    	</div>
    	<br>
    	
    	<div class="border border-indigo-200 p-2">
    	<div>
    		<!-- Verwijder Familie profiel link -->
    		@can('delete', $familie)
        	<form method="POST" action="{{ route('familie.destroy', $familie) }}">
            @csrf
            @method('delete')
            <div><span>Profiel - </span>
                <span class="text-sm" >
                	<button type="submit" class="hover:text-indigo-500" onclick="return confirm('Doorgaan met profiel verwijderen?')">Verwijderen</button>
                </span>
            </div>
            </form>
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
        		<input type="text" name="naam" value="{{ $familie->naam }}" required class="border-none shadow-xl my-1 focus:bg-indigo-50">
        	@else<span class="py-2 pl-3">{{ $familie->naam }}</span> 
        		@endcan
        </div>
        
        <!-- Adres -->
        <div class="flex flex-row items-center">
        	<label class="basis-1/5">Familie Adres</label>
        	@can('update', $familie)
        		<input type="text" name="adres" value="{{ $familie->adres }}" required class="border-none shadow-xl my-1 focus:bg-indigo-50">
        	@else<span class="py-2 pl-3"> {{ $familie->adres }}</span>
				@endcan
        </div>
    
        <div class="grid grid-cols-5">
        	<div class="col-start-2 col-end-3">
        		@can('update', $familie)
        		<button type="submit" class="hover:text-indigo-500"><u>> Wijzig</u></button>
        		@endcan
        	</div>
        </div>
        
        </div>
        
        <div>
        	<x-input-error :messages="$errors->get('naam')" class="mt-2" />
        	<x-input-error :messages="$errors->get('adres')" class="mt-2" />
        </div>
        </form>
        </div>
			<hr class="border-[1px] border-gray-200 my-2">
	
	
    	<!-- FAMILIELID SECTION -->
    	
    	<div class="mt-4">
    		<span class="text-2xl">Familieleden</span>
    	</div> 
	
    	<!-- FAMILIELID CREATE SECTION -->
    	@can('create', App\Models\Familielid::class)
    	<details><summary class="block inline-flex items-center px-4 py-2 mt-2 bg-indigo-300 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-400 active:bg-indigo-500">
    		+ Toevoegen</summary>
    	<div>
        	<form method="POST" action="{{ route('familielid.store') }}">
        	@csrf
        	<!-- Familie Id nummer -->
        	<input type="hidden" name="familie_id" value="{{ $familie->id }}" >
            
            <!-- Naam -->
            <div class="flex flex-row items-center">
            <label class="basis-1/5">Naam</label><input type="text" name="naam" value="{{ old('naam') }}" required class="border-none shadow-xl my-1 bg-indigo-50">
            </div>
            
            <!-- Geboortedatum -->
            <div class="flex flex-row items-center">
            <label class="basis-1/5">Geboortedatum</label><input type="date" name="geboortedatum" value="{{ old('geboortedatum') }}" min="1922-01-01" max="2200-12-31" required class="border-none shadow-xl my-1 bg-indigo-50">
            </div>			
            
            <div class="grid grid-cols-5">
            	<div class="col-start-2 col-end-3">
            		<button type="submit" class="hover:text-indigo-500"><u>> Toevoegen</u></button>
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
        	<form method="POST" action="{{ route('familielid.destroy', $lid) }}">
            @csrf
            @method('delete')
            <div><span>Profiel -</span>
            	<span class="text-sm" >
            		<button type="submit" class="hover:text-indigo-500" onclick="return confirm('Doorgaan met profiel verwijderen?')">Verwijderen</button>
            	</span>
            </div>
            </form>
            @endcan
        	
            <form method="POST" action="{{ route('familielid.update', $lid) }}">
            @csrf
            @method('patch')
            <div>
            
                <div class="flex flex-row items-center">
                	<label class="basis-1/5">Naam</label>
                	@can('update', $lid)
                		<input type="text" name="naam" value="{{ $lid->naam }}" required class="border-none shadow-xl my-1 focus:bg-indigo-50">
                	@else<span class="py-2 pl-3"> {{ $lid->naam }}</span>
					@endcan
                </div>
                
                <div class="flex flex-row items-center">
                <label class="basis-1/5">Geboortedatum</label>
                @can('update', $lid)
                	<input type="text" name="geboortedatum" value="{{ $lid->geboortedatum }}" placeholder="{{ $lid->geboortedatum }}" onfocusin="(this.type='date')" onfocusout="(this.type='text')" required class="border-none shadow-xl my-1 focus:bg-indigo-50 focus:py-0 focus:h-10 focus:border-0">
                @else<span class="py-2 pl-3"> {{ $lid->geboortedatum }}</span>
				@endcan
                </div>
                
                <div class="flex flex-row items-center">
                <label class="basis-1/5">Soortlid</label><span class="py-2 pl-3">{{ $lid->soortlid }}</span>
                </div>
                
                <div class="grid grid-cols-5">
                	<div class="col-start-2 col-end-3">
                		@can('update', $lid)
                		<button type="submit" class="hover:text-indigo-500"><u>> Wijzig</u></button>
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
</div>
</div>
</x-leden-layout>