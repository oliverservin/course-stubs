<!-- Billboard -->
<div class="relative h-[56.25vw]">
    <video
        poster=""
        class="h-[56.25vw] w-full object-cover brightness-[60%] transition duration-500"
        autoplay
        muted
        loop
        src=""
    ></video>
    <div class="absolute top-[30%] ml-4 md:top-[40%] md:ml-16">
        <p class="h-full w-[50%] text-xl font-bold text-white drop-shadow-xl md:text-5xl lg:text-6xl">Título</p>
        <p class="mt-3 w-[90%] text-[8px] text-white drop-shadow-xl md:mt-8 md:w-[80%] md:text-lg lg:w-[50%]">
            Descripción
        </p>
        <!-- Reproducir película -->
    </div>
</div>

<!-- Reproducir película -->
<div class="mt-3 flex flex-row items-center gap-3 md:mt-4">
    <a
        href=""
        class="flex w-auto flex-row items-center rounded-md bg-white px-2 py-1 text-xs font-semibold text-gray-950 transition hover:bg-neutral-300 md:px-4 md:py-2 lg:text-lg"
    >
        <svg
            class="mr-1 size-4 text-black md:size-7"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            fill="currentColor"
        >
            <path
                d="M3 3.732a1.5 1.5 0 0 1 2.305-1.265l6.706 4.267a1.5 1.5 0 0 1 0 2.531l-6.706 4.268A1.5 1.5 0 0 1 3 12.267V3.732Z"
            />
        </svg>
        Reproducir
    </a>
</div>

<!-- Ver película -->
<div class="h-screen w-screen bg-black">
    <nav class="fixed z-10 flex w-full flex-row items-center gap-8 bg-black bg-opacity-70 p-4">
        <a href="">
            <svg
                class="w-4 cursor-pointer text-white transition hover:opacity-80 md:w-10"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
                    clip-rule="evenodd"
                />
            </svg>
        </a>
        <p class="text-1xl font-bold text-white md:text-3xl">
            <span class="font-light">Viendo:</span>
            Título de la película
        </p>
    </nav>
    <video class="h-full w-full" autoplay controls src=""></video>
</div>

<!-- Lista de películas -->
<div class="mt-4 space-y-8 px-4 md:px-12">
    <div>
        <p class="mb-4 text-base font-semibold text-white md:text-xl lg:text-2xl">En tendencia</p>
        <div class="grid grid-cols-4 gap-2">
            <!-- Movie card -->
            <div class="group relative h-[12vw] bg-gray-900">
                <a href="">
                    <img
                        src=""
                        alt=""
                        class="duration h-[12vw] w-full rounded-md object-cover shadow-xl transition delay-300 group-hover:opacity-90 sm:group-hover:opacity-0"
                    />
                </a>
                <div
                    class="invisible absolute top-0 z-10 w-full scale-0 opacity-0 transition delay-300 duration-200 group-hover:-translate-y-[6vw] group-hover:translate-x-[2vw] group-hover:scale-110 group-hover:opacity-100 sm:visible"
                >
                    <a href="">
                        <img
                            src=""
                            alt=""
                            class="duration h-[12vw] w-full rounded-t-md object-cover shadow-xl transition"
                        />
                    </a>
                    <div class="absolute z-10 w-full rounded-b-md bg-gray-800 p-2 shadow-md transition lg:p-4">
                        <div class="flex flex-row items-center gap-3">
                            <a
                                href=""
                                class="flex h-6 w-6 items-center justify-center rounded-full bg-white transition hover:bg-neutral-300 lg:h-10 lg:w-10"
                            >
                                <svg
                                    class="ml-1 w-4 text-black lg:w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M3 3.732a1.5 1.5 0 0 1 2.305-1.265l6.706 4.267a1.5 1.5 0 0 1 0 2.531l-6.706 4.268A1.5 1.5 0 0 1 3 12.267V3.732Z"
                                    />
                                </svg>
                            </a>
                            <!-- Agregar a favoritos -->
                            <!-- Más información -->
                        </div>
                        <p class="mt-4 font-semibold text-green-400">
                            Nuevo
                            <span class="text-white">2023</span>
                        </p>
                        <div class="mt-4 flex flex-row items-center gap-2">
                            <p class="text-[10px] text-white lg:text-sm">Duración</p>
                        </div>
                        <div class="mt-4 flex flex-row items-center gap-2 text-[8px] text-white lg:text-sm">
                            <p>Género</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- obtener peliculas en volt -->
