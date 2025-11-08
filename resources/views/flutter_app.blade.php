<!DOCTYPE html>
<html>
<head>
    <title>Simulador Móvil Flutter</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0; /* Fondo de la página */
            margin: 0;
        }

        .phone-frame {
            /* Dimensiones típicas de un dispositivo móvil */
            width: 375px;
            height: 667px;
            border: 12px solid #333; /* Borde del marco del teléfono */
            border-radius: 40px; /* Esquinas redondeadas del teléfono */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            overflow: hidden; /* Asegura que el contenido se ajuste dentro del marco */
        }

        .flutter-app {
            width: 100%;
            height: 100%;
            border: none; /* Elimina el borde del iframe */
        }
    </style>
</head>
<body>
    <div class="phone-frame">
        <iframe
            src="{{ asset('flutter_app/index.html') }}"
            class="flutter-app"
            title="Aplicación Flutter">
        </iframe>
    </div>
</body>
</html>
