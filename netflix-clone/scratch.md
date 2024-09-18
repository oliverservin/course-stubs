## Barra de navegación

- [ ] Crear componente volt `navbar`

    ```php filename=resources/views/livewire/navbar.blade.php
    <nav
        class="fixed z-40 w-full"
    >
        <div
            class="flex flex-row items-center px-4 py-6 transition duration-500 md:px-16"
        >
            Logo
            <div class="ml-8 hidden flex-row gap-7 lg:flex">
                Elementos de navegación
            </div>
            <div class="ml-auto flex flex-row items-center gap-7">
                Navegación secundaria
            </div>
        </div>
    </nav>
    ```
- [ ] Crear slot `header` en el componente layout de `dashboard`
- [ ] Agregar componente `navbar` en la página `dashboard` en el slot `header`
- [ ] Agregar logo

    ```php filename=resources/views/livewire/navbar.blade.php
    <img src="/images/logo.png" class="h-4 lg:h-7" alt="Logo" />
    ```

    Assets en `https://github.com/oliverservin/course-stubs/tree/main/netflix-clone`
- [ ] Agregar elementos de navegación
    - [ ] Agregar markup para elementos de navegación
        ```php filename=resources/views/livewire/navbar.blade.php
        <a
            @class([
                'transition hover:text-gray-300',
                'text-white', // activo
                'text-gray-200', // no activo
            ])
            href="#"
        >
            Elemento
        </a>
        ```
    - [ ] Agregar elementos de navegación
        ```php filename=resources/views/livewire/navbar.blade.php
        $navbarItems = [
            ['Inicio', route('dashboard'), true],
            ['Series de TV', '#', false],
            ['Películas', '#', false],
            ['Novedades', '#', false],
            ['Mi lista', '#', false],
            ['Buscar por idioma', '#', false],
        ];
        ```
    - [ ] Navegación móvil
        - [ ] Crear dropdown
            ```php filename=resources/views/livewire/navbar.blade.php
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
                    Contenido del dropdown
                </div>
            </div>
            ```
        - [ ] Agregar contenido al dropdown
            ```php filename=resources/views/livewire/navbar.blade.php
            <div class="flex flex-col gap-4">
                @foreach ($navbarItems as [$label, $url])
                    <a href="{{ $url }}" class="px-3 text-center text-white hover:underline">{{ $label }}</a>
                @endforeach
            </div>
            ```
- [ ] Agregar botones de buscar y de notificaciones
    ```php filename=resources/views/livewire/navbar.blade.php
    <button type="button" class="text-gray-200 transition hover:text-gray-300">
        <!-- icono de buscar -->
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
    <button type="button" class="text-gray-200 transition hover:text-gray-300">
        <!-- icono de notificaciones -->
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
    ```
- [ ] Agregar dropdown de cuenta
    ```php filename=resources/views/livewire/navbar.blade.php
    <div x-data="{ isActive: false }" class="relative">
        <button x-on:click="isActive = !isActive" type="button" class="relative flex flex-row items-center gap-2">
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
            Contenido del dropdown
        </div>
    </div>
    ```
    - [ ] Agregar contenido al dropdown
        ```php filename=resources/views/livewire/navbar.blade.php
        <div class="flex flex-col gap-3">
            <div class="group/item flex w-full flex-row items-center gap-3 px-3">
                <img
                    class="w-8 rounded-md"
                    src="/images/default-blue.png"
                    alt="{{ auth()->user()->name }}"
                />
                <a href="#" class="text-sm text-white group-hover/item:underline">
                    Nombre de usuario
                </a>
            </div>
        </div>
        <hr class="my-4 h-px border-0 bg-gray-800" />
        <button type="button" class="w-full px-3 text-center text-sm text-white hover:underline">
            Cerrar sesión
        </button>
        ```
    - [ ] Agregar acción para cerrar sesión
        ```php filename=resources/views/livewire/navbar.blade.php
        $logout = function () {
            Auth::guard('web')->logout();

            Session::invalidate();
            Session::regenerateToken();

            $this->redirect(route('dashboard'), navigate: true);
        };
        ```
