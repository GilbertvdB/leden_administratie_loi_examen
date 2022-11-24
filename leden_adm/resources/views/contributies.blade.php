<x-leden-layout>
    <div class="max-w-4xl mx-auto p-2 border overflow-auto bg-white">
        <h1 class="text-2xl">Contributies Familie {{ $fam_naam }}</h1>
	<br>
	<br>
	<div class="pl-2"><a href="{{ route('familie.show', ['familie' => $fam_id]) }}">Naar Profiel</a></div>
<div class="flex flex-row">	
    <!-- DISPLAY INFO TABLE -->
    <div class="flex-none">
    
        <!--  <table class="table-auto border-separate border-spacing-2 border border-blue-200"> -->
        <table class="table-auto px-2 border-separate border-spacing-0 border border-blue-200">
            <thead>  
                <tr>
                  <th>Naam</th>
                  <th>Geboortedatum</th>
                  <th>Leeftijd</th>
                  <th>Soortlid</th>
                  <th>Bedrag</th>
                  <th>Boekjaar</th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($fam_leden as $lid)
            <form id="{{ $lid->naam }}" method="POST" action="{{ route('contributie.update', $fam_id) }}">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{ $lid->id }}">
            <input type="hidden" name="leeftijd" value="{{ $lid->leeftijd }}">
            <input type="hidden" name="familielid_id" value="{{ $lid->l_id }}">
              <tr class="hover:bg-blue-50">
                <td class="pr-2">{{ $lid->naam }}</td>
                <td class="pr-2">{{ $lid->geboortedatum }}</td>
                <td class="text-center pr-2">{{ $lid->leeftijd }}</td>
                <td class="pr-2"><label></label><select name="soortlid" class="border-0 shadow-lg hover:bg-blue-50" form="{{ $lid->naam }}">
                <option value="{{ $lid->soortlid }}" selected="selected" hidden="hidden">{{ $lid->soortlid }}</option>
                <option value="Jeugd">Jeugd </option>
                <option value="Aspirant">Aspirant</option>
                <option value="Junior">Junior</option>
                <option value="Senior">Senior</option>
                <option value="Oudere">Oudere</option>
        	</select></td>
                <td class="pr-2">@if($lid->bedrag)&euro;<input type="text" name="bedrag" value="{{ $lid->bedrag }}" class="border-0 w-12  shadow-lg pl-0 hover:bg-blue-50" >@endif</td>
                <td class="pr-2">2022</td>
                @can('update', App\Models\Contributie::class)<td><button type="submit"><u class="text-xs">> Wijzig </u></button></td>@endcan	
              </tr>
              </form>
            @endforeach
        </tbody>
        </table>
        <x-input-error :messages="$errors->get('soortlid')" class="mt-2" />
		<x-input-error :messages="$errors->get('bedrag')" class="mt-2" />
	</div> 
    <!-- Staffels info box -->
	<div class="shrink">
    	
    	<x-staffels-info />
	</div>
</div>

</div>
</x-leden-layout>