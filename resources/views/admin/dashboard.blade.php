
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORGE PC | Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#101010] text-white">

    <main class="mx-auto max-w-7xl px-6 py-12">

        <p class="text-sm uppercase tracking-[0.3em] text-red-500">
            FORGE PC / Administration
        </p>

        <h1 class="mt-5 text-4xl font-bold">
            Welcome back,
            {{ auth()->user()->name }}
        </h1>

        <p class="mt-3 text-gray-400">
            Your administrator authentication is working.
        </p>

        <div class="mt-10 rounded-xl border border-white/10 bg-white/5 p-6">
            <p class="text-sm text-gray-400">Authenticated account</p>
            <p class="mt-2">{{ auth()->user()->email }}</p>

            <p class="mt-5 text-sm text-gray-400">Assigned role</p>
            <p class="mt-2">Administrator</p>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="mt-8">
            @csrf

            <button
                type="submit"
                class="rounded-lg bg-red-600 px-6 py-3 font-semibold hover:bg-red-700"
            >
                Sign Out
            </button>
        </form>

    </main>

</body>
</html>
