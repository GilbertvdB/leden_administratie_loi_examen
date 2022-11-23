<div class="">
    	<div class="w-44 h-screen border bg-white float-left">
    	<h3 class="text-lg text-center py-1 pl-2">Menu</h3>
 		<a href="#" class="block hover:bg-gray-200 py-1 pl-2" >Contributies</a>
 		<a href="#" class="block hover:bg-gray-200 py-1 pl-2" >Families</a>
  		<a href="#" class="block hover:bg-gray-200 py-1 pl-2">Staffels</a>
  		<a href="#" class="block hover:bg-gray-200 py-1 pl-2">Contact</a>
  		<details open><summary class="cursor-pointer">Admin tables</summary>
  		<div class="pl-6">
  		<a href="{{ route('familie.create') }}" class="block hover:bg-gray-200 py-1 pl-2" >Familie</a>
 		<a href="{{ route('familielid.index') }}" class="block hover:bg-gray-200 py-1 pl-2" >Familielid</a>  <!-- Change to create -->
  		<a href="{{ route('soortlid.index') }}" class="block hover:bg-gray-200 py-1 pl-2">Soortlid</a>
  		<a href="{{ route('boekjaar.index') }}" class="block hover:bg-gray-200 py-1 pl-2">Boekjaar</a>
  		<a href="{{ route('contributie.create') }}" class="block hover:bg-gray-200 py-1 pl-2">Contributie</a>
		<a href="{{ route('familie.create') }}" class="block hover:bg-gray-200 py-1 pl-2" >Add/Edit Families</a>
		<a href="{{ route('contributie.index') }}" class="block hover:bg-gray-200 py-1 pl-2">Edit Contributies</a>
		@can('update', App\Models\User::class)
		<a href="{{ route('admin.index') }}" class="block hover:bg-gray-200 py-1 pl-2">Permissions</a>
		@endcan
		</div>
        </details>
        </div>
</div>