- [ ] Cambiar el color de fondo de la barra de navegación

    ```php filename=resources/views/livewire/navbar.blade.php
    <nav
        x-data="{
            showBackground: false,
            handleScroll() {
                this.showBackground = window.scrollY >= 66
            },
        }"
        @scroll.window="handleScroll"
    >
        <div
            :class="{ 'bg-zinc-900 bg-opacity-90': showBackground }"
        ></div>
    </nav>
    ```

## Modal de más información

- [ ] Agregar botón de más información al billboard

    ```php
    <button
        class="flex w-auto flex-row items-center rounded-md bg-white bg-opacity-30 px-2 py-1 text-xs font-semibold text-white transition hover:bg-opacity-20 md:px-4 md:py-2 lg:text-lg"
    >
        <!-- icono de información -->
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="mr-1 w-4 md:w-7"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"
            />
        </svg>

        Más información
    </button>
    ```
- [ ] Agregar modal

    ```php
    <div>
        <div x-cloak x-transition.opacity class="fixed inset-0 z-50 bg-black/50"></div>
        <div x-cloak x-transition class="fixed inset-0 z-50 grid place-content-center">
            <div class="max-w-3xl overflow-hidden rounded-md bg-gray-900">
                Información de la película
            </div>
        </div>
    </div>
    ```

    - [ ] Inicializar componente para abrir modal
        ```html
        <div x-data="{ showModal: false }">
            <button @click="showModal = true">Mostrar modal</button>
        </div>
        ```
    - [ ] Cerrar modal con escape
        ```html
        <div @keydown.window.escape="showModal = false">
            <div x-show="showModal">
                <div x-on:click="showModal = false">
                    <button @click="showModal = true">Mostrar modal</button>
                </div>
            </div>
        </div>
        ```
- [ ] Agregar más información al modal

    ```php
    <div>
        <div class="relative h-96">
            <video
                poster=""
                autoplay
                muted
                loop
                src=""
                class="h-full w-full object-cover brightness-[60%]"
            ></video>
            <button
                class="absolute right-3 top-3 flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-black bg-opacity-70"
            >
                <!-- icono de cerrar -->
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
                <p class="mb-8 h-full text-3xl font-bold text-white md:text-4xl lg:text-5xl">
                    Título de la película
                </p>
                <div class="flex flex-row items-center gap-4">
                    <a
                        href="#"
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
    ```
- [ ] Añadir a favoritos desde el modal

    - [ ] Agregar botón de añadir a favoritos
        ```php
        <button
            wire:click="toggleFavorite({{ $billboard->id }})"
            class="group/item flex h-6 w-6 items-center justify-center rounded-full border-2 border-white transition hover:border-neutral-300 lg:h-10 lg:w-10"
        >
            @if ($billboard->favoritedBy->contains(Auth::user()))
                <svg
                    class="w-4 text-white group-hover/item:text-neutral-300 lg:w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m4.5 12.75 6 6 9-13.5"
                    />
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
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>
            @endif
        </button>
        ```
    - [ ] Agregar acción para añadir a favoritos
        ```php
        $toggleFavorite = function (Movie $movie) {
            Auth::user()->favoriteMovies()->toggle($movie);

            $this->dispatch('toggled-favorite');
        };
        ```
- [ ] Agregar botón de modal al componente `movie-list`

    ```php filename=resources/views/livewire/movie-list.blade.php
    <button
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
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m19.5 8.25-7.5 7.5-7.5-7.5"
            />
        </svg>
    </button>
    ```
    - [ ] Inicializar el componente para abrir modal
        ```html
        <div x-data="{ showModal: false }">
            <button @click="showModal = true">Mostrar modal</button>
        </div>
        ```
    - [ ] Agregar modal de más información
        Lo podemos copiar del billboard


