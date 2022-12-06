<x-leden-layout>
<div class="mx-auto overflow-auto drop-shadow">
	<div class="max-w-4xl mx-auto p-2 border-t-[1px] overflow-auto bg-white">
	<h1 class="text-lg">Rol aanpassen</h1>
	<br>
		<div class="max-w-2xl">
		<form name="roles" method="POST" action="{{ route('admin.update', $user) }}">
        @csrf
		@method('patch')
        <!-- Naam -->
        <div>
            <x-input-label for="name" :value="__('Name')" />

            <x-text-input id="naam" class="block mt-1 w-full" type="text" name="naam" value="{{ $user->name }}" readonly autofocus />

            <x-input-error :messages="$errors->get('naam')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" readonly/>

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
		
		<!-- Rol -->
        <div class="mt-4">
            <x-input-label for="rol" :value="__('Rol')" />
            	<div class="block mt-1 w-full">
				<input type="radio" id="admin" name="rol_id" value="1" class="text-sky-500 focus:ring-sky-500"> 
				<label for="admin">Admin</label>
				<input type="radio" id="voorzitter" name="rol_id" value="2" class="ml-8 text-sky-500 focus:ring-sky-500" > 
				<label for="voorzitter">Voorzitter</label>
				<input type="radio" id="secretaris" name="rol_id" value="3" class="ml-8 text-sky-500 focus:ring-sky-500" > 
				<label for="secretaris">Secretaris</label>
				<input type="radio" id="penningmeester" name="rol_id" value="4" class="ml-8 text-sky-500 focus:ring-sky-500" > 
				<label for="penningmeester">Penningmeester</label>
				<input type="radio" id="algemeen" name="rol_id" value="5" class="ml-8 text-sky-500 focus:ring-sky-500" > 
				<label for="algemeen">Algemeen</label>
				</div>
            <x-input-error :messages="$errors->get('rol_id')" class="mt-2" />
            <script> document.roles.rol_id.value='<?php echo $user->role_id ?>';
             </script>
        </div>
		
		
        <div class="flex items-center justify-start mt-4">

            <x-primary-button class="mt-4">
                {{ __('Wijzig') }}
            </x-primary-button>
            
            <x-back-button class="ml-1 mt-4" onclick="history.back()">
            	{{ __('Terug') }}
            </x-back-button>	
            
        </div>
        </form>
        </div>

    </div>
</div>
</x-leden-layout>