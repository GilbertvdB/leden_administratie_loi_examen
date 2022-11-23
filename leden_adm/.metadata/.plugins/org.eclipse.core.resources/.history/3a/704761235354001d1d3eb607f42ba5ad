<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('adres.store') }}">
            @csrf
<!--             <textarea -->
<!--                 name="message" -->
<!--                 placeholder="{{ __('What\'s on your mind?') }}" -->
<!--                 class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" -->
<!--             >{{ old('message') }}</textarea> -->
			Adres: <input type="text" name="adres"><br>
            <x-input-error :messages="$errors->get('adres')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Add') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>