## Marcar favoritos

- [ ] Crear migracion para la tabla `favorites`

  ```php filename=database/migrations/create_favorites_table.php
  $table->foreignId('user_id')->constrained()->onDelete('cascade');
  $table->foreignId('movie_id')->constrained()->onDelete('cascade');
  ```
- [ ] Crear relación de `favoriteMovies` en el modelo `User`

  ```php filename=app/Models/User.php
  public function favoriteMovies()
  {
      return $this->belongsToMany(Movie::class, 'favorites');
  }
  ```
- [ ] Crear relación de `favoritedBy` en el modelo `Movie`

  ```php filename=app/Models/Movie.php
  public function favoritedBy()
  {
      return $this->belongsToMany(User::class, 'favorites');
  }
  ```
- [ ] Anadir botón de favorito en el componente `movie-list`

  ```php filename=resources/views/livewire/movie-list.blade.php
  <button
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
              <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="m4.5 12.75 6 6 9-13.5"
              />
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
              <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 4.5v15m7.5-7.5h-15"
              />
          </svg>
      @endif
  </button>
  ```
- [ ] Crear accion para favoritar una película en el componente `movie-list`

  ```php filename=resources/views/livewire/movie-list.blade.php
    on(['toggled-favorite' => $getMovies]);

    $toggleFavorite = function (Movie $movie) {
        Auth::user()->favoriteMovies()->toggle($movie);

        $this->dispatch('toggled-favorite');
    };
  ```

## Listar películas

- [ ] Crear componente volt `movie-list`

  ```php filename=resources/views/livewire/movie-list.blade.php
  <div class="mt-4 space-y-8 px-4 md:px-12">
      <p class="mb-4 text-base font-semibold text-white md:text-xl lg:text-2xl">En tendencia</p>
      <div class="grid grid-cols-4 gap-2">
          <div class="group relative h-[12vw] bg-zinc-900">
              <a href="#">
                  <img
                      src="https://upload.wikimedia.org/wikipedia/commons/7/70/Big.Buck.Bunny.-.Opening.Screen.png"
                      alt="Big Buck Bunny"
                      class="duration h-[12vw] w-full rounded-md object-cover shadow-xl transition delay-300 group-hover:opacity-90 sm:group-hover:opacity-0"
                  />
              </a>
              <div
                  class="invisible absolute top-0 z-10 w-full scale-0 opacity-0 transition delay-300 duration-200 group-hover:-translate-y-[6vw] group-hover:translate-x-[2vw] group-hover:scale-110 group-hover:opacity-100 sm:visible"
              >
                  <a href="#">
                      <img
                          src="https://upload.wikimedia.org/wikipedia/commons/7/70/Big.Buck.Bunny.-.Opening.Screen.png"
                          alt="Big Buck Bunny"
                          class="duration h-[12vw] w-full rounded-t-md object-cover shadow-xl transition"
                      />
                  </a>
                  <div class="absolute z-10 w-full rounded-b-md bg-zinc-800 p-2 shadow-md transition lg:p-4">
                      <div class="flex flex-row items-center gap-3">
                          <a
                              href="#"
                              class="flex h-6 w-6 items-center justify-center rounded-full bg-white transition hover:bg-neutral-300 lg:h-10 lg:w-10"
                          >
                              <!-- icon de play -->
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
                      </div>
                      <p class="mt-4 font-semibold text-green-400">
                          Nuevo
                          <span class="text-white">2024</span>
                      </p>
                      <div class="mt-4 flex flex-row items-center gap-2">
                          <p class="text-[10px] text-white lg:text-sm">10 minutos</p>
                      </div>
                      <div class="mt-4 flex flex-row items-center gap-2 text-[8px] text-white lg:text-sm">
                          <p>Comedia</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  ```
