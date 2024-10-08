## Notificaciones

- [ ] Crear tabla de notificaciones y ejecutar migración

  ```bash
  php artisan notifications:table
  ```

  ```bash
  php artisan migrate
  ```
- [ ] Crear notificación de nuevo like `PostLiked`

  ```php filename=app/Notifications/PostLiked.php
  public function via()
  {
      return ['database'];
  }

  public function toArray()
  {
      return [
        'body' => '¡A alguien le gustó tu publicación!',
      ];
  }
  ```
- [ ] Notificar al autor de la publicación cuando alguien le dió like

  ```php filename=resources/views/livewire/post-list.blade.php
  if ($post->likedBy->contains(auth()->user())) {
      $post->user->notify(new PostLiked);
  }
  ```
- [ ] Crear página de Folio `notifications`

  ```php filename=resources/views/pages/notifications.blade.php
  <?php

  use function Laravel\Folio\middleware;
  use function Laravel\Folio\name;

  name('notifications');

  middleware('auth');

  ?>

  <x-layouts.app>
      <x-header with-back-button>Notificaciones</x-header>
  </x-layouts.app>
  ```
- [ ] Agregar elemento en el sidebar

  ```php filename=resources/views/livewire/sidebar.blade.php
  <a href="{{ route('notifications') }}" wire:navigate class="flex flex-row items-center">
      <div
          class="relative flex h-14 w-14 cursor-pointer items-center justify-center rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:hidden"
      >
          <x-icon.user class="size-7" />
      </div>
      <div
          class="items-row relative hidden cursor-pointer items-center gap-4 rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:flex"
      >
          <x-icon.user class="size-6" />
          <p class="hidden text-xl text-white lg:block">
              Notificaciones
          </p>
      </div>
  </a>
  ```

  ```php filename=resources/views/components/icon/bell.blade.php
  <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
      <path
          fill-rule="evenodd"
          d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0 24.585 24.585 0 0 1-4.831-1.244.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 5.25 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0 25.057 25.057 0 0 1-4.496 0Z"
          clip-rule="evenodd"
      />
  </svg>
  ```
- [ ] Crear componente Volt `notification-list`

  ```php filename=resources/views/livewire/notification-list.blade.php
  <div>
      <div class="flex flex-col">
          <div
              class="flex flex-row items-center gap-4 border-b-[1px] border-neutral-800 p-6"
          >
              <svg
                  class="size-8"
                  width="48"
                  height="48"
                  viewBox="0 0 48 48"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
              >
                  <rect width="48" height="48" fill="transparent" />
                  <path d="M8.99786 17.8433L39.9033 0L39.0844 12.6994L12.7638 27.8955L8.99786 17.8433Z" fill="white" />
                  <path
                      opacity="0.5"
                      d="M12.7637 27.8948L34.4994 15.3457L33.6805 28.0451L16.5296 37.9471L12.7637 27.8948Z"
                      fill="white"
                  />
                  <path
                      opacity="0.25"
                      d="M16.5273 37.9477L29.0933 30.6927L28.2744 43.3921L20.2933 48L16.5273 37.9477Z"
                      fill="white"
                  />
              </svg>
              <p class="text-white">Contenido de la notificación</p>
          </div>
      </div>
  </div>
  ```
- [ ] Obtener notificaciones

  ```php filename=resources/views/livewire/notification-list.blade.php
  state(['notifications' => auth()->user()->notifications]);
  ```
- [ ] Mostrar notificaciones

  ```php
  @foreach ($notifications as $notification)
    {{ $notification->data['body'] }}
  @endforeach
  ```
- [ ] Agregar indicador de notificaciones no vistas

  ```php filename=resources/views/livewire/sidebar.blade.php
  <divi>
      <x-icon.bell />
      @if (auth()->user()->unreadNotifications->count() > 0)
        <span class="absolute left-7 top-4 block size-3 rounded-full bg-sky-500"></span>
      @endif
      <p>Notificaciones</p>
  </div>
  ```
- [ ] Marcar notificaciones como leídas al montar el componente `notification-list`

  ```php filename=resources/views/livewire/notification-list.blade.php
  mount(function () {
      auth()->user()->unreadNotifications->markAsRead();
  });
  ```
- [ ] Refrescar el componente `sidebar` con `wire:poll`

  ```php filename=resources/views/livewire/sidebar.blade.php
  <div wire:poll>...</div>
  ```
- [ ] Crear notificación de nuevo like `CommentAdded`

  ```php filename=app/Notifications/CommentAdded.php
  public function via()
  {
      return ['database'];
  }

  public function toArray()
  {
      return [
          'body' => '¡Alguien ha respondido a tu publicación!',
      ];
  }
  ```
- [ ] Notificar al autor de la publicación cuando alguien publicó un comentario

  ```php filename=resources/views/livewire/comment-list.blade.php
  $this->post->user->notify(new CommentAdded);
  ```
- [ ] Crear notificación de nuevo seguidor `NewFollower`

  ```php filename=app/Notifications/NewFollower.php
  public function via()
  {
      return ['database'];
  }

  public function toArray()
  {
      return [
          'body' => '¡Alguien ha respondido a tu publicación!',
      ];
  }
  ```
- [ ] Notificar que se tiene un nuevo seguidor

  ```php filename=resources/views/livewire/user-bio.blade.php
  if ($user->followers->contains(auth()->user())) {
      $user->notify(new NewFollower);
  }
  ```

