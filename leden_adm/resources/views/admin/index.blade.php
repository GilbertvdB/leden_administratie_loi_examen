<x-leden-layout>
    <div class="mx-auto overflow-auto border-t-[1px] drop-shadow">
		<div class="max-w-4xl mx-auto p-4 bg-white">
		
		<!-- Title -->
		<h1 class="font-bold  text-2xl">Gebruikers </h1>
		<br>
		
        <div class="border border-sky-200 rounded mb-20">
        <table class="min-w-full">
          <thead class="border-b border-sky-200 text-left">
          <tr class="bg-zinc-100">
            <th class="p-2">Naam</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acties</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($gebruikers as $user)
          <tr class=" border-b border-sky-200 last:border-0 hover:bg-sky-100">
            <td class="p-2">{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->naam }}</td>
            <td>
            <x-dropdown>
                <x-slot name="trigger">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('admin.edit', $user )" class="hover:text-sky-500">
                        {{ __('Wijzig') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('admin.destroy', $user) }}">
                        @csrf
                        @method('delete')

					<button class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-white hover:text-sky-500 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" type="submit" onclick="return confirm('Doorgaan met profiel verwijderen?')">
						Verwijderen</button>
                    </form>
                </x-slot>
            </x-dropdown>
            </td>
          </tr>
          @endforeach
          </tbody>
		</table>
		</div>	
    </div>
    </div>
</x-leden-layout>