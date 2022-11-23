<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    
    Familie met ID nr: {{ $familie }} is toegevoegd.
    <br>

    <h3>Lid Toevoegen</h3>
    
    @isset($record)
    <p>{{ $record}} is toegevoegd!</p>
    @endisset
    <br>
    @include('familielid.create')
    </div>
</x-app-layout>