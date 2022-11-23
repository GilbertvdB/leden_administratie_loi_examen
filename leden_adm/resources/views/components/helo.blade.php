
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1>Testing passing request from controller to controller</h1>
        <p>Passing a collection to the controller method and test if it displays as a request.</p>
        <br>
	
	@if(auth()->user()->email == "admin@ledenadm.com")
	This data for Admin
	@endif
	<br>
	@if(auth()->user()->email == "penny@ledenadm.com")
	This data for Penny
	@endif
	<br>
	<ul>

    <li>

        <a href="www.a.com">Projects</a>

    </li>

    @can('isPenny')

    <li>

        <a href="www.b.com">Penningmeester</a>

    </li>

    @endcan

</ul>
<br>
<div>

test:  {{ $test }}
<br>lid id: 
<br>soortlid: 
<br>s table: 


</div

	

    </div>
