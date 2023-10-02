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



                    <form action="{{ route('chirps.store') }}" method="post" class="bg-transparent"
                        enctype="multipart/form-data">
                        @csrf
                        <textarea name="message" id="message"
                            class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 dark:focus:ring-indigo-200 ocus:ring-opacity-50"
                            placeholder="{{ __('What´s on your mind?') }}">{{ old('message') }}</textarea>
                        @error('message')
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        @enderror
                        <x-primary-button class="mt-4">
                            Chirp
                        </x-primary-button>

                    </form>



                </div>
                <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                    @foreach ($chirps as $chirp)
                        <div class="p-6 flex space-x-2">
                            <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" fill="none"
                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z">
                                </path>
                            </svg>

                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="text-gray-800 dark:text-gray-200">{{ $chirp->user->name }} </span>
                                        <small
                                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $chirp->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{ $chirp->message }}</p>
                            </div>

                            @if (auth()->user()->is($chirp->user))
                                <x-dropdown>
                                    <x-slot name='trigger'>
                                        <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm8 1a1 1 0 100-2 1 1 0 000 2zm-3-1a1 1 0 11-2 0 1 1 0 012 0zm7 1a1 1 0 100-2 1 1 0 000 2z"
                                                clip-rule="evenodd" />
                                        </svg>


                                    </x-slot>
                                    <x-slot name='content'>
                                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                            {{ __('Edit Chirp') }}
                                        </x-dropdown-link>
                                        
                                        <form action="{{ route('chirps.destroy', $chirp) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                             <x-dropdown-link :href="route('chirps.destroy', $chirp)"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete Chirp') }}
                                            </x-dropdown-link> 
                                            
                                        </form>


                                        </form>
                                    </x-slot>

                                </x-dropdown>
                            @endif

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>