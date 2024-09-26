## Listado de publicaciones

- [ ] Crear componente Volt `post-list`

  ```php filename="resources/views/livewire/post-list.blade.php"
  <div class="relative border-b-[1px] border-neutral-800 p-5 transition hover:bg-neutral-900">
      <div class="flex flex-row items-start gap-3">
          <x-avatar />
          <div>
              <div class="flex flex-row items-center gap-2">
                  <span
                      class="relative z-10 font-semibold text-white hover:underline"
                  >
                      Nombre
                  </span>
                  <span
                      class="relative z-10 hidden text-neutral-500 hover:underline md:block"
                  >
                      @username
                  </span>
                  <span class="text-sm text-neutral-500">
                      Hace 1 minuto
                  </span>
              </div>
              <div class="mt-1 text-white">
                  Contenido de la publicación
              </div>
          </div>
      </div>
  </div>
  ```
- [ ] Agregar `post-list` al `index`
- [ ] Obtener *posts* desde el `post-list`
  ```php
  $getPosts = function () {
      return $this->posts = Post::all();
  };

  state(['posts' => $getPosts]);
  ```
- [ ] Agregar relación "Belong To User" al model `Posts`

  ```php
  public function user()
  {
      return $this->belongsTo(User::class);
  }
  ```
- [ ] Añadir variables al `foreach`
- [ ] Emitir evento `post-created` en el `post-form`

  ```php
  $this->dispatch('post.created');
  ```
- [ ] Escuchar evento `post-created` en el `post-list`

  ```php
  on(['post.created' => $getPosts]);
  ```

## Creación de publicaciones

- [ ] Crear componente Volt `post-form`

  ```blade filename=resources/views/livewire
  <div class="border-b-[1px] border-neutral-800 px-5 py-2">
    <div class="flex flex-row gap-4">
        <div>
            <!-- Avatar -->
        </div>
        <div class="w-full">
            <form>
                <textarea
                    class="peer mt-3 w-full resize-none border-0 bg-black p-0 text-[20px] text-white placeholder-neutral-500 outline-none ring-0 focus:ring-0 disabled:opacity-80"
                    placeholder="¿Que estas pensando?"
                ></textarea>
                <hr class="h-[1px] w-full border-neutral-800 opacity-0 transition peer-focus:opacity-100" />
                <div class="mt-4 flex flex-row justify-end">
                    <x-button>Publicar</x-button>
                </div>
            </form>
        </div>
    </div>
  </div>
  ```
- [ ] Agregar `post-form` al `index` como no guest
- [ ] Crear componente Blade `avatar`

  ```blade filename=resources/views/components/avatar.blade.php
  @props(['user', 'hasBorder' => false, 'large' => false])

  <span
      @class([
          'relative z-10 block rounded-full transition hover:opacity-90',
          'border-4 border-black' => $hasBorder,
          'size-32' => $large,
          'size-12' => ! $large,
      ])
  >
      <img class="rounded-full object-cover" alt="Avatar" src="/images/placeholder.png" />
  </span>
  ```
- [ ] Pegar placeholder desde los stubs
- [ ] Agregar `avatar` al componente `post-form` pasando el user
- [ ] Crear `Post` model con migración
- [ ] Agregar columnas a la tabla `posts`

  ```php filename="database/migrations/create_posts_table.php"
  $table->foreignId('user_id')->constrained('users');
  $table->text('body');
  ```
- [ ] Ejecutar migración
- [ ] Agregar el `body` al `fillable` de `Post`

  ```php filename="app/models/Post.php"
  protected $fillable = [
      'body',
  ];
  ```
- [ ] Agregar la relación "Has Many Posts" al modelo `User`

  ```php filename="app/models/User.php"
  public function posts()
  {
      return $this->hasMany(Post::class);
  }
  ```
- [ ] Crear acción de guardar publicación en `post-form`

  ```php filename="resources/views/livewire/post-form.blade.php"
  state('body');

  rules(['body' => 'required|min:3']);

  $save = function () {
      $this->validate();

      Auth::user()->posts()->create([
          'body' => $this->body,
      ]);

      $this->body = '';
  };
  ```

## Autenticación