- [ ] Obtener películas desde el modelo y listarlas

  ```php
  $getMovies = function () {
      return $this->movies = Movie::all();
  };

  state(['movies' => $getMovies]);
  ```

  - [ ] Por cada película, mostrar los atributos en el template

## Ver película

- [ ] Crear folio para ver una película

  ```php filename=resources/views/pages/watch/[Movie].blade.php
  <x-layouts.dashboard>
      <div class="h-screen w-screen bg-black">
          <nav class="fixed z-10 flex w-full flex-row items-center gap-8 bg-black bg-opacity-70 p-4">
              <a href="#">
                  <!-- Icono de regreso -->
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
  </x-layouts.dashboard>
  ```
- [ ] Agregar enlace para ver la película desde el billboard

  ```php filename=resources/views/components/livewire/billboard.blade.php
  <div class="mt-3 flex flex-row items-center gap-3 md:mt-4">
      <a
          href="#"
          class="flex w-auto flex-row items-center rounded-md bg-white px-2 py-1 text-xs font-semibold text-gray-950 transition hover:bg-neutral-300 md:px-4 md:py-2 lg:text-lg"
      >
          <!-- Icono de reproducción -->
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
  ```

## Billboard

- [x] Crear página dashboard y layout dashboard

  ```php filename=resources/views/components/layouts/dashboard.blade.php
  <body class="h-full overflow-x-hidden bg-gray-900 font-sans text-white antialiased">
      <main class="h-full">
          {{ $slot }}
      </main>
  </body>
  ```
- [x] Crear componente volt `Billboard`

  ```php filename=resources/views/livewire/billboard.blade.php
  <div>
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
              <p class="h-full w-[50%] text-xl font-bold text-white drop-shadow-xl md:text-5xl lg:text-6xl">
                  Título
              </p>
              <p class="mt-3 w-[90%] text-[8px] text-white drop-shadow-xl md:mt-8 md:w-[80%] md:text-lg lg:w-[50%]">
                  Descripción
              </p>
          </div>
      </div>
  </div>
  ```

  ```php filename=resources/views/components/livewire/billboard.blade.php
  state([
      'billboard' => Movie::inRandomOrder()->first(),
  ]);
  ```


## Modelo `Movie`

- [x] Crear modelo `Movie`
  ```bash
  php artisan make:model
  ```
- [x] Configurar migración para `movies`
  ```php filename=database/migrations/create_movies_table.php
  $table->string('title');
  $table->text('description');
  $table->string('thumbnail_url');
  $table->string('video_url');
  $table->string('duration');
  $table->string('genre');
  ```
- [x] Crear seeder para `movies`
  ```php filename=database/seeders/DatabaseSeeder.php
  $movies = [
      [
          'title' => 'Big Buck Bunny',
          'description' => 'Tres roedores se divierten acosando a las criaturas del bosque. Sin embargo, cuando se meten con un conejo, él decide darles una lección.',
          'video_url' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
          'thumbnail_url' => 'https://upload.wikimedia.org/wikipedia/commons/7/70/Big.Buck.Bunny.-.Opening.Screen.png',
          'genre' => 'Comedia',
          'duration' => '10 minutos',
      ],
      [
          'title' => 'Sintel',
          'description' => 'Una joven solitaria, Sintel, ayuda y se hace amiga de un dragón, al que llama Escamas. Pero cuando es secuestrado por un dragón adulto, Sintel decide embarcarse en una peligrosa búsqueda para encontrar a su amigo perdido, Escamas.',
          'video_url' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4',
          'thumbnail_url' => 'http://uhdtv.io/wp-content/uploads/2020/10/Sintel-3.jpg',
          'genre' => 'Aventura',
          'duration' => '15 minutos',
      ],
      [
          'title' => 'Lágrimas de Acero',
          'description' => 'En un futuro apocalíptico, un grupo de soldados y científicos se refugia en Ámsterdam para intentar detener un ejército de robots que amenaza el planeta.',
          'video_url' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/TearsOfSteel.mp4',
          'thumbnail_url' => 'https://mango.blender.org/wp-content/uploads/2013/05/01_thom_celia_bridge.jpg',
          'genre' => 'Acción',
          'duration' => '12 minutos',
      ],
      [
          'title' => "El sueño del elefante",
          'description' => 'Los amigos Proog y Emo viajan dentro de los pliegues de una Máquina aparentemente infinita, explorando el complejo oscuro y retorcido de cables, engranajes y ruedas dentadas, hasta que un momento de conflicto anula todas sus suposiciones.',
          'video_url' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
          'thumbnail_url' => 'https://download.blender.org/ED/cover.jpg',
          'genre' => 'Ciencia Ficción',
          'duration' => '15 minutos',
      ],
  ];

  collect($movies)->each(function ($movie) {
      Movie::create($movie);
  });
  ```

