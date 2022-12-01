<x-leden-layout>
    <div class="max-w-4xl mx-auto p-2 border overflow-auto bg-white sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('contributie.store') }}">
            @csrf
            <h1> Enter details into Contributie</h1>
                    <pre>
		    <div class="form-input"><label>Familie Lid Id </label> <input type="text" name="familielid_id"></div>
                    <div class="form-input"><label>Soort Lid      </label> <input type="text" name="soortlid"></div>
		    <div class="form-input"><label>Leeftijd       </label> <input type="text" name="leeftijd"></div>
                    <div class="form-input"><label>Bedrag         </label> <input type="text" name="bedrag"></div>
		    </pre>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Submit') }}</x-primary-button>
        </form>
    </div>
</x-leden-layout>