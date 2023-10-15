@extends('template')
@section('contenido')


<x-guest-layout>
    <x-auth-card>
        <img src="img/money-bag.gif" alt="" style="width: 30%; margin-left:35%">

        <form method="POST" action="{{ route('registrar_vendedor') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre del Vendedor')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="telefono" :value="__('Telefono')" />

                <x-text-input id="telefono" class="block mt-1 w-full" type="tel" name="telefono" :value="old('telefono')" required />

                
            </div>
            <div class="mt-4">
                <x-input-label for="direccion" :value="__('Direccion')" />

                <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')" required />

                
            </div>

            <div class="mt-4">
                <x-input-label for="foto" :value="__('Logo')" />

                <x-text-input id="foto" class="block mt-1 w-full" type="file" name="foto" :value="old('foto')"  />

                
            </div>
           
            <div class="mt-4">
                <x-input-label  :value="__('Metodos de pago que acepta')" />
                
                <div class="form-check form-switch" style=" display:inline">
                    <label class="form-check-label" for="qvapay">Qvapay</label>
                    <input id="qvapay"  class="form-check-input" type="checkbox" name="qvapay"  value='qvapay' style="margin-left: 10px">
                    
                    <label class="form-check-label" for="enzonacup" style="margin-left: 35px">Enzona CUP</label>
                    <input id="enzonacup" class="form-check-input" type="checkbox" name="enzonacup" checked value='enzonacup' style="margin-left: 10px" >
                    
                    <label class="form-check-label" for="enzonausd" style="margin-left:35px">Enzona USD</label>
                    <input id="enzonausd" class="form-check-input" type="checkbox" name="enzonausd"  value='enzonausd' style="margin-left: 10px" >
                  </div> 
                
                

                
            </div>
            
       
            <div class="mt-4">
                <x-input-label for="descripcion" :value="__('Descripcion')" />

                <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>

                
            </div>
          
            <div class="flex items-center justify-end mt-4">
               

                <x-primary-button class="ml-4">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>
        
    </x-auth-card>
</x-guest-layout>
  
@endsection