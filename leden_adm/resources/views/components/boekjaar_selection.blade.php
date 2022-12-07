<div>
	<!-- Set default boekjaar -->
        @php($jaar = session('jaar'))
       	@empty($jaar)
       		@php( $jaar = date("Y"))
       	@endempty
	
    <form id="boekjaar" action="{{ route('jaar') }}" method="POST">
    @csrf
    <label class="text-lg">Boekjaar</label>
    	<select name="jaar" class="border-0 shadow-sm hover:bg-sky-50" form="boekjaar" onchange="this.form.submit()">
            <option value="{{ $jaar}}" selected="selected" hidden="hidden">{{ $jaar }}</option>
            @foreach ($jaren_info as $keuze_jaar)
            <option value={{ $jaar }}>{{ $keuze_jaar }} </option>
            @endforeach
		</select>
	</form>
</div>