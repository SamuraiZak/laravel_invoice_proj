<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        >
        <title>Stonks</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

    </head>

    <body>

        <header>
            <nav class="flex justify-between">
                <a href="{{ route('show.dashboard') }}">
                    <h1>$tonks</h1>
                </a>

                <div class="flex items-center gap-4">
                    @guest
                        <a
                            href="{{ route('show.login') }}"
                            class="btn"
                        >Login</a>
                        <a
                            href="{{ route('show.register') }}"
                            class="btn"
                        >Register</a>
                    @endguest

                    @auth
                        <span class="border-r-2 pr-2">
                            Hi there, {{ Auth::user()->name }}
                        </span>

                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                            class="m-0"
                        >
                            @csrf
                            <button class="btn">Logout</button>
                        </form>
                    @endauth
                </div>

            </nav>
        </header>

        <main class="container">
            {{ $slot }}
        </main>

    </body>

</html>