## Autenticación

- [x] Crear componente `auth` layout.
  ```php filename=resources/views/components/layouts/auth.blade.php
  @props(['title' => ''])
  <!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
      <head>
          <meta charset="utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1" />

          <meta name="csrf-token" content="{{ csrf_token() }}" />

          <title>{{ $title ?: config('app.name', 'Laravel') }}</title>

          {{ $head ?? '' }}

          @vite('resources/css/app.css')
      </head>
      <body {{ $attributes }}>
          {{ $slot }}
      </body>
  </html>
  ```
- [x] Crear página de registro
  ```php filename=resources/views/pages/register.blade.php
    <x-layouts.auth title="Registrarse">
      <div class="mx-auto mt-10 max-w-sm">
          <h1 class="font-medium">Registrarse</h1>
          <form class="mt-4">
              <!-- Name -->
              <div>
                  <label for="name">Nombre</label>
                  <input
                      id="name"
                      class="mt-1 block w-full border-zinc-200"
                      type="text"
                      name="name"
                      required
                      autofocus
                      autocomplete="name"
                  />
                  @error('name')
                      <p class="mt-2 text-red-500">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Email Address -->
              <div class="mt-4">
                  <label for="email">Email</label>
                  <input
                      id="email"
                      class="mt-1 block w-full border-zinc-200"
                      type="email"
                      name="email"
                      required
                      autocomplete="username"
                  />
                  @error('email')
                      <p class="mt-2 text-red-500">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Password -->
              <div class="mt-4">
                  <label for="password">Contraseña</label>
                  <input
                      id="password"
                      class="mt-1 block w-full border-zinc-200"
                      type="password"
                      name="password"
                      required
                      autocomplete="new-password"
                  />

                  @error('password')
                      <p class="mt-2 text-red-500">{{ $message }}</p>
                  @enderror
              </div>

              <div class="mt-4">
                  <button class="w-full border border-zinc-200 px-4 py-2 hover:bg-zinc-200">Registrarme</button>
              </div>

              <p class="mt-4 text-center">
                  <a href="#" class="hover:underline">¿Ya tienes una cuenta?</a>
              </p>
          </form>
      </div>
    </x-layouts.auth>
  ```
  - [ ] Realizar registro con Volt
  ```php filename=resources/views/pages/register.blade.php
  <?php
  name('register');

  middleware('guest');

  state([
      'name' => '',
      'email' => '',
      'password' => '',
  ]);

  rules([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
      'password' => ['required', 'string'],
  ]);

  $register = function () {
      $validated = $this->validate();

      $validated['password'] = Hash::make($validated['password']);

      $user = User::create($validated);

      Auth::login($user);

      $this->redirect(route('home', absolute: false), navigate: true);
  }; ?>
  ```