- [x] Crear `app` layout

  ```php filename=resources/views/components/layouts/app.blade.php
  <!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
      <head>
          <meta charset="utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1" />
          <meta name="csrf-token" content="{{ csrf_token() }}" />

          <title>{{ config('app.name', 'Laravel') }}</title>

          <!-- Scripts -->
          @vite(['resources/css/app.css', 'resources/js/app.js'])
      </head>
      <body class="h-full font-sans text-white antialiased">
          <div class="h-screen bg-black">
              <div class="xl:px-30 container mx-auto h-full max-w-6xl">
                  <div class="grid h-full grid-cols-4">
                      <div>
                          <!-- Sidebar -->
                      </div>
                      <div class="col-span-3 border-x-[1px] border-neutral-800 lg:col-span-2">{{ $slot }}</div>
                      <div>
                          <!-- Seguir cuentas -->
                      </div>
                  </div>
              </div>
          </div>
      </body>
  </html>
  ```
- [x] Crear página Folio `index`

  Registrar la ruta `home` a la página `index` de Folio:

  ```php filename=resources/views/pages/index.blade.php
  name('home');
  ```
- [x] Crear componente `button`

  ```blade filename=resources/views/components/button.blade.php
  @props(['disabled' => false, 'fullWidth' => false, 'secondary' => false, 'large' => false, 'outline' => false])

  <button
      {{ $disabled ? 'disabled' : '' }}
      {{ $attributes->except('class') }}
      @class([
          'rounded-full disabled:cursor-not-allowed disabled:opacity-70',
          'border-2 font-semibold transition hover:opacity-80',
          'w-full' => $fullWidth,
          'w-fit' => ! $fullWidth,
          'border-black bg-white text-black' => $secondary,
          'border-sky-500 bg-sky-500 text-white' => ! $secondary,
          'px-5 py-4 text-xl' => $large,
          'px-4 py-2 text-base' => ! $large,
          'bg-transparent border-white text-white' => $outline,
      ])
  >
      {{ $slot }}
  </button>
  ```
- [x] Agregar botones de autenticación al `index`

  ```blade filename=resources/views/pages/index.blade.php
  @guest
      <div class="py-8">
          <h1 class="mb-4 text-center text-2xl font-bold text-white">Bienvenido a Flitter</h1>
          <div class="flex flex-row items-center justify-center gap-4">
              <x-button type="button">Iniciar sesión</x-button>
              <x-button type="button" secondary>Registrarse</x-button>
          </div>
      </div>
  @endguest
  ```
- [x] Crear componente volt `register-modal`

  ```php filename=resources/views/livewire/register-modal.php
  <div x-data="{ showRegisterModal: false }" x-cloak x-on:show-register-modal.window="showRegisterModal = true">
      <div x-cloak x-transition.opacity x-show="showRegisterModal" class="fixed inset-0 z-50 bg-neutral-800/70"></div>
      <div x-cloak x-transition x-show="showRegisterModal" class="fixed inset-0 z-50 flex items-center">
          <div @click.away="showRegisterModal = false" class="mx-auto w-full max-w-lg rounded-lg bg-black p-10">
              Formulario de registro
          </div>
      </div>
  </div>
  ```
- [x] Agregar `register-modal` al layout `app`
- [x] Despachar evento `show-register-modal` para el abrir modal

  ```php filename=resources/views/pages/index.blade.php
  <x-button @click="$dispatch('show-register-modal')">Registrarse</x-button>
  ```
- [x] Crear componente Blade `input`

  ```blade filename=resources/views/components/input.blade.php
  @props(['label', 'disabled' => false])

  <div class="w-full space-y-2">
      @isset($label)
          <p class="text-xl font-semibold text-white">{{ $label }}</p>
      @endisset

      <input
          {{ $disabled ? 'disabled' : '' }}
          {{ $attributes->merge(['class' => 'w-full p-4 text-lg bg-black border-2 border-neutral-800 rounded-md outline-none text-white focus:border-sky-500 focus:border-2 transition disabled:bg-neutral-900 disabled:opacity-70 disabled:cursor-not-allowed']) }}
      />

      @error($attributes->whereStartsWith('wire:model'))
          <p class="text-sm text-red-500">{{ $message }}</p>
      @enderror
  </div>
  ```