@php
    $getMovies = fn () => $this->movies = Movie::all();

    state(['movies' => $getMovies]);
@endphp

<!-- Agregar a favoritos -->
@php
    $toggleFavorite = function (Movie $movie) {
        Auth::user()->favoriteMovies()->toggle($movie);
    };
@endphp

<!-- Botón para agregar a favoritos -->
<button
    class="group/item flex h-6 w-6 items-center justify-center rounded-full border-2 border-white transition hover:border-neutral-300 lg:h-10 lg:w-10"
>
    <!-- Quitar de favoritos -->
    <svg
        class="w-4 text-white group-hover/item:text-neutral-300 lg:w-6"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
    </svg>
    <!-- Agregar a favoritos -->
    <svg
        class="w-4 text-white group-hover/item:text-neutral-300 lg:w-6"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
    </svg>
</button>

<!-- Mostrar información de la película -->
@php
    $show = function (Movie $movie) {
        $this->showing = $movie;
    };

    $disableShowing = function () {
        $this->showing = null;
    };
@endphp

<!-- Botón de más información -->
<button
    @click=""
    class="group/item ml-auto flex h-6 w-6 cursor-pointer items-center justify-center rounded-full border-2 border-white transition hover:border-neutral-300 lg:h-10 lg:w-10"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="size-4 text-white group-hover/item:text-neutral-300 lg:size-6"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
    </svg>
</button>

<!-- Modal de más información -->
<div @keydown.window.escape="">
    <div x-cloak x-transition.opacity x-show="showModal" class="fixed inset-0 z-50 bg-black/50"></div>
    <div x-cloak x-transition x-show="showModal" class="fixed inset-0 z-50 grid place-content-center">
        <div class="max-w-3xl overflow-hidden rounded-md bg-gray-900">
            <!-- if showing -->
            <div class="relative h-96">
                <video poster="" autoplay muted loop src="" class="h-full w-full object-cover brightness-[60%]"></video>
                <button
                    @click=""
                    class="absolute right-3 top-3 flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-black bg-opacity-70"
                >
                    <svg
                        class="size-6 text-white"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="absolute bottom-[10%] left-10">
                    <p class="mb-8 h-full text-3xl font-bold text-white md:text-4xl lg:text-5xl">Título</p>
                    <div class="flex flex-row items-center gap-4">
                        <a
                            href="{{ route('watch.movie', ['movie' => $movie->id]) }}"
                            class="flex h-6 w-6 items-center justify-center rounded-full bg-white transition hover:bg-neutral-300 lg:h-10 lg:w-10"
                        >
                            <svg
                                class="ml-1 w-4 text-black lg:w-6"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                            >
                                <path
                                    d="M3 3.732a1.5 1.5 0 0 1 2.305-1.265l6.706 4.267a1.5 1.5 0 0 1 0 2.531l-6.706 4.268A1.5 1.5 0 0 1 3 12.267V3.732Z"
                                />
                            </svg>
                        </a>
                        <button
                            wire:click=""
                            class="group/item flex h-6 w-6 items-center justify-center rounded-full border-2 border-white transition hover:border-neutral-300 lg:h-10 lg:w-10"
                        >
                            @if ($movie->favoritedBy->contains(Auth::user()))
                                <svg
                                    class="w-4 text-white group-hover/item:text-neutral-300 lg:w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            @else
                                <svg
                                    class="w-4 text-white group-hover/item:text-neutral-300 lg:w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            @endif
                        </button>
                    </div>
                </div>
            </div>
            <div class="px-12 py-8">
                <div class="mb-8 flex flex-row items-center gap-2">
                    <p class="text-lg font-semibold text-green-400">Nuevo</p>
                    <p class="text-lg text-white">Duración</p>
                    <p class="text-lg text-white">Género</p>
                </div>
                <p class="text-lg text-white">Descripción</p>
            </div>
        </div>
    </div>
