<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Chirp') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <!-- 
                    cortado de aqui y agregado a la navegacion para utilizarlo en varias ocaciones    
                    @if(session('status'))
                    <div class="bg-green-500">{{ session('status') }}</div>
                    @endif 

                    Para mostrar error
                    @dump($errors->get('message'))
                    -->

                    <form action="#" method="POST">
                        @csrf
                        <textarea name="message" class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50" id="" cols="30" rows="3" placeholder="{{ __('What\'s on your mind?') }}">{{ old('message', $chirp->message) }} </textarea>
                        <!-- La funcion old es para que no se borre lo que se habia escrito
                            A diferencia de un input  <input type="text" value="{{ old('name') }}">-->
                        <!-- FORMA BASITA DE MOSTRAR ERROR AHORA LO VAMOS A MOSTRAR UTILIZANDO LOS COMPONENETES x-input-error @error('message') {{ $message }} @enderror -->

                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <x-primary-button class="mt-4">{{ __('Chirp')}}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>