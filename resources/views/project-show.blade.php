<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ $project->title }} </h2>
            <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-900">&larr; Back to Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

<livewire:project-taskboard :project="$project" />                </div>
            </div>
        </div>
    </div>
</x-app-layout>