## Sidebar

- [ ] Crear componente Volt `sidebar`

  ```php filename=resources/views/livewire/sidebar.blade.php
  <div class="col-span-1 h-full pr-4 md:pr-6">
      <div class="flex flex-col items-end">
          <div class="space-y-2 lg:w-[230px]">
              <!-- Logo -->

              <a href="#" class="flex flex-row items-center">
                  <div
                      class="relative flex h-14 w-14 cursor-pointer items-center justify-center rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:hidden"
                  >
                      <!-- icono -->
                  </div>
                  <div
                      class="items-row relative hidden cursor-pointer items-center gap-4 rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:flex"
                  >
                      <!-- icono -->
                      <p class="hidden text-xl text-white lg:block">
                          Inicio
                      </p>
                  </div>
              </a>

              <!-- Botón de cerrar sesión -->

              <!-- Botón para publicar -->
          </div>
      </div>
  </div>
  ```
- [ ] Registrar coponente en el layout `app`

  ```php filename=resources/views/components/layouts/app.blade.php
  <livewire:sidebar />
  ```
- [ ] Crear componente Blade logo y agregarlo al sidebar

  ```php filename=resourcea/views/components/logo.blade.php
  <svg
      {{ $attributes }}
      width="48"
      height="48"
      viewBox="0 0 48 48"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
  >
      <rect width="48" height="48" fill="transparent" />
      <path
          d="M8.99786 17.8433L39.9033 0L39.0844 12.6994L12.7638 27.8955L8.99786 17.8433Z"
          fill="white"
      />
      <path
          opacity="0.5"
          d="M12.7637 27.8948L34.4994 15.3457L33.6805 28.0451L16.5296 37.9471L12.7637 27.8948Z"
          fill="white"
      />
      <path
          opacity="0.25"
          d="M16.5273 37.9477L29.0933 30.6927L28.2744 43.3921L20.2933 48L16.5273 37.9477Z"
          fill="white"
      />
  </svg>
  ```
- [ ] Agregarlo al sidebar

  ```php filename=resources/views/livewire/sidebar.blade.php
  <a
      href="{{ route('home') }}"
      wire:navigate
      class="flex h-14 w-14 items-center justify-center rounded-full p-4 hover:bg-blue-300 hover:bg-opacity-10"
  >
      <x-logo class="size-7" />
  </a>
  ```
- [ ] Crear icono `home`

  ```php filename=resources/views/components/icons/home.blade.php
  <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
      <path
          d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z"
      />
      <path
          d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z"
      />
  </svg>
  ```
- [ ] Agregar icono `home` y enlace a la `home`

  ```php filename=resources/views/livewire/sidebar.blade.php
  <a href="{{ route('home') }}" wire:navigate class="flex flex-row items-center">
      <div
          class="relative flex h-14 w-14 cursor-pointer items-center justify-center rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:hidden"
      >
          <x-icon.home class="size-7" />
      </div>
      <div
          class="items-row relative hidden cursor-pointer items-center gap-4 rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:flex"
      >
          <x-icon.home class="size-6" />
          <p class="hidden text-xl text-white lg:block">
              Inicio
          </p>
      </div>
  </a>
  ```
- [ ] Agregar enlace al perfil

  ```php filename=resources/views/livewire/sidebar.blade.php
  <a href="{{ route('home') }}" wire:navigate class="flex flex-row items-center">
      <div
          class="relative flex h-14 w-14 cursor-pointer items-center justify-center rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:hidden"
      >
          <x-icon.home class="size-7" />
      </div>
      <div
          class="items-row relative hidden cursor-pointer items-center gap-4 rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:flex"
      >
          <x-icon.home class="size-6" />
          <p class="hidden text-xl text-white lg:block">
              Inicio
          </p>
      </div>
  </a>
  ```
- [ ] Crear icono `user`

  ```php filename=resources/views/components/icons/user.blade.php
  <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
      <path
          fill-rule="evenodd"
          d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
          clip-rule="evenodd"
      />
  </svg>
  ```
- [ ] Abrir modal de iniciar sesión si no se está registrado

  ```php filename=resources/views/livewire/sidebar.blade.php
  <button type="button" @click="$dispatch('show-login-modal')" class="flex flex-row items-center">
      <div
          class="relative flex h-14 w-14 cursor-pointer items-center justify-center rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:hidden"
      >
          <x-icon.user class="size-7" />
      </div>
      <div
          class="items-row relative hidden cursor-pointer items-center gap-4 rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:flex"
      >
          <x-icon.user class="size-6" />
          <p class="hidden text-xl text-white lg:block">
              Perfil
          </p>
      </div>
  </button>
  ```
- [ ] Agregar elemento de navegación para cerrar sesión

  ```php filename=resources/views/livewire/sidebar.blade.php
  <button type="button" class="flex flex-row items-center">
      <div
          class="relative flex h-14 w-14 cursor-pointer items-center justify-center rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:hidden"
      >
          <x-icon.user class="size-7" />
      </div>
      <div
          class="items-row relative hidden cursor-pointer items-center gap-4 rounded-full p-4 hover:bg-slate-300 hover:bg-opacity-10 lg:flex"
      >
          <x-icon.user class="size-6" />
          <p class="hidden text-xl text-white lg:block">
              Cerrar sesión
          </p>
      </div>
  </button>
  ```