- [x] Crear página de inicio de sesión
  ```php filename=resources/views/pages/login.blade.php
  <x-layouts.auth title="Iniciar Sesión">
      <div class="mx-auto mt-10 max-w-sm">
          <h1 class="font-medium">Iniciar Sesión</h1>

          <form class="mt-4">
              <!-- Email Address -->
              <div>
                  <label for="email">Email</label>
                  <input
                      id="email"
                      class="mt-1 block w-full border-zinc-200"
                      type="email"
                      name="email"
                      required
                      autofocus
                      autocomplete="username"
                  />
                  @error('email')
                      <p class="mt-2 text-red-500">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Password -->
              <div class="mt-4">
                  <label for="password">Contraseña</label>

                  <input
                      id="password"
                      class="mt-1 block w-full border-zinc-200"
                      type="password"
                      name="password"
                      required
                      autocomplete="current-password"
                  />
                  @error('password')
                      <p class="mt-2 text-red-500">{{ $message }}</p>
                  @enderror
              </div>

              <div class="mt-4">
                  <button class="w-full border border-zinc-200 px-4 py-2 hover:bg-zinc-200">Iniciar Sesión</button>
              </div>

              <p class="mt-4 text-center">
                  <a href="#" class="hover:underline">¿No tienes una cuenta?</a>
              </p>
          </form>
      </div>
  </x-layouts.auth>
  ```
  - [ ] Iniciar sesión con Volt
  ```php filename=resources/views/pages/login.blade.php
  <?php

  name('login');

  middleware('guest');

  state([
      'email' => '',
      'password' => '',
  ]);

  rules([
      'email' => ['required', 'string', 'email'],
      'password' => ['required', 'string'],
  ]);

  $login = function () {
      $this->validate();

      $this->authenticate();

      Session::regenerate();

      $this->redirectIntended(default: route('home', absolute: false), navigate: true);
  };

  $authenticate = function () {
      $this->ensureIsNotRateLimited();

      if (! Auth::attempt($this->only(['email', 'password']), true)) {
          RateLimiter::hit($this->throttleKey());

          throw ValidationException::withMessages([
              'email' => trans('auth.failed'),
          ]);
      }

      RateLimiter::clear($this->throttleKey());
  };

  $ensureIsNotRateLimited = protect(function () {
      if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
          return;
      }

      event(new Lockout(request()));

      $seconds = RateLimiter::availableIn($this->throttleKey());

      throw ValidationException::withMessages([
          'email' => trans('auth.throttle', [
              'seconds' => $seconds,
              'minutes' => ceil($seconds / 60),
          ]),
      ]);
  });

  $throttleKey = protect(function () {
      return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
  }); ?>
  ```

## Configuración inicial

- [x] Instalar Tailwind CSS

    ```bash
    npm install -D tailwindcss postcss autoprefixer @tailwindcss/forms
    ```

    ```js filename=postcss.config.js
    export default {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
    },
    };
    ```

    ```js filename=tailwind.config.js
    module.exports = {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js", "./resources/**/*.vue"],
    theme: {
        extend: {},
    },
    plugins: [require("@tailwindcss/forms")],
    };
    ```

    ```css filename=resources/css/app.css
    @tailwind base;
    @tailwind components;
    @tailwind utilities;
    ```
- [x] Instalar Prettier

    ```bash
    npm install -D prettier prettier-plugin-blade prettier-plugin-tailwindcss
    ```

    ```json filename=.prettierrc
    {
    "plugins": ["prettier-plugin-blade", "prettier-plugin-tailwindcss"],
    "overrides": [
        {
        "files": ["*.blade.php"],
        "options": {
            "parser": "blade"
        }
        }
    ],
    "printWidth": 120
    }
    ```

    ```json filename=.blade.format.json
    {
    "useLaravelPint": true,
    "echoStyle": "inline"
    }
    ```
- [x] Instalar Folio y Volt

    ```bash
    composer require laravel/folio livewire/volt

    artisan folio:install && artisan volt:install
    ```
