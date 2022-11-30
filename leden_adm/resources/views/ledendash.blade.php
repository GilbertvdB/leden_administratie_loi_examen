<x-leden-layout>
	<!-- content -->
    <div class="py-0">
        <div class="max-w-4xl mx-auto p-2 bg-white overflow-hidden border-t-[1px] border-gray-200 shadow-sm">
                <div>
                    Welcome! You're logged in! Yes working!
                    Jaar {{ $jaar }}
		<br><br>
		
		<!-- LEDEN INFO BOX RENAME -->
		<x-famdisplay message="Helo" :info="$info" />

		</div>
        </div>
    </div>
</x-leden-layout>
