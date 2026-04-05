<?php



use Livewire\Component;

use App\Models\Task;

use App\Models\Project;

new class extends Component {

    public Project $project;

    public $newTaskTitle = '';
    public $inviteEmail='';



    public function addTask()

    {

        $this->validate([

            'newTaskTitle' => 'required|min:6'

        ]);

        $this->project->tasks()->create([

            'title' => $this->newTaskTitle,

            'status' => 'todo',

        ]);

        $this->reset('newTaskTitle');

    }

    public function updateStatus($taskId, $newStatus)

    {

        $task = Task::find($taskId);

        $task->update([

            'status' => $newStatus,

            'last_updated_by' => auth()->id(),

        ]);



    }

    public function deleteTask($taskId)

    {

        Task::destroy($taskId);



    }



    public function with()

    {

        return [

            'task' => $this->project->tasks()

                ->with('editor')

                ->latest()

                ->get(),

        ];

    }
    public function inviteMember(){
        $this->validate([
            'inviteEmail'=>'required|exists:users,email'],
            ['inviteEmail.exists'=>'That user does not have a Syncboard account yet!']
        );
        $user=App\Models\User::where('email',$this->invite_email)->first();
        $this->project->members()->syncWithoutDetaching([$user->id]);
        $this->reset('inviteEmail');
        session()->flash('message','Member invite successfully!');
    }
};

?>



<div class="p-6 space-y-6">
    <div class="flex gap-2 bg-gray-900 p-4 rounded-xl border border-gray-800 shadow-lg">
        <input type="text" wire:model="newTaskTitle" placeholder="What needs to be done?"
               class="flex-1 bg-gray-800 border-gray-700 text-white rounded-lg focus:ring-indigo-500 placeholder-gray-500">
        <button wire:click="addTask" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl font-bold transition shadow-lg shadow-indigo-500/20">
            Add Task
        </button>
    </div>

    <div class="bg-gray-900/50 p-4 rounded-xl border border-indigo-900/30">
        <h3 class="text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2">Invite a Teammate</h3>
        <div class="flex gap-2">
            <input type="email" wire:model="inviteEmail" placeholder="friend@example.com"
                   class="flex-1 bg-gray-800 border-gray-700 text-sm text-white rounded-lg focus:ring-indigo-500 placeholder-gray-500">

            <button wire:click="inviteMember"
                    class="bg-indigo-600/20 hover:bg-indigo-600 text-indigo-400 hover:text-white border border-indigo-600/50 px-4 py-2 rounded-lg text-sm font-bold transition">
                Invite
            </button>
        </div>

        @error('inviteEmail') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        @if (session()->has('message'))
            <span class="text-green-500 text-xs mt-1 block">{{ session('message') }}</span>
        @endif
    </div>

    <div class="space-y-3">
        <h3 class="text-sm font-semibold text-gray-500 px-1">Active Tasks</h3>
        @forelse($task as $item)
            <div class="p-4 bg-gray-900 border border-gray-800 rounded-xl flex justify-between items-center hover:border-gray-700 transition group">
                <div>
                    <h4 class="font-bold text-gray-100 group-hover:text-white {{ $item->status == 'done' ? 'line-through text-gray-500' : '' }}">
                        {{ $item->title }}
                    </h4>
                    <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-tighter">
                        Last Edit: <span class="text-gray-400">{{ $item->lastEditor->name ?? 'System' }}</span>
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <select wire:change="updateStatus({{ $item->id }}, $event.target.value)"
                            class="bg-gray-800 border-gray-700 text-gray-300 text-xs rounded-lg focus:ring-indigo-500">
                        <option value="todo" {{ $item->status == 'todo' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ $item->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ $item->status == 'done' ? 'selected' : '' }}>Done</option>
                    </select>

                    <button wire:click="deleteTask({{ $item->id }})" class="text-gray-600 hover:text-red-500 transition p-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-10 border-2 border-dashed border-gray-800 rounded-2xl">
                <p class="text-gray-600">The board is clear. Time to plan something big!</p>
            </div>
        @endforelse
    </div>
</div>
