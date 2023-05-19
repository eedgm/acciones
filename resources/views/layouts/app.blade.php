<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Acciones</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

        <!-- Icons -->
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="bg-gray-100">
            <div x-data="{ sidebarOpen: false }" class="flex bg-gray-200">
                <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50"></div>

                <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 overflow-y-auto transition duration-300 transform bg-gray-900 w-50">
                    <div class="flex items-center justify-center bg-white">
                        <div class="flex items-center p-2">
                            <a href="{{ route('dashboard') }}">
                                Acciones CRBOOP
                            </a>

                            {{-- <span class="mx-2 text-2xl font-semibold text-white">SSL</span> --}}
                        </div>
                    </div>

                    <x-sidebarmenu></x-sidebarmenu>
                </div>
                <div class="flex flex-col flex-1 overflow-hidden">
                    {{-- @livewire('navigation-menu') --}}

                    <x-header></x-header>

                    <main class="flex-1 bg-gray-200">
                        <div class="px-4 py-3 mx-auto">
                            <!-- Page Heading -->
                            @if (isset($header))
                                <h3 class="text-3xl font-medium text-gray-700">{{ $header }}</h3>
                            @endif

                            {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

        <footer class="flex-1 bg-gray-200">
            <x-footer></x-footer>
        </footer>

        @stack('modals')

        @livewireScripts

        @stack('scripts')

        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

        @if (session()->has('success'))
        <script>
            var notyf = new Notyf({dismissible: true})
            notyf.success('{{ session('success') }}')
        </script>
        @endif

        <script>
            /* Simple Alpine Image Viewer */
            document.addEventListener('alpine:init', () => {
                Alpine.data('imageViewer', (src = '') => {
                    return {
                        imageUrl: src,

                        refreshUrl() {
                            this.imageUrl = this.$el.getAttribute("image-url")
                        },

                        fileChosen(event) {
                            this.fileToDataUrl(event, src => this.imageUrl = src)
                        },

                        fileToDataUrl(event, callback) {
                            if (! event.target.files.length) return

                            let file = event.target.files[0],
                                reader = new FileReader()

                            reader.readAsDataURL(file)
                            reader.onload = e => callback(e.target.result)
                        },
                    }
                })
            })
        </script>
    </body>
</html>
