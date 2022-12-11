<x-leden-layout>
<div class="max-w-4xl mx-auto p-2 border-t-[1px] overflow-auto bg-white shadow">
	<h1>Tailwing Modal Example</h1>
	<br>
	@php($user = 'test')
	@php($list = collect([1,2,3]))
	{{ $list }}
	
	
	<div>
		<table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($info as $user)
          <tr>
            <td class="pl-2">{{ $user->id}}</td>
            <td class="pl-2">{{ $user->naam}}</td>
            <td class="pl-2">
            <button  data-modal-toggle="popup-modal" id="{{$user->id}}">Button{{ $user->id }}</button>
            
            </td>
          </tr>
          @endforeach
        </tbody>
		</table>
	
	
	</div>
	
    <!-- delete confirmation modal -->
	<x-Delete-Form-modal :action="route('modal.destroy', 'id')"/>
	






</div>
</x-leden-layout>
