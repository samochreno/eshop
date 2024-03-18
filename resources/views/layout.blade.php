<!DOCTYPE html>
<html lang="sk" class="w-[100vw] h-[100dvh] m-0">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
        <title>{{ name() }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body class="fixed inset-0">
        <div id="app" class="absolute inset-0 flex flex-col">
            <div class="navbar fixed left-0 right-0 top-0 h-[--navbar-height] px-8 font-medium shadow-sm z-10 backdrop-blur-md">
                <nav class="float-left w-fit h-full flex-center">
                    <a
                        href="{{ route('home') }}"
                        class="navbar-logo align-middle mr-8 flex-center text-xl text-info"
                    >{{ name() }}</a>

                    <ul class="flex-center w-fit h-full">
                        <li class="navbar-button m-1 ml-0">
                            <a
                                href="{{ route('products') }}"
                                class="h-full flex-center"
                            >Catalog</a>
                        </li>
                        <li class="navbar-button m-1">
                            <a
                                href="{{ route('description') }}"
                                class="h-full flex-center"
                            >Description</a>
                        </li>
                        <li class="navbar-button m-1">
                            <a
                                href="{{ route('contact') }}"
                                class="h-full flex-center"
                            >Contact</a>
                        </li>
                    </ul>
                </nav>

                <div class="float-right w-fit h-full flex-center">
                    <a
                        href=""
                        class="navbar-button align-middle flex-center m-1"
                    >
                        <span class="material-symbols-rounded mr-2">shopping_cart</span>
                        <span>$0.00</span>
                    </a>

                    @if(auth()->check())
                        <a
                            href="{{ route('logout') }}"
                            class="navbar-button align-middle flex-center m-1 mr-0 hover:text-danger"
                        >
                            <span class="material-symbols-rounded mr-2">person</span>
                            <span>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="navbar-button align-middle flex-center m-1 mr-0"
                        >
                            <span class="material-symbols-rounded mr-2">person</span>
                            <span>Log in</span>
                        </a>
                    @endif
                </div>
            </div>

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