- [ ] Crear icono de `logout`

  ```php filename=resources/views/components/icon/logout.blade.php
  <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
      <path
          fill-rule="evenodd"
          d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
          clip-rule="evenodd"
      />
  </svg>
  ```
- [ ] Poder cerrar sesión

  ```php filename=resources/views/components/icon/logout.blade.php
  $logout = function () {
      Auth::guard('web')->logout();

      Session::invalidate();
      Session::regenerateToken();

      $this->redirect('/', navigate: true);
  };

  <button wire:click="logout"></button>
  ```
- [ ] Agregar elemento de navegación para publicar

  ```php filename=resources/views/components/icon/feather.blade.php
  <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
      <path
          fill="currentColor"
          d="M278.5 215.6L23 471c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l57-57 68 0c49.7 0 97.9-14.4 139-41c11.1-7.2 5.5-23-7.8-23c-5.1 0-9.2-4.1-9.2-9.2c0-4.1 2.7-7.6 6.5-8.8l81-24.3c2.5-.8 4.8-2.1 6.7-4l22.4-22.4c10.1-10.1 2.9-27.3-11.3-27.3l-32.2 0c-5.1 0-9.2-4.1-9.2-9.2c0-4.1 2.7-7.6 6.5-8.8l112-33.6c4-1.2 7.4-3.9 9.3-7.7C506.4 207.6 512 184.1 512 160c0-41-16.3-80.3-45.3-109.3l-5.5-5.5C432.3 16.3 393 0 352 0s-80.3 16.3-109.3 45.3L139 149C91 197 64 262.1 64 330l0 55.3L253.6 195.8c6.2-6.2 16.4-6.2 22.6 0c5.4 5.4 6.1 13.6 2.2 19.8z"
      />
  </svg>
  ```

  ```php filename=resources/views/livewire/sidebar.blade.php
  <a class="block w-full" href="{{ route('home') }}" wire:navigate>
      <div
          class="mt-6 flex h-14 w-14 cursor-pointer items-center justify-center rounded-full bg-sky-500 p-4 transition hover:bg-opacity-80 lg:hidden"
      >
          <x-icon.feather class="size-6" />
      </div>
      <div class="mt-6 hidden cursor-pointer rounded-full bg-sky-500 px-4 py-2 hover:bg-opacity-90 lg:block">
          <p class="hidden text-center text-[20px] font-semibold text-white lg:block">Publicar</p>
      </div>
  </a>
  ```
- [ ] Abrir modal de iniciar sesión si no se está registrado

  ```php filename=resources/views/livewire/sidebar.blade.php
  <button @click="$dispatch('show-login-modal')" type="button" class="block w-full">
      <div
          class="mt-6 flex h-14 w-14 cursor-pointer items-center justify-center rounded-full bg-sky-500 p-4 transition hover:bg-opacity-80 lg:hidden"
      >
          <x-icon.feather class="size-6" />
      </div>
      <div class="mt-6 hidden cursor-pointer rounded-full bg-sky-500 px-4 py-2 hover:bg-opacity-90 lg:block">
          <p class="hidden text-center text-[20px] font-semibold text-white lg:block">Publicar</p>
      </div>
  </button>
  ```

## Notificaciones Toast

- [ ] Agregar plugin `notify` al layout `app`

  ```php filename=resources/views/components/layouts/app.blade.php
  <script defer src="https://unpkg.com/alpinejs-notify@latest/dist/notifications.min.js"></script>
  ```
- [ ] Crear componente Blade `toast`

  ```php filename=resources/views/components/toast.blade.php
  <div
      x-data="{
          message: '{{ session('toast') }}',
          notify(message) {
              $notify(message, {
                  wrapperId: 'flashMessageWrapper',
                  templateId: 'flashMessageTemplate',
                  autoClose: 3000,
                  autoRemove: 4000,
              })
          },
      }"
      x-on:toast.window="notify($event.detail.message)"
      x-init="if (message) notify(message)"
  >
      <div id="flashMessageWrapper" class="fixed right-4 top-4 z-50 w-64 space-y-2"></div>

      <template id="flashMessageTemplate">
          <div role="alert" class="flex gap-1.5 rounded-lg bg-sky-500 px-4 py-3 text-white">
              <x-icons.check class="size-6" />
              {notificationText}
          </div>
      </template>
  </div>
  ```

  ```php filename=resources/views/components/icon/check.blade.php
  <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
      <path
          fill-rule="evenodd"
          d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
          clip-rule="evenodd"
      />
  </svg>
  ```
- [ ] Registrar `toast` en layout `app`

  ```php filename=resources/views/components/layouts/app.blade.php
  <x-toast />
  ```
- [ ] Despachar evento `toast` al publicar post, favoritear, comentar,

  ```php filename=resources/views/livewire/post-form.blade.php
  $this->dispatch('toast', message: 'Publicación creada');
  ```

  ```php filename=resources/views/livewire/comment-form.blade.php
  $this->dispatch('toast', message: 'Comentario creado');
  ```

  ```php filename=resources/views/livewire/post-list.blade.php
  $this->dispatch('toast', message: 'Éxito');
  ```

  ```php filename=resources/views/livewire/show-post.blade.php
  $this->dispatch('toast', message: 'Éxito');
  ```

  ```php filename=resources/views/livewire/user-bio.blade.php
  $this->dispatch('toast', message: 'Éxito');

  session()->flash('toast-success', 'Actualizado');
  ```

