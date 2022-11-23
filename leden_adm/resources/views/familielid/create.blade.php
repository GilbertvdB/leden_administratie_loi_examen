
    <div>
        <form method="POST" action="{{ route('familielid.store') }}">
            @csrf
            <h1> Voeg familie lid toe!</h1>
                    <pre>
                    <div class="form-input"><label>Naam           </label> <input type="text" name="naam"></div>
		    <div class="form-input"><label>Geboortedatum  </label> <input type="text" name="geboortedatum"></div>
		    <!-- make hidden -->
		    <div class="form-input"><label>Familie ID     </label> <input type="text" name="familie" value={{ $familie }}></div>
		    <div class="form-input"><label>Soort Lid ID   </label> <input list="soort" name="soortlid"><datalist id="soort">
            <option value=Jeugd />
            <option value=Aspirant />
            <option value=Junior />
            <option value=Senior />
            <option value=Oudere />
        </datalist></div>
		    
                    </pre>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Submit') }}</x-primary-button>
        </form>
    </div>
