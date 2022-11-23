<div class="border border-blue-200 p-2">
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
    <!--<h1> This is the component view using data from the component method</h1>
    <br>
    <p>This is the processed data using collections and details and summary hmtl tags</p>
    <br> -->
    
    <h1 class="font-bold leading-5 text-2xl">Leden Contributie</h1>
	<h2 class="mt-1 text-Gray-600 text-xl">Jaar 2022</h2>
	<br>
	<span class="font-bold px-2">Familie</span><span class="font-bold float-right">Contributie</span>
    <hr class="mt-2 border-indigo-200">
    @php($fam = $allLedens->pluck('lastname')->unique()->values())
    
    @foreach ($fam as $famname)
    	@php($last = $allLedens->where('lastname', '==', $famname))
    	@php($sum = $last->sum('contribution'))
    	@php($adres = $last->value('adres'))
    	<div>
        
        <details class="border-b-[1px] border-indigo-200 open:shadow-[-3px_-1px_0_0_rgba(199,210,254,1)]" >
        		<summary class="bg-white relative cursor-pointer py-2 px-2 list-none hover:bg-blue-50">
        			<div class="flex items-center">
        			
        			<h3 flex flex-col>
    					<strong class="font-bold">{{ $famname}}</strong>
    					<br>
  					<!--  <small class="text-Gray-600 text-sm">Adres: {{ $adres }}</small> -->	
  					</h3>
  						<span class=" ml-auto font-bold focus:outline-none" >&euro;{{ $sum }}</span>
      				</div>
      			</summary>
      			
      				<ul class="pl-2">
                	@foreach ($last as $leden)
                	<li>{{ $leden->name }} {{ $leden->lastname }}<span class="float-right px-2">${{ $leden->contribution }}</span></li>
                	@endforeach
                	</ul>
    		</details>
    	</div>
    @endforeach

</div>
<br>
