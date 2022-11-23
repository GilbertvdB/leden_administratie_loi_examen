<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('soortlid.store') }}">
            @csrf
            <h1> Enter details into Soortlid</h1>
                    <pre>
                    <div class="form-input"><label>Familie lid Id </label> <input type="text" name="familielid_id"></div>
		    <div class="form-input"><label>Omschrijving   </label> <input type="text" name="omschrijving"></div>
                    </pre>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Submit') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>