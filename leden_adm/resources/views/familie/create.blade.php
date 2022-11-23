<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('familie.store') }}">
            @csrf
            <h1> Enter details into Familie</h1>
                    <pre>
                    <div class="form-input"><label>Naam  </label> <input type="text" name="naam"></div>
		    <div class="form-input"><label>Adres </label> <input type="text" name="adres"></div>
                    </pre>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Submit') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>