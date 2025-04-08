<!DOCTYPE html>
<html>

<head>
    <title>Paint Online - Galería</title>
    <style>
        img {
            width: 100px;
            margin: 5px;
            border: 2px solid #ccc;
        }

        .dibujo-item {
            display: inline-block;
            text-align: center;
            margin: 10px;
        }

        form {
            display: inline;
        }
    </style>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <style>
        /* ! tailwindcss v3.4.17 | MIT License | https://tailwindcss.com */
        *,
        :before,
        :after {

            .pagination,
            .navigation.pagination {
                clear: both;
                text-align: center;
                margin: 0 auto 30px;
                display: block;
            }

            .pagination .page-numbers {
                display: inline-block;
                margin: 0 2px;
                padding: 5px 10px;
                background: #f1f1f1;
                color: #333;
                text-decoration: none;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            .pagination .page-numbers:hover {
                background: #e2e2e2;
            }

            .pagination .page-numbers.current {
                background: #0073aa;
                color: #fff;
                border-color: #0073aa;
                font-weight: bold;
            }

            .pagination .page-numbers.prev,
            .pagination .page-numbers.next {
                font-weight: bold;
            }

            .pagination .page-numbers.dots {
                cursor: default;
                background: none;
                border: none;
            }

            /* Botones estilo Bootstrap */
            .btn {
                display: inline-block;
                font-weight: 400;
                text-align: center;
                vertical-align: middle;
                user-select: none;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                border: 1px solid transparent;
                cursor: pointer;
                text-decoration: none;
                transition: all 0.15s ease-in-out;
            }

            .btn-light {
                color: #212529;
                background-color: hsl(211, 57.00%, 81.80%);
                border-color: #f8f9fa;
            }

            .btn-light:hover {
                background-color: #e2e6ea;
                border-color: #dae0e5;
            }

            .btn-danger {
                color: #fff;
                background-color: #dc3545;
                border-color: #dc3545;
            }

            .btn-danger:hover {
                background-color: #c82333;
                border-color: #bd2130;
            }
        }
    </style>
    @endif

</head>

<body>
    <h1>🎨 Paint Online</h1>
    <div style="margin-left: 10px;"><button class="btn btn-light"><a href="{{ route('dibujos.create') }}" style="text-decoration:none">Nuevo dibujo</a></button></div>
    <div>
        @foreach ($dibujos as $dibujo)
        <div class="dibujo-item">
            <a href="{{ route('dibujos.show', $dibujo) }}">
                <img src="{{ $dibujo->imagen }}" />
            </a>
            <div>
                <button class="btn btn-light"><a href="{{ route('dibujos.edit', $dibujo) }}" style="text-decoration:none">✏️ Editar</a></button>
                <form method="POST" action="{{ route('dibujos.destroy', $dibujo) }}" onsubmit="return confirm('¿Eliminar este dibujo?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑️ Eliminar</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    {{ $dibujos->links() }}
    <div style="margin-left: 10px;"><button class="btn btn-light"><a href="{{ route('dashboard') }}" style="text-decoration:none">Volver</a></button></div>
</body>

</html>