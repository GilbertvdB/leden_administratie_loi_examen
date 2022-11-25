<x-leden-layout>
    <div class="mx-auto overflow-auto">
	<div class="max-w-4xl mx-auto p-2 border bg-white">
	<h1 class="text-2xl"> Display Roles Panel </h1>
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
          
          <tr class=" border-b border-indigo-200 last:border-0 hover:bg-blue-50">
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
                    <x-dropdown-link :href="route('admin.edit', $user )">
                        {{ __('Wijzig') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('admin.destroy', $user) }}">
                        @csrf
                        @method('delete')
					<button class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-white focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" type="submit" onclick="return confirm('Doorgaan met profiel verwijderen?')">Verwijderen</button>
                    </form>
                </x-slot>
            </x-dropdown>
            <!--   <a class="btn btn-sm btn-link" href="/edit">Aanpassen</a><a class="btn btn-sm btn-link pl-2" href="/delte">Verwijderen</a> --></td>
          </tr>
          @endforeach
          </tbody>
		</table>
		
		</div>	
		
<button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="popup-modal">
  Toggle modal
</button>

<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 md:inset-0 h-modal md:h-full">
    <div class="relative w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Doorgaan met verwijderen?</h3>
                <button data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Ja, zeker!
                </button>
                <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Nee, annuleren</button>
            </div>
        </div>
    </div>
</div>

    </div>
    </div>
</x-leden-layout>