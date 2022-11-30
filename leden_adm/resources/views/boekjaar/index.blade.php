<div>
		
		
		
        <form id="boekjaar" action="{{ route('jaar') }}" method="POST">
        @csrf
        <label>Boekjaar</label><select name="jaar" class="border-0 shadow-lg hover:bg-blue-50" form="boekjaar" onchange="this.form.submit()">
                <option value="{{ $jaar}}" selected="selected" hidden="hidden">{{ $jaar }}</option>
                <option value="2021">2021 </option>
                <option value="2022">2022</option>
				</select>
				</form>
		<!-- 		
		@if(session('jaar'))
    <div class="alert alert-success" role="alert">
        {{ session('jaar') }}
    </div>
	@endif  -->
</div>