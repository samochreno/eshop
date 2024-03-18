@foreach($errors->all() as $error)
    {{ $error }}
@endforeach

@php
$pages = [
    [
        'name' => 'Catalog',
        'href' => route('products'),
        'isActive' => Route::is('products'),
    ],
    [
        'name' => 'Description',
        'href' => route('description'),
        'isActive' => Route::is('description'),
    ],
    [
        'name' => 'Contact',
        'href' => route('contact'),
        'isActive' => Route::is('contact'),
    ],
];

$user = auth()->check() ? (new \App\Http\Resources\UserResource(auth()->user())) : null;
@endphp

<!DOCTYPE html>
<html lang="sk" class="w-[100vw] h-[100dvh] m-0">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
        <title>{{ name() }}</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body class="fixed inset-0">
        <div id="app" class="bg-white absolute inset-0 flex flex-col">
            <navbar
                :user="{{ $user ? json_encode($user) : 'null' }}"
                home-href="{{ route('home') }}"
                name="{{ name() }}"
                :pages="{{ json_encode($pages) }}"
            >
            </navbar>

            <main class="h-[100dvh] pt-[--navbar-height] overflow-y-scroll">
                @yield('content')
            </main>
        </div>
        <script>
document.body.addEventListener('mousedown', (e) => {
    if (e.target.classList.contains('button')) {
        const rect = e.target.getBoundingClientRect();

        const x = e.clientX - rect.x;
        const y = e.clientY - rect.y;

        const ripple = document.createElement('div');
        e.target.appendChild(ripple);

        ripple.classList.add('button-ripple');
        ripple.style.left = x + 'px';
        ripple.style.top  = y + 'px';

        setTimeout(() => { ripple.remove(); }, 1000);
    }
});
        </script>
    </body>
</html>
