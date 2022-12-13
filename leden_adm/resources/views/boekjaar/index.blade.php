<div>	
    <form id="boekjaar" action="{{ route('display_boekjaar') }}" method="POST">
    @csrf
    <label class="text-lg">Boekjaar</label>
    	<select name="jaar" class="border-0 shadow-sm hover:bg-sky-50" form="boekjaar" onchange="this.form.submit()">
            <option value="{{ $jaar}}" selected="selected" hidden="hidden">{{ $jaar }}</option>
            @foreach ($jaren_info as $jaar)
            <option value={{ $jaar }}>{{ $jaar }} </option>
            @endforeach
		</select>
	</form>
</div>