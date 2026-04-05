<?php

use Livewire\Component;
use App\Models\User;

new class extends Component
{
    public $title='';
    public $description='';
    public $invite_email='';
    public function createProject(){
        $this->validate([
            'title'=>'required|min:3',

        ]);
        $project=auth()->user()->ownedProjects()->create([
            'title'=>$this->title,
            'description'=>$this->description,
        ]);
        if($this->invite_email){
            $user=User::where('email',$this->invite_email)->first();
            if($user){
                $project->members()->attach($user->id);
            }
        }
        $this->reset(['title','description','invite_email']);
    }
     public function with(){
            return[
                'projects'=>auth()->user()->ownedProjects->merge(auth()->user()->projects),
            ];
        }

};
?>

<div class="p-6">
    <div class="bg-gray-900 p-6 rounded-xl border border-gray-800 shadow-xl mb-8">
        <h2 class="text-lg font-bold mb-4 text-white">Create New Project Card</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" wire:model="title" placeholder="Project Title (e.g. Hospital API)"
                   class="bg-gray-800 border-gray-700 text-white rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-500">

            <input type="email" wire:model="invite_email" placeholder="Invite Teammate Email"
                   class="bg-gray-800 border-gray-700 text-white rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-500">

            <div class="md:col-span-2">
                <textarea wire:model="description" placeholder="Short description..."
                          class="w-full bg-gray-800 border-gray-700 text-white rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-500"></textarea>
            </div>

            <div class="md:col-span-2">
                <button wire:click="createProject"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg transition shadow-lg shadow-indigo-500/20">
                    + Add Card to Dashboard
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($projects as $project)
            <div class="bg-gray-900 p-5 rounded-xl border border-gray-800 border-t-4 border-t-indigo-500 hover:border-gray-700 transition shadow-lg group">
                <div class="flex justify-between items-start mb-3">
                    <h3 class="font-bold text-lg text-white group-hover:text-indigo-400 transition">{{ $project->title }}</h3>

                    <span class="text-xs px-2 py-1 rounded-full {{ $project->user_id == auth()->id() ? 'bg-green-900/30 text-green-400' : 'bg-blue-900/30 text-blue-400' }}">
                        {{ $project->user_id == auth()->id() ? 'Owner' : 'Member' }}
                    </span>
                </div>

                <p class="text-sm text-gray-400 mb-4 line-clamp-2">{{ $project->description }}</p>

                <div class="pt-4 border-t border-gray-800 flex justify-between items-center">
                    <span class="text-xs text-gray-500">By: <span class="text-gray-300 font-medium">{{ $project->owner->name }}</span></span>

                    <a href="{{ route('projects.show', $project->id) }}"
                       class="text-indigo-400 text-sm font-semibold hover:text-indigo-300 hover:underline transition">
                        View Tasks &rarr;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