- [x] Añadir formulario de registro al modal de registro

  ```php filename=resources/views/livewire/register-modal.blade.php
  <div @click.away="showRegisterModal = false" class="mx-auto w-full max-w-lg rounded-lg bg-black p-10">
      <div class="flex items-center justify-between">
          <h3 class="text-3xl font-semibold text-white">Registrarse</h3>
          <button @click="showRegisterModal = false" type="button" class="p-1 hover:opacity-70">
              <x-icon.close class="size-5" />
          </button>
      </div>

      <form class="mt-20 flex flex-col gap-4">
          <x-input id="name" type="text" name="name" required placeholder="Nombre" />

          <x-input
              id="username"
              type="text"
              name="username"
              required
              placeholder="Nombre de usuario"
          />

          <x-input id="email" type="email" name="email" required placeholder="Email" />

          <x-input
              id="password"
              type="password"
              name="password"
              required
              placeholder="Contraseña"
          />

          <div class="mt-20">
              <x-button secondary full-width large>Registrarse</x-button>
          </div>

          <p class="text-center text-neutral-400">
              ¿Ya tienes una cuenta?
              <button
                  type="button"
                  class="text-white hover:underline"
              >
                  Iniciar Sesión
              </button>
          </p>
      </form>
  </div>
  ```
- [x] Crear icono `close`

  ```filename=resources/components/icon/close.blade.php
  <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
      <path
          fill-rule="evenodd"
          d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
          clip-rule="evenodd"
      />
  </svg>
  ```
- [x] Crear acción de registro en `register-modal`

  ```php filename=resources/views/livewire/register-modal.blade.php
  <?php

  state([
      'name' => '',
      'username' => '',
      'email' => '',
      'password' => '',
  ]);

  rules([
      'name' => ['required', 'string', 'max:255'],
      'username' => ['required', 'string', 'lowercase', 'max:255', 'unique:'.User::class],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
      'password' => ['required', 'string'],
  ]);

  $register = function () {
      $validated = $this->validate();

      $validated['password'] = Hash::make($validated['password']);

      $user = User::create($validated);

      Auth::login($user);

      $this->redirect(route('home', absolute: false), navigate: true);
  };

  ?>
  ```
- [x] Actualizar la migración de la table `users`

  ```php filename=database/migrations/0001_01_01_000000_create_users_table.php
  $table->string('username')->unique();
  ```
- [x] Actualizar el `fillable` en el modelo `User`

  ```php filename=app/Models/User.php
  protected $fillable = [
      'name',
      'email',
      'username',
      'password',
  ];
  ```
- [x] Actualizar el seeder

  ```php filename=database/seeders/DatabaseSeeder.php
  User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
      'username' => 'testuser',
  ]);
  ```
- [x] Crear componente volt `login-modal`
- [x] Copiar el modal desde el componente `register-modal` y actualizar formulario
- [x] Agregar `show-modal` al layout `app`

  ```php filename=resources/components/layouts/app.blade.php
  <livewire:login-modal />
  ```
- [x] Despachar evento `show-login-modal` para el abrir modal

    ```php filename=resources/views/pages/index.blade.php
    <x-button @click="$dispatch('show-login-modal')">Iniciar sesión</x-button>
    ```
- [x] Crear acción Volt para iniciar sesión

  ```php filename=resources/views/livewire/login-modal.blade.php
  <?php
  state(['email' => '', 'password' => '']);

  rules(['email' => 'required|email', 'password' => 'required']);

  $login = function () {
      $this->validate();

      $this->authenticate();

      Session::regenerate();

      $this->redirectIntended(default: route('home', absolute: false), navigate: true);
  };

  $authenticate = function () {
      if (! Auth::attempt($this->only(['email', 'password']), true)) {
          throw ValidationException::withMessages([
              'email' => trans('auth.failed'),
          ]);
      }
  };
  ```
- [x] Abrir modal de registro y de inicio de sesión desde los modales de autenticación

## Nuevo proyecto Laravel

- [x] Crear nuevo projecto Laravel
- [x] Instalar Folio y Volt
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