## Subir foto de perfil y de portada

- [ ] Agregar componentes Alpine a `user-bio` para seleccionar foto

  ```php filename=resources/views/livewire/user-bio.blade.php
  <div x-data="{ coverName: null, coverPreview: null }">
      <input
          type="file"
          id="cover"
          class="hidden"
          x-ref="cover"
          x-on:change="
              coverName = $refs.cover.files[0].name
              const reader = new FileReader()
              reader.onload = (e) => {
                  coverPreview = e.target.result
              }
              reader.readAsDataURL($refs.cover.files[0])
          "
      />

      <div class="space-y-2">
          <div class="relative h-44 overflow-hidden rounded-lg bg-neutral-700">
              <span
                  x-show="coverPreview"
                  x-cloak
                  class="block h-full w-full bg-cover bg-center bg-no-repeat"
                  x-bind:style="'background-image: url(\'' + coverPreview + '\');'"
              ></span>
          </div>
          <div class="text-right">
              <x-button secondary type="button" x-on:click.prevent="$refs.cover.click()">
                  Seleccionar foto nueva
              </x-button>
          </div>
      </div>
  </div>
  <div x-data="{ photoName: null, photoPreview: null }">
      <input
          type="file"
          id="photo"
          class="hidden"
          x-ref="photo"
          x-on:change="
              photoName = $refs.photo.files[0].name
              const reader = new FileReader()
              reader.onload = (e) => {
                  photoPreview = e.target.result
              }
              reader.readAsDataURL($refs.photo.files[0])
          "
      />

      <div class="flex items-center justify-between gap-2">
          <div>
              <span
                  x-show="photoPreview"
                  x-cloak
                  class="block h-20 w-20 rounded-full bg-cover bg-center bg-no-repeat"
                  x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
              ></span>
          </div>
          <x-button secondary type="button" x-on:click.prevent="$refs.photo.click()">
              Seleccionar foto nueva
          </x-button>
      </div>
  </div>
  ```
- [ ] Actualizar migración de la tabla `users`

  ```php filename=database/migrations/0001_01_01_000000_create_users_table.php
  $table->string('profile_photo_path')->nullable();
  $table->string('cover_photo_path')->nullable();
  ```
- [ ] Agregar métodos en modelo `User` para subir foto y portada

  ```php filename=app/Models/User.php
  public function updateProfilePhoto(UploadedFile $photo)
  {
      tap($this->profile_photo_path, function ($previous) use ($photo) {
          $this->forceFill([
              'profile_photo_path' => $photo->storePublicly(
                  'profile-photos', ['disk' => 'public']
              ),
          ])->save();

          if ($previous) {
              Storage::disk('public')->delete($previous);
          }
      });
  }

  public function updateCoverPhoto(UploadedFile $photo)
  {
      tap($this->cover_photo_path, function ($previous) use ($photo) {
          $this->forceFill([
              'cover_photo_path' => $photo->storePublicly(
                  'cover-photos', ['disk' => 'public']
              ),
          ])->save();

          if ($previous) {
              Storage::disk('public')->delete($previous);
          }
      });
  }
  ```
- [ ] Agregar métodos en modelo `User` para obteber la url de la foto y portada

  ```php filename=app/Models/User.php
  public function profilePhotoUrl(): Attribute
  {
      return Attribute::get(function () {
          return $this->profile_photo_path
                  ? Storage::disk('public')->url($this->profile_photo_path)
                  : asset('images/placeholder.png');
      });
  }

  public function coverPhotoUrl(): Attribute
  {
      return Attribute::get(function () {
          return $this->cover_photo_path
                  ? Storage::disk('public')->url($this->cover_photo_path)
                  : null;
      });
  }
  ```
- [ ] Poder subir perfil y portada

  ```php
  <?php

  uses(WithFileUploads::class);

  state([
      'photo',
      'cover',
  ]);

  rules(fn () => [
      'photo' => ['nullable', 'image', 'max:1024'],
      'cover' => ['nullable', 'image', 'max:1024'],
  ]);

  $updateUser = function () {
      // Después de validar

      if ($this->photo) {
          $this->user->updateProfilePhoto($this->photo);
      }

      if ($this->cover) {
          $this->user->updateCoverPhoto($this->cover);
      }
  };

  ?>

  <input wire:model.live="cover">

  <input wire:model.live="photo">
  ```
- [ ] Utilizar foto de perfil en el componente `avatar`

  ```php filename=resources/views/componentes/avatar.blade.php
  <img src="{{ $user->profile_photo_url }}" />
  ```
- [ ] Utilizar portada en el componente `user-hero`

  ```php filename=resources/views/components/user-hero.blade.php
  @if ($user->cover_photo_url)
      <img src="{{ $user->cover_photo_url }}" alt="{{ $user->name }}" class="h-full w-full object-cover" />
  @endif
  ```
