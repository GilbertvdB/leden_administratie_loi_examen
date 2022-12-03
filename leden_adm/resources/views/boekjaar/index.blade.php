<div>
		
		{{ $info }} <!-- MAKE COMPONENT -->
		
        <form id="boekjaar" action="{{ route('jaar') }}" method="POST">
        @csrf
        <label>Boekjaar</label><select name="jaar" class="border-0 shadow-lg hover:bg-blue-50" form="boekjaar" onchange="this.form.submit()">
                <option value="{{ $jaar}}" selected="selected" hidden="hidden">{{ $jaar }}</option>
                @foreach ($info as $jaar)
                <option value={{ $jaar }}>{{ $jaar }} </option>
                @endforeach
				</select>
				</form>
		<!-- 		
		@if(session('jaar'))
    <div class="alert alert-success" role="alert">
        {{ session('jaar') }}
    </div>
	@endif  -->
</div>