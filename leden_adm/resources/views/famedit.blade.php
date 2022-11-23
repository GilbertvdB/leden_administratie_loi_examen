<x-leden-layout>
<div class="mx-auto overflow-auto">
	<div class="max-w-4xl mx-auto p-2 border overflow-auto bg-white">
@isset($fam)	
	<details>
		<summary>Collection data </summary>
	<h1>Familie data:  
	{{ $fam }}</h1><br>
	@isset($leden)
	Familielid data:
	{{ $leden }}
	@endisset
	
	@php($delete = $fam->id)
	<br><h1>DELETE FAMILIE ID = {{ $delete }}</h1>
	</details>
@endisset
	<br>

@empty($fam)
	<!-- FAMILIE CREATE SECTION -->
	<h1>Voeg Familie toe</h1>
	<div  class="border-[1px] border-gray-600 border-box pl-2">

<form method="POST" action="{{ route('familie.store') }}">
@csrf
<div><pre>
<label>Familie Naam 	</label><input type="text" name="naam" value="{{ old('naam') }}" required class="border-none shadow-lg my-1">
<label>Familie Adres	</label><input type="text" name="adres" value="{{ old('adres') }}" required class="border-none shadow-lg my-1">			
				@can('create', App\Models\Familie::class)<button type="submit"><u>> Toevoegen </u></button>@endcan
</div></pre>
<x-input-error :messages="$errors->get('naam')" class="mt-2" />
<x-input-error :messages="$errors->get('adres')" class="mt-2" />	
</form>
	</div>
	<hr class="border-[1px] border-gray-600 my-2">
@endempty

@isset($fam)		
	<!-- FAMILIE EDIT SECTION -->
	<h1 class="text-2xl">Profiel Familie {{ $fam->naam }}</h1>
	<br>
	<br>
	<div class="pl-2"><a href="{{ route('contributie.show', ['contributie' => $fam->id]) }}">Naar Contributies</a></div>
	<div class="border border-blue-200 p-2">
	<div>
		<!-- VERWIJDER PROFILE -->
		@can('delete', $fam)
    	<form method="POST" action="{{ route('familie.destroy', $fam) }}">
            @csrf
            @method('delete')
            <div><span class="float-left">Profiel - </span>
            <span class="pl-2 text-sm" ><button type="submit" onclick="return confirm('Doorgaan met profiel verwijderen?')">Verwijderen</button></span></div>
        </form>
        @endcan
        
<!-- WIJZIG PROFIEL -->        
<form method="POST" action="{{ route('familie.update', $fam) }}">
@csrf
@method('patch')
<div>
<pre>
<label>Familie Naam 	</label>@can('update', $fam)<input type="text" name="naam" value="{{ $fam->naam }}" required class="border-none shadow-lg my-1 focus:bg-blue-50">@else {{ $fam->naam }} @endcan

<label>Familie Adres	</label>@can('update', $fam)<input type="text" name="adres" value="{{ $fam->adres }}" required class="border-none shadow-lg my-1  focus:bg-blue-50">@else {{ $fam->adres }} @endcan

@can('update', $fam)				<button type="submit"><u>> Wijzig </u></button> @endcan
</div></pre>
<x-input-error :messages="$errors->get('naam')" class="mt-2" />
<x-input-error :messages="$errors->get('adres')" class="mt-2" />
</form>
	</div>
	<hr class="border-[1px] border-gray-200 my-2">
	
	@can('create', App\Models\Familielid::class)
	<!-- FAMILIELID CREATE SECTION -->
	<details><summary class="cursor-pointer list-none">Familieleden - Toevoegen</summary>
	<div >
	<form method="POST" action="{{ route('familielid.store') }}">
	@csrf
	<div>
	<input type="hidden" name="familie_id" value="{{ $fam->id }}" >
	<pre>
<label>Naam 			</label><input type="text" name="naam" value="{{ old('naam') }}" required class="border-none shadow-lg my-1 bg-blue-50">
<label>Geboortedatum 	</label><input type="date" name="geboortedatum" value="{{ old('geboortedatum') }}" min="1922-01-01" max="2200-12-31" required class="border-none shadow-lg my-1 bg-blue-50">
			<button type="submit"><u>> Toevoegen </u></button>
</div></pre>
<x-input-error :messages="$errors->get('naam')" class="mt-2" />
<x-input-error :messages="$errors->get('geboortedatum')" class="mt-2" />
</form>
	</div>
	</details>
	<hr class="border-[1px] border-gray-200 my-2">
	@endcan
	
	
    <!-- FAMILIELID EDIT SECTION -->	
	@isset($leden)
	@foreach ($leden as $lid)
	<div>
	@can('delete', $lid)
	<div>
    	<form method="POST" action="{{ route('familielid.destroy', $lid) }}">
            @csrf
            @method('delete')
            <div><span class="float-left">Profiel - </span>
            <span class="pl-2 text-sm" ><button type="submit" onclick="return confirm('Doorgaan met profiel verwijderen?')">Verwijderen</button></span></div>
            <!--  <x-dropdown-link :href="route('familielid.destroy', $lid)" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Verwijder Profiel') }}
            </x-dropdown-link> -->
        </form>
	</div>
	@endcan
	
<form method="POST" action="{{ route('familielid.update', $lid) }}">
@csrf
@method('patch')
<div>
<pre>
<label>Naam 			</label><input type="text" name="naam" value="{{ $lid->naam }}" required class="border-none shadow-lg my-1 focus:bg-blue-50">
<label>Geboortedatum 	</label><input type="text" name="geboortedatum" value="{{ $lid->geboortedatum }}" placeholder="{{ $lid->geboortedatum }}" onfocusin="(this.type='date')" onfocusout="(this.type='text')" required class="border-none shadow-lg my-1 focus:bg-blue-50 focus:py-0 focus:h-10 focus:border-0">
<label>Soortlid 		</label>{{ $lid->soortlid }}
@can('update', $lid)				<button type="submit"><u>> Wijzig </u></button> @endcan
</div></pre>
<x-input-error :messages="$errors->get('naam')" class="mt-2" />
<x-input-error :messages="$errors->get('geboortedatum')" class="mt-2" />
</form>
	</div>
	<hr class="border-[1px] border-gray-200 my-2">
	
	@endforeach
	<br>
	@endisset
@endisset	
</div>
</div>
</x-leden-layout>