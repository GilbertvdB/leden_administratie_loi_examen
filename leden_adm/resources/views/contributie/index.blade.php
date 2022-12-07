<x-leden-layout>
    <div class="max-w-4xl mx-auto p-2 border overflow-auto">
 	Contributies
 	<br>
 	
 	{{ $info}}
 	
 	@foreach($info as $contrib)
 		{{ $contrib }}
 	@endforeach
 	
 	<br>{{ $info->links()}}
    </div>
</x-leden-layout>