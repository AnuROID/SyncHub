<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SyncHub | Collaborative Workspace</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .bg-mesh {
            background-color: #0a0a0a;
            background-image:
                radial-gradient(at 0% 0%, rgba(245, 48, 3, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(75, 6, 0, 0.2) 0px, transparent 50%);
        }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="bg-mesh text-white min-h-screen flex flex-col">

    <nav class="fixed top-0 w-full z-50 glass py-4 px-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-orange-600 rounded-lg flex items-center justify-center font-bold italic">S</div>
            <span class="text-xl font-bold tracking-tight">SyncHub</span>
        </div>

        <div class="flex gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-orange-500 transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium hover:text-orange-500 transition pt-2">Log in</a>
                <a href="{{ route('register') }}" class="bg-orange-600 hover:bg-orange-700 px-5 py-2 rounded-full text-sm font-bold transition">Get Started</a>
            @endauth
        </div>
    </nav>

    <main class="flex-grow pt-32 pb-20 px-6">
        <div class="max-w-6xl mx-auto text-center">
            <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest uppercase bg-orange-600/10 text-orange-500 border border-orange-500/20 rounded-full">
                Now in Private Beta
            </span>
            <h1 class="text-5xl lg:text-7xl font-bold mb-6 leading-tight">
                Where Teams <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Sync</span> <br> Their Best Work.
            </h1>
            <p class="text-gray-400 text-lg lg:text-xl max-w-2xl mx-auto mb-10">
                A seamless blend of real-time task management and collaborative sketching. Built for teams that move fast.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-black font-bold rounded-full hover:bg-gray-200 transition">Start Building for Free</a>
                <a href="#features" class="px-8 py-4 glass font-bold rounded-full hover:bg-white/5 transition text-gray-300">Explore Features</a>
            </div>
        </div>

        <div id="features" class="max-w-6xl mx-auto mt-32 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 glass rounded-3xl group hover:border-orange-500/50 transition">
                <div class="w-12 h-12 bg-orange-500/20 rounded-2xl flex items-center justify-center mb-6 text-orange-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">SyncTask Board</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Real-time task tracking with instant team synchronization and status management.</p>
            </div>

            <div class="p-8 glass rounded-3xl group hover:border-red-500/50 transition">
                <div class="w-12 h-12 bg-red-500/20 rounded-2xl flex items-center justify-center mb-6 text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">SyncSketch Canvas</h3>
                <p class="text-gray-400 text-sm leading-relaxed">A zero-latency whiteboard to brainstorm and draw with your team live on any project.</p>
            </div>

            <div class="p-8 glass rounded-3xl group hover:border-gray-400/50 transition">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mb-6 text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Instant Team Invites</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Securely share projects with teammates via email. Control who builds and who views.</p>
            </div>
        </div>
    </main>

    <footer class="glass mt-auto py-12 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-sm text-gray-500">
                &copy; {{ date('Y') }} SyncHub. Developed by <span class="text-gray-300">Anurag Sharma</span>.
            </div>
            <div class="flex gap-6 text-sm text-gray-400">
                <a href="https://github.com/AnuROID" class="hover:text-white transition">GitHub</a>
                <a href="#" class="hover:text-white transition">Documentation</a>
                <a href="#" class="hover:text-white transition">Privacy</a>
            </div>
        </div>
    </footer>

</body>
</html>