- [ ] Mostrar foto de perfil y portada en el modal de editar perfil

  ```php filename=resources/views/livewire/user-bio.blade.php
  @if ($this->user->cover_photo_url)
      <img
          x-show="! coverPreview"
          src="{{ $user->cover_photo_url }}"
          alt="{{ $user->name }}"
          class="h-full w-full bg-center bg-no-repeat object-cover"
      />

      <img
          x-show="! photoPreview"
          src="{{ $user->profile_photo_url }}"
          alt="{{ $user->name }}"
          class="h-20 w-20 rounded-full object-cover"
      />
  @endif
  ```

## Edición de perfil de usuarios

- [ ] Agregar modal en componente `user-bio`

  ```php filename=resources/views/livewire/user-bio.blade.php
  <div>
      <div x-cloak x-transition.opacity x-show="showEditModal" class="fixed inset-0 z-50 bg-neutral-800/70"></div>
      <div x-cloak x-transition x-show="showEditModal" class="fixed inset-0 z-50 flex items-center">
          <div @click.away="showEditModal = false" class="mx-auto w-full max-w-lg rounded-lg bg-black p-10">
              Formulario
          </div>
      </div>
  </div>
  ```
- [ ] Abrir modal con botón `Editar perfil`

  ```php filename=resources/views/livewire/user-bio.blade.php
  <div
      x-data="{ showEditModal: false }"
      @keydown.window.escape="showEditModal = false"
  >
      <x-button @click="showEditModal = !showEditModal" secondary>Editar</x-button>
  </div>
  ```
- [ ] Agregar formulario para editar perfil al modal

  ```php filename=resources/views/livewire/user-bio.blade.php
  <form>
      <div class="flex items-center justify-between">
          <h3 class="text-3xl font-semibold text-white">Edita tu perfil</h3>
          <button @click="showEditModal = false" type="button" class="p-1 hover:opacity-70">
              <x-icon.close class="size-5" />
          </button>
      </div>
      <div class="mt-20 flex flex-col gap-4">
          <x-input placeholder="Nombre" />
          <x-input placeholder="Nombre de usuario" />
          <x-input placeholder="Biografía" />
      </div>
      <div class="mt-20">
          <x-button secondary full-width large>Guardar</x-button>
      </div>
  </form>
  ```
- [ ] Poder actualizar el perfil

  ```php filename=resources/views/livewire/user-bio.blade.php
  state([
      'name' => auth()->user()?->name,
      'username' => auth()->user()?->username,
      'bio' => auth()->user()?->bio,
  ]);

  rules(fn () => [
      'name' => ['required', 'string', 'max:255'],
      'username' => ['required', 'string', 'max:255', 'unique:users,username,'.auth()->user()->id],
      'bio' => ['nullable', 'string', 'max:255'],
  ]);

  $updateUser = function () {
      $this->validate();

      auth()->user()->update([
          'name' => $this->name,
          'username' => $this->username,
          'bio' => $this->bio,
      ]);

      $this->redirect(route('users.show', ['user' => $this->user]), navigate: true);
  };
  ```

## Seguir usuarios

- [ ] Agregar botón para seguir un usuario

  ```php filename=resources/views/components/user-bio.blade.php
  <div class="flex justify-end p-2">
      <x-button secondary>Seguir</x-button>
  </div>
  ```
- [ ] Crear migración para crear tabla `followers`

  ```php filename=database/migrations/create_followers_table.php
  $table->foreignId('user_id')->constrained('users');
  $table->foreignId('follower_id')->constrained('users');
  ```
- [ ] Ejecutar migraciones
- [ ] Mover componente Blade `user-bio` a un componente Volt

  ```php filename=resources/views/pages/users/[User].blade.php
  <livewire:user-bio :user="$user" />
  ```

  ```php filename=resources/views/livewire/user-bio.blade.php
  state(['user']);
  ```
- [ ] Registrar relaciones de followers

  ```php filename=app/Models/User.php
    public function followers()
  {
      return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
  }

  public function following()
  {
      return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
  }
  ```
- [ ] Poder seguir usuario

  ```php filename=resources/views/livewire/user-bio.blade.php
  <?php

  $getIsFollowing = function () {
      return $this->isFollowing = auth()->user()?->following->contains($this->user);
  };

  state([
      'isFollowing' => $getIsFollowing,
  ]);

  $toggleFollow = function (User $user) {
      auth()->user()->following()->toggle($user);

      $this->getIsFollowing();
  };

  ?>

  <div class="flex justify-end p-2">
      @if (auth()->check() && $user->id === auth()->user()->id)
          <x-button secondary disabled>
              Seguir
          </x-button>
      @elseif (auth()->check())
          <x-button wire:click="toggleFollow({{ $user->id }})" :outline="$isFollowing" :secondary="! $isFollowing">
              {{ $isFollowing ? 'Dejar de seguir' : 'Seguir' }}
          </x-button>
      @else
          <x-button @click="$dispatch('show-login-modal')" secondary>Seguir</x-button>
      @endif
  </div>
  ```
- [ ] Agregar sección de siguiendo y seguidores a `user-bio`

  ```php filename=resources/views/livewire/user-bio.blade.php
  <div class="mt-4 flex flex-row items-center gap-6">
      <div class="flex flex-row items-center gap-1">
          <p class="text-white">0</p>
          <p class="text-neutral-500">Siguiendo</p>
      </div>
      <div class="flex flex-row items-center gap-1">
          <p class="text-white">0</p>
          <p class="text-neutral-500">Seguidores</p>
      </div>
  </div>
  ```
