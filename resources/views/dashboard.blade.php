<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-end"> <div>
                <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest mb-1">
                    Welcome back, {{ explode(' ', auth()->user()->name)[0] }}!
                </p>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    {{ __('Project Dashboard') }}
                </h2>
            </div>

            <div class="flex items-center space-x-6 pb-1">
                <div class="text-right hidden sm:block mr-4 border-r border-gray-800 pr-6">
                    <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('profile.edit') }}"
                       class="text-sm text-gray-400 hover:text-white transition font-medium">
                        {{ __('Profile') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white px-4 py-1.5 rounded-lg text-xs font-bold transition border border-red-500/20">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:project-dashboard />
        </div>
    </div>
</x-app-layout>
