<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
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

                    <form action="{{ route('chirps.store') }}" method="POST">
                        @csrf
                        <textarea name="message"
                            class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            id="" cols="30" rows="3"
                            placeholder="{{ __('What\'s on your mind?') }}">{{ old('message') }} </textarea>
                        <!-- La funcion old es para que no se borre lo que se habia escrito
                            A diferencia de un input  <input type="text" value="{{ old('name') }}">-->
                        <!-- FORMA BASITA DE MOSTRAR ERROR AHORA LO VAMOS A MOSTRAR UTILIZANDO LOS COMPONENETES x-input-error @error('message') {{ $message }} @enderror -->

                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <x-primary-button class="mt-4">{{ __('Chirp')}}</x-primary-button>
                    </form>
                </div>
            </div>

            <!-- @dump($chirps); -->

            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                @foreach($chirps as $chirp)

                <div class="p-6 flex space-x-2">
                    <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" fill="none" stroke="currentColor"
                        stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z">
                        </path>
                    </svg>

                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800 dark:text-gray-200">{{ $chirp->user->name}}</span>
                                <small
                                    class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                <!-- Se puede crear un un IF o en este caso se crearon con un unless que hace lo contratio a un IF y se utiliza un eq
                            y se leeria de la siguiente manera "Almenos que las fechas sean iguales cuentrasme este texto"-->

                                @unless($chirp->created_at->eq($chirp->updated_at))
                                <small class="text-sm text-gray-600 dark:text-gray-400"> &middot;
                                    {{ __('edited') }}</small>
                                @endunless
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{ $chirp->message }}</p>
                    </div>
                    <!-- <a href="{{ route('chirps.edit', $chirp) }}">{{ __('Edit Chirp')}}</a> -->

                    @if(auth()->user()->is($chirp->user))
                    <x-dropdown>
                        <x-slot name="trigger">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>

                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                {{ __('Edit Chirp')}}
                            </x-dropdown-link>

                        </x-slot>
                    </x-dropdown>
                    @endif


                </div>

                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>