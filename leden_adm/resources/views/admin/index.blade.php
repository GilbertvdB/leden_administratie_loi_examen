<x-leden-layout>
    <div class="mx-auto overflow-auto border-t-[1px] drop-shadow">
	<div class="max-w-4xl mx-auto p-4 bg-white">
	   <!-- Title -->
		<h1 class="font-bold leading-5 text-2xl">Gebruikers </h1>
		<br>
		
		<div>
		<details><summary>Collection data</summary>
		{{ $data}}
		</details>
		</div>
		<br>
		
		<!--  <div id="crudTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row hidden"><div class="col-sm-6"></div><div class="col-sm-6 d-print-none"></div></div><div class="row"><div class="col-sm-12"> -->
        <div class="border border-indigo-200 rounded mb-20">
        <table class="min-w-full">
          <thead class="border-b border-indigo-200 text-left">
          <tr class="bg-zinc-100">
            <th class="p-2">Naam</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acties</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($data as $user)
          
          <tr class=" border-b border-indigo-200 last:border-0 hover:bg-indigo-100">
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
                    <x-dropdown-link :href="route('admin.edit', $user )" class="hover:text-indigo-600">
                        {{ __('Wijzig') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('admin.destroy', $user) }}">
                        @csrf
                        @method('delete')

					<button class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-white hover:text-indigo-600 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" type="submit" onclick="return confirm('Doorgaan met profiel verwijderen?')">Verwijderen</button>
                    </form>
                </x-slot>
            </x-dropdown>
            <!--   <a class="btn btn-sm btn-link" href="/edit">Aanpassen</a><a class="btn btn-sm btn-link pl-2" href="/delte">Verwijderen</a> --></td>
          </tr>
          @endforeach
          </tbody>
		</table>
		
		</div>	
		

    </div>
    </div>
</x-leden-layout>