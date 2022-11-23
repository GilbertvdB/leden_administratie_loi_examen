<html>
    <head>
    <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>App Name - Leden Adm @yield('title')</title>
    </head>
    <body class="container mx-auto border border-gray-200">
    	<x-header>     
    		<x-slot:title>
        		Leden Administratie
   	 		</x-slot>
     </x-header>
    	
	<div class="sidebar">
    	<div class="w-1/5 border border-gray-200 float-left">
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
  		<a href="{{ route('contributie.index') }}" class="block hover:bg-gray-200 py-1 pl-2">Contributie</a>
        </div>
        </details>
        </div>
	</div>
	
	
        <div class="content border border-gray w-4/5 float-right">
		  <div class="searchbox"> Searh Box Input Form</div>
			<br>
		  <!-- LEDEN INFO BOX RENAME -->
		  <x-famdisplay />
		  
		  
		                      
		  
		<br>
          <div class="test grid grid-cols-2">
            <div class="">  Families  <div class="float-right">Contributies</div></div>
            <div class="pl-2">Column</div>
            <div class="pl-2">01</div>
            <div class="pl-2">02</div>
            <div class="pl-2">03</div>
            <div class="pl-2">04</div>
          </div>
          
          <br>
     	</div>
     </div>   
	</div>

        
     <div class="footer clear-both">
       <div class="p-4 border border-gray-200">
          <h3 class="font-semibold text-center text-4xl text-gray-800 leading-tight" >Footer</h3>
       </div>
     </div>
    
    </body>
</html>