- [ ] Crear componente Volt `follow-bar`

  ```php filename=resources/views/livewire/followr-bar.blade.php
  <?php

  $getUsers = function () {
      return User::all();
  };

  state(['users' => $getUsers]);

  ?>

  <div class="hidden px-6 py-4 lg:block">
      <div class="rounded-xl bg-neutral-800 p-4">
          <h2 class="text-xl font-semibold text-white">A quién seguir</h2>
          <div class="mt-4 flex flex-col gap-6">
              @foreach ($users as $user)
                  <div wire:key="{{ $user->id }}" class="flex flex-row gap-4">
                      <x-avatar :user="$user" />
                      <div class="flex flex-col">
                          <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
                          <p class="text-sm text-neutral-400">{{ '@'.$user->username }}</p>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  </div>
  ```
- [ ] Agregar `follow-bar` al `app` layout

  ```php resources/components/layouts/app.blade.php
  <livewire:follow-bar />
  ```

## Mostrar posts por usuario

- [ ] Crear página de Folio para ver usuarios

  ```php filename=resources/views/pages/users/[User].blade.php
  <x-layouts.app>
      <x-header with-back-button>{{ $user->name }}</x-header>
  </x-layouts.app>
  ```
- [ ] Enlazar ver usuario

  ```php filename=resources/views/livewire/post-list.blade.php
  <a
      href="{{ route('users.show', ['user' => $post->user]) }}"
      wire:navigate
  >
      Nombre del usuario
  </a>

  <a
      href="{{ route('users.show', ['user' => $post->user]) }}"
      wire:navigate
  >
      Username
  </a>
  ```

  ```php filename=resources/views/livewire/show-post.blade.php
  <a
      href="{{ route('users.show', ['user' => $post->user]) }}"
      wire:navigate
  >
      Nombre del usuario
  </a>

  <a
      href="{{ route('users.show', ['user' => $post->user]) }}"
      wire:navigate
  >
      Username
  </a>
  ```

  ```php filename=resources/views/livewire/comment-list.blade.php
  <a
      href="{{ route('users.show', ['user' => $post->user]) }}"
      wire:navigate
  >
      Nombre del usuario
  </a>

  <a
      href="{{ route('users.show', ['user' => $post->user]) }}"
      wire:navigate
  >
      Username
  </a>

  ```php filename=resources/views/componentes/avatar.blade.php
  <a
      href="{{ route('users.show', ['user' => $user]) }}"
      wire:navigate
  >
      Avatar
  </a>
  ```
- [ ] Crear componente Blade `user-hero` y añadirlo a `users/[User]`

  ```php filename=resources/views/components/user-hero.blade.php
  <div>
      <div class="relative h-44 bg-neutral-700">
          <div class="absolute -bottom-16 left-4">
              <x-avatar :user="$user" large has-border />
          </div>
      </div>
  </div>
  ```

  ```php filename=resources/views/pages/users/[User].blade.php
  <div class="pt-20">
      <livewire:post-list />
  </div>
  ```
- [ ] Crear componente Blade `user-bio` y añadirlo a `users/[User]`

  ```php filename=resources/views/components/user-bio.blade.php
  @props(['user'])

  <div class="border-b-[1px] border-neutral-800 pb-4">
      <div class="mt-8 px-4">
          <div class="flex flex-col">
              <p class="text-2xl font-semibold text-white">
                  {{ $user->name }}
              </p>
              <p class="text-base text-neutral-500">{{ '@'.$user->username }}</p>
          </div>
          <div class="mt-4 flex flex-col">
              <p class="text-white">{{ $user->bio }}</p>
              <div class="mt-4 flex flex-row items-center gap-2 text-neutral-500">
                  <x-icon.calendar class="size-6" />
                  <p>Se unió en {{ $user->created_at->isoFormat('MMMM \d\e\ YYYY') }}</p>
              </div>
          </div>
      </div>
  </div>
  ```

  ```php filename=resources/views/components/icon/calendar.blade.php
  <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
      <path
          fill-rule="evenodd"
          d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z"
          clip-rule="evenodd"
      />
  </svg>
  ```

  ```php filename=resources/views/pages/users/[User].blade.php
  <div class="pt-10">
      <x-user-bio :user="$user" />
  </div>
  <livewire:post-list :user="$user" />
  ```
- [ ] Re-utilizar componente `post-list` para filtrar posts por usuario

  ```php filename=resources/views/livewire/post-list.blade.php
  state(['user' => null, 'posts' => $getPosts]);

  $getPosts = function () {
      if ($this->user) {
          return $this->posts = $this->user->posts;
      }

      return $this->posts = Post::all();
  };
  ```

  ```php filename=resources/views/pages/users/[User].blade.php
  <livewire:post-list :user="$user" />
  ```

## Likear publicaciones

- [ ] Agregar botón para likear

  ```php filename=resources/views/livewire/post-list.blade.php
  <button
      class="relative z-10 flex flex-row items-center gap-2 text-neutral-500 transition hover:text-red-500"
  >
      <!-- icono de heart -->
      <p>
          Conteo de likes
      </p>
  </button>
  ```
- [ ] Crear componente para icono de `heart`

  ```php filename=resources/views/components/icon/hear-outline.blade.php
  <svg
      {{ $attributes }}
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
  >
      <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
      />
  </svg>
  ```
- [ ] Agregar icono para likear

  ```php filename=resources/views/livewire/post-list.blade.php
  <x-icon.heart-outline class="size-5" />
  ```
- [ ] Crear migración para la tabla `likes`

  ```php filename=database/migrations/create_likes_table.php
  $table->foreignId('user_id')->constrained('users');
  $table->foreignId('post_id')->constrained('posts');
  ```
- [ ] Ejecutar migración
- [ ] Agregar relaciones a los modelos `Post` y `User`

  ```php filename=app/Models/Posts
  public function likedBy()
  {
      return $this->belongsToMany(User::class, 'likes');
  }
  ```

  ```php filename=app/Models/User
  public function likedPosts()
  {
      return $this->belongsToMany(Post::class, 'likes');
  }
  ```
- [ ] Poder likear `posts`

  ```php filename=resources/views/livewiere/post-list.blade.php
  $toggleLike = function (Post $post) {
      auth()->user()->likedPosts()->toggle($post);

      $this->getPosts();
  };
  ```

  ```php filename=resources/views/livewiere/post-list.blade.php
  <button wire:click="toggleLike({{ $post->id }})">Like</button>
  ```
- [ ] Cambiar icono si el post ha sido likeado

  ```php filename=resources/views/livewiere/post-list.blade.php
  @if ($post->likedBy->contains(auth()->user()))
      <x-icon.heart-solid class="size-5 text-red-500" />
  @else
      <x-icon.heart-outline class="size-5" />
  @endif
  ```

  ```php filename=resources/views/componentes/icon/heart-solid.blade.php
  <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
      <path
          d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z"
      />
  </svg>
  ```
- [ ] Añadir conteo de likes

  ```php filename=resources/views/livewiere/post-list.blade.php
  <p>
      {{ $post->likedBy->count() }}
  </p>
  ```
- [ ] Crear componente Volt `show-post`

  ```php filename=resources/views/livewire/show-post.blade.php
  state(['post']);
  ```

  Mover información del post desde la página de folio al componente `show-post`
- [ ] Poder likear `post` desde la página del post

  ```php filename=resources/views/livewire/show-post.blade.php
  $toggleLike = function () {
      auth()->user()->likedPosts()->toggle($this->post);

      $this->post->refresh();
  };
  ```

  ```php filename=resources/views/livewire/show-post.blade.php
  <button
      wire:click="toggleLike({{ $post->id }})"
      class="relative z-10 flex flex-row items-center gap-2 text-neutral-500 transition hover:text-red-500"
  >
      @if ($post->likedBy->contains(auth()->user()))
          <x-icon.heart-solid class="size-5 text-red-500" />
      @else
          <x-icon.heart-outline class="size-5" />
      @endif
      <p>
          {{ $post->likedBy->count() }}
      </p>
  </button>
  ```
- [ ] Abrir modal de inicio de sesión para likear `post`

  ```php
  <button
  @auth
      wire:click="toggleLike({{ $post->id }})"
  @else
      @click="$dispatch('show-login-modal')"
  @endauth
  >Like</button>
  ```

## Comentar publicaciones

- [ ] Crear pagina Folio `Posts/[Post].blade.php`

  ```php filename=Posts/[Post].blade.php
  <?php

  use function Laravel\Folio\name;

  name('posts.show');

  ?>

  <x-layouts.app>
      <div class="relative border-b-[1px] border-neutral-800 p-5 transition hover:bg-neutral-900">
          <div class="flex flex-row items-start gap-3">
              <x-avatar :user="$post->user" />
              <div>
                  <div class="flex flex-row items-center gap-2">
                      <span
                          class="relative z-10 font-semibold text-white hover:underline"
                      >
                          {{ $post->user->name }}
                      </span>
                      <span
                          class="relative z-10 hidden text-neutral-500 hover:underline md:block"
                      >
                          {{ '@'.$post->user->username}}
                      </span>
                      <span class="text-sm text-neutral-500">
                          {{ $post->created_at->diffForHumans() }}
                      </span>
                  </div>
                  <div class="mt-1 text-white">
                      {{ $post->body }}
                  </div>
              </div>
          </div>
      </div>
  </x-layouts.app>
  ```
- [ ] Enlazar al post desde `post-list`

  ```php
  <a class="absolute inset-0"></a>
  ```
- [ ] Crear componente Volt `comment-form` y añadirlo al mostrar el post

  Copiar componente desde `post-form`
- [ ] Crear modelo `Comment` con migración

  ```php filename=database/migrations/create_comments_table.php
  $table->foreignId('user_id')->constrained('users');
  $table->foreignId('post_id')->constrained('posts');
  $table->text('body');
  ```

  ```php filename=app/Models/Comment.php
  protected $fillable = [
      'user_id',
      'post_id',
      'body',
  ];
  ```
- [ ] Ejecutar migraciones

  ```bash
  php artisan migrate
  ```
- [ ] Agregar relaciones entre comentarios y posts

  ```php filename=app/Models/Comment.php
  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function post()
  {
      return $this->belongsTo(Post::class);
  }
  ```

  ```php filename=app/Models/Post.php
  public function comments()
  {
      return $this->hasMany(Comment::class);
  }
  ```
- [ ] Guardar comentarios

  ```blade filename=resources/views/livewire/comment-form.blade.php
  state(['post', 'body']);

  rules(['body' => 'required|min:3']);

  $save = function () {
      $this->validate();


      $this->post->comments()->create([
          'user_id' => Auth::user()->id,
          'body' => $this->body,
      ]);

      $this->body = '';
  };
  ```
- [ ] Pasar `post` al componente `comment-form`

  ```php filename=resources/views/pages/posts/[Post]
  <livewire:comment-form :post="$post" />
  ```
- [ ] Desactivar botón "Publicar" por defecto

  ```php filename=resources/views/livewire/comment-form.blade.php
  <x-button disabled x-bind:disabled="! $wire.body">Publicar</x-button>
  ```

  Lo mismo para el `post-form`
- [ ] Crear componente Volt `comment-list`

  ```php filename=resources/views/livewire/comment-list.blade.php
  <div>
      <div class="border-b-[1px] border-neutral-800 p-5">
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
                          Username
                      </span>
                      <span class="text-sm text-neutral-500">
                          Fecha
                      </span>
                  </div>
                  <div class="mt-1 text-white">
                      Contenido del comentario
                  </div>
              </div>
          </div>
      </div>
  </div>
    ```
- [ ] Registrar `comment-list` en página Folio

  ```php filename=resources/views/pages/posts/[Post].blade.php
  <livewire:comment-list />
  ```
- [ ] Mostrar lista de comentarios

  ```php filename=resources/views/livewire/comment-list.blade.php
  $getComments = function () {
      return $this->comments = $this->post->comments;
  };

  state(['post', 'comments' => $getComments]);
  ```
- [ ] Pasar `post` al componente `comment-list`

  ```php filename=resources/views/pages/posts/[Post]
    <livewire:comment-list :post="$post" />
  ```
- [ ] Ordernar comentarios por fecha

  ```php filename=app/Models/Comment.php
  protected static function boot()
  {
      parent::boot();

      static::addGlobalScope('order', function ($query) {
          $query->orderBy('created_at', 'desc');
      });
  }
  ```
- [ ] Emitir evento `comment-created` en el `comment-form`

  ```php
  $this->dispatch('comment-created');
  ```
- [ ] Escuchar evento `comment-created` en el `comment-list`

  ```php
  on(['comment-created' => $getComments]);
  ```
- [ ] Mostrar conteo de comentario en cada post

  ```php filename=resources/views/livewire/post-list.blade.php
  <div class="mt-3 flex flex-row items-center gap-10">
      <a
          class="relative z-10 flex flex-row items-center gap-2 text-neutral-500 transition hover:text-sky-500"
      >
          <!-- icono de comentario -->
          <p>Conteo de comentario</p>
      </a>
  </div>
  ```
- [ ] Añadir icono de comentario

  ```php filename=resources/views/componentes/icon/comment.blade.php
  <svg
      {{ $attributes }}
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
  >
      <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"
      />
  </svg>
  ```

  ```php filename=resources/views/livewire/post-list.blade.php
  <x-icon.comment class="size-5"></x-icon.comment>
  ```
- [ ] Crear componente `header` para la navegación

  ```php filename=resources/views/components/icon/arrow-left.blade.php
  <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
      <path
          fill-rule="evenodd"
          d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
          clip-rule="evenodd"
      />
  </svg>
  ```

  ```php filename=resources/views/components/header.blade.php
  @props(['withBackButton' => false])

  <div class="border-b-[1px] border-neutral-800 p-5">
      <div class="flex flex-row items-center gap-2">
          @if ($withBackButton)
              <a
                  href="{{ url()->previous() === url()->current() ? route('home') : url()->previous() }}"
                  wire:navigate
                  class="transition hover:opacity-70"
              >
                  <x-icon.arrow-left class="size-5" />
              </a>
          @endif

          <h1 class="text-xl font-semibold text-white">{{ $slot }}</h1>
      </div>
  </div>
  ```
- [ ] Añadir `header` a las páginas `index` y `posts/[Post]`

  ```php filename=resources/views/pages/index.blade.php
  <x-header>Inicio</x-header>
  ```

  ```php filename=resources/views/pages/posts/[Post].blade.php
  <x-header with-back-button>Post</x-header>
  ```
- [ ] Crear componente Blade `auth-buttons`

  ```php
  <div class="border-b-[1px] border-neutral-800 px-5 py-2">
      <div class="py-8" x-data>
          <h1 class="mb-4 text-center text-2xl font-bold text-white">Bienvenido a Flitter</h1>
          <div class="flex flex-row items-center justify-center gap-4">
              <x-button type="button" @click="$dispatch('show-login-modal')">Iniciar sesión</x-button>
              <x-button type="button" @click="$dispatch('show-register-modal')" secondary>Registrarse</x-button>
          </div>
      </div>
  </div>
  ```
- [ ] Añadir `auth-buttons` a las páginas `index` y `posts/[Post]`

## Sistema de publicaciones

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
- [ ] Crear modelo `Post` con migración
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
- [ ] Ordernar *posts* por fecha

  ```php filename=app/Models/Post.php
  protected static function boot()
  {
      parent::boot();

      static::addGlobalScope('order', function ($query) {
          $query->orderBy('created_at', 'desc');
      });
  }
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

## Autenticación

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
- [x] Crear página Folio `index`

  Registrar la ruta `home` a la página `index` de Folio:

  ```php filename=resources/views/pages/index.blade.php
  name('home');
  ```
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