</div>

<!-- Navbar -->
<nav
    class="fixed z-40 w-full"
    x-data="{
        showBackground: false,
        handleScroll() {
            this.showBackground = window.scrollY >= 66
        },
    }"
    @scroll.window="handleScroll"
>
    <div
        class="flex flex-row items-center px-4 py-6 transition duration-500 md:px-16"
        :class="{ 'bg-gray-900 bg-opacity-90': showBackground }"
    >
        <img src="/images/logo.png" class="h-4 lg:h-7" alt="Logo" />
        <div class="ml-8 hidden flex-row gap-7 lg:flex">
            @php
                $navbarItems = [
                    ['Inicio', route('dashboard'), true],
                    ['Series de TV', '#', false],
                    ['Películas', '#', false],
                    ['Novedades', '#', false],
                    ['Mi lista', '#', false],
                    ['Buscar por idioma', '#', false],
                ];
            @endphp

            @foreach ($navbarItems as [$label, $url, $active])
                <a
                    @class([
                        'transition hover:text-gray-300',
                        'text-white' => $active,
                        'text-gray-200' => ! $active,
                    ])
                    href="{{ $url }}"
                >
                    {{ $label }}
                </a>
            @endforeach
        </div>
        <div x-data="{ isActive: false }" class="relative ml-8 flex flex-row items-center gap-2 lg:hidden">
            <button x-on:click="isActive = !isActive" class="relative flex flex-row items-center gap-2">
                <div class="text-sm text-white">Explorar</div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-4 fill-white text-white transition"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </button>

            <div
                class="absolute left-0 top-8 flex w-56 flex-col rounded border-2 border-gray-800 bg-black py-5"
                role="menu"
                x-cloak
                x-transition
                x-show="isActive"
                x-on:click.away="isActive = false"
                x-on:keydown.escape.window="isActive = false"
            >
                <div class="flex flex-col gap-4">
                    @php
                        $navbarItems = [
                            ['Inicio', route('dashboard')],
                            ['Series de TV', '#'],
                            ['Películas', '#'],
                            ['Novedades', '#'],
                            ['Mi lista', '#'],
                            ['Buscar por idioma', '#'],
                        ];
                    @endphp

                    @foreach ($navbarItems as [$label, $url])
                        <a href="{{ $url }}" class="px-3 text-center text-white hover:underline">{{ $label }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="ml-auto flex flex-row items-center gap-7">
            <button class="text-gray-200 transition hover:text-gray-300">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                    />
                </svg>
            </button>
            <button class="text-gray-200 transition hover:text-gray-300">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                    />
                </svg>
            </button>
            <div x-data="{ isActive: false }" class="relative">
                <button x-on:click="isActive = !isActive" class="relative flex flex-row items-center gap-2">
                    <div class="h-6 w-6 overflow-hidden rounded-md lg:h-10 lg:w-10">
                        <img src="/images/default-blue.png" alt="" />
                    </div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-4 fill-white text-white transition"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>

                <div
                    class="absolute right-0 top-14 flex w-56 flex-col rounded border-2 border-gray-800 bg-black py-5"
                    role="menu"
                    x-cloak
                    x-transition
                    x-show="isActive"
                    x-on:click.away="isActive = false"
                    x-on:keydown.escape.window="isActive = false"
                >
                    <div class="flex flex-col gap-3">
                        <div class="group/item flex w-full flex-row items-center gap-3 px-3">
                            <img
                                class="w-8 rounded-md"
                                src="/images/default-blue.png"
                                alt="{{ auth()->user()->name }}"
                            />
                            <a href="#" class="text-sm text-white group-hover/item:underline">
                                {{ auth()->user()->name }}
                            </a>
                        </div>
                    </div>
                    <hr class="my-4 h-px border-0 bg-gray-800" />
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button class="w-full px-3 text-center text-sm text-white hover:underline">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- login page -->
<x-layouts.dashboard>
    <div
        class="relative h-full w-full bg-cover bg-fixed bg-center bg-no-repeat"
        style="background-image: url('/images/hero.jpg')"
    >
        <div class="h-full w-full bg-black lg:bg-opacity-50">
            <nav class="px-12 py-5">
                <img src="/images/logo.png" class="h-12" alt="Logo" />
            </nav>
            <div class="flex justify-center">
                <div class="mt-2 w-full self-center rounded-md bg-black bg-opacity-70 px-16 py-16 lg:w-2/5 lg:max-w-md">
                    <h2 class="mb-8 text-4xl font-semibold text-white">Iniciar Sesión</h2>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <x-input
                                id="email"
                                label="Email"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input
                                id="password"
                                label="Contraseña"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                            />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <button class="mt-10 w-full rounded-md bg-red-600 py-3 text-white transition hover:bg-red-700">
                            Iniciar Sesión
                        </button>

                        <p class="mt-12 text-neutral-500">
                            ¿Es la primera vez que usas Netflix?
                            <a href="{{ route('register') }}" class="ml-1 text-white hover:underline">
                                Crear una cuenta.
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>

<!-- input component -->

@props(['label'])

<div class="relative">
    <input
        placeholder=" "
        {{ $attributes->merge(['class' => 'border-0 text-base invalid:border-b-1 peer block w-full appearance-none rounded-md bg-neutral-700 px-6 pb-1 pt-6 text-white focus:outline-none focus:ring-0']) }}
    />
    <label
        for="{{ $attributes->get('id') }}"
        class="absolute left-6 top-4 z-10 origin-[0] -translate-y-3 scale-75 transform text-base text-gray-400 duration-150 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-3 peer-focus:scale-75"
    >
        {{ $label }}
    </label>
</div>

<!-- register page -->
<x-layouts.dashboard>
    <div
        class="relative h-full w-full bg-cover bg-fixed bg-center bg-no-repeat"
        style="background-image: url('/images/hero.jpg')"
    >
        <div class="h-full w-full bg-black lg:bg-opacity-50">
            <nav class="px-12 py-5">
                <img src="/images/logo.png" class="h-12" alt="Logo" />
            </nav>
            <div class="flex justify-center">
                <div class="mt-2 w-full self-center rounded-md bg-black bg-opacity-70 px-16 py-16 lg:w-2/5 lg:max-w-md">
                    <h2 class="mb-8 text-4xl font-semibold text-white">Registrarse</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input
                                id="name"
                                label="Nombre"
                                class="mt-1 block w-full"
                                type="text"
                                name="name"
                                :value="old('name')"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input
                                id="email"
                                label="Email"
                                class="mt-1 block w-full"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autocomplete="username"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input
                                id="password"
                                label="Contraseña"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                            />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input
                                id="password_confirmation"
                                label="Confirmar contraseña"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                            />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button class="mt-10 w-full rounded-md bg-red-600 py-3 text-white transition hover:bg-red-700">
                            Registrarse
                        </button>

                        <p class="mt-12 text-neutral-500">
                            ¿Ya tienes una cuenta?
                            <a href="{{ route('login') }}" class="ml-1 text-white hover:underline">Iniciar Sesión.</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>

<!-- profiles page -->
<x-layouts.dashboard>
    <div class="flex h-full items-center justify-center">
        <div class="flex flex-col">
            <h1 class="text-center text-3xl text-white md:text-6xl">¿Quién está viendo?</h1>
            <div class="mt-10 flex items-center justify-center gap-8">
                <a href="{{ route('dashboard') }}">
                    <div class="group mx-auto w-44 flex-row">
                        <div
                            class="flex h-44 w-44 items-center justify-center overflow-hidden rounded-md border-2 border-transparent group-hover:cursor-pointer group-hover:border-white"
                        >
                            <img class="h-max w-max object-contain" src="/images/default-blue.png" alt="" />
                        </div>
                        <div class="mt-4 text-center text-2xl text-gray-400 group-hover:text-white">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
