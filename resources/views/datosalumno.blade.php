<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Alumno</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f0f0f0;
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #fff;
            width: 100%;
            max-width: 800px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
        }

        form label {
            font-weight: 600;
            display: block;
            margin: 15px 0 5px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-family: 'Montserrat', sans-serif;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .btn {
            background-color: #8B0000;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #a00000;
        }

        .required::after {
            content: " *";
            color: red;
        }

        .alerta {
            background-color: #ffe0e0;
            border: 1px solid #cc0000;
            color: #a00000;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }

        @media (max-width: 768px) {
            .card {
                padding: 25px 20px;
            }

            .buttons {
                flex-direction: column;
                gap: 15px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Datos del Alumno</h2>

        @if(session('error'))
            <div class="alerta">
                {{ session('error') }}<br>
                Por favor, vuelve a intentarlo.
            </div>
        @endif

        <form id="formAlumno" action="{{ url('/guardar-datos-alumno') }}" method="POST" novalidate>
            @csrf

            <label for="correo" class="required">Correo institucional</label>
            <input type="text" name="email_institucional" id="correo" required
                   pattern="^[a-zA-Z0-9._%+-]+@cbta256\.edu\.mx$"
                   title="Debe ser un correo institucional que termine en @cbta256.edu.mx"
                   oninput="validarCorreo(this)">

            <label for="apellido_paterno" class="required">Apellido paterno</label>
            <input type="text" name="apellido_paterno" id="apellido_paterno" required maxlength="30"
                   pattern="([A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)(\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*"
                   title="Cada palabra debe iniciar con mayúscula. Solo letras." oninput="capitalizar(this)">

            <label for="apellido_materno" class="required">Apellido materno</label>
            <input type="text" name="apellido_materno" id="apellido_materno" required maxlength="30"
                   pattern="([A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)(\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*"
                   title="Cada palabra debe iniciar con mayúscula. Solo letras." oninput="capitalizar(this)">

            <label for="nombre" class="required">Nombre(s)</label>
            <input type="text" name="nombre" id="nombre" required maxlength="50"
                   pattern="([A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)(\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*"
                   title="Cada palabra debe iniciar con mayúscula. Solo letras." oninput="capitalizar(this)">

            <label for="edad" class="required">Edad</label>
            <input type="number" name="edad" id="edad" required min="10" max="99"
                   title="Edad válida entre 10 y 99 años">

            <label for="sexo" class="required">Sexo</label>
            <select name="sexo" id="sexo" required>
                <option value="" disabled selected>Selecciona tu sexo</option>
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
            </select>

            <label for="telefono" class="required">Teléfono personal</label>
            <input type="tel" name="telefono" id="telefono" required maxlength="10" minlength="10"
                   pattern="[0-9]{10}" title="Debe contener exactamente 10 dígitos numéricos"
                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">

            <label for="calle" class="required">Calle y número</label>
            <input type="text" name="calle" id="calle" required maxlength="100" oninput="capitalizar(this)">

            <label for="cp" class="required">Código postal</label>
            <input type="text" name="cp" id="cp" required maxlength="5" minlength="5"
                   pattern="[0-9]{5}" title="Debe contener exactamente 5 dígitos"
                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">

            <label for="colonia" class="required">Colonia</label>
            <input type="text" name="colonia" id="colonia" required oninput="capitalizar(this)">

            <label for="localidad" class="required">Localidad</label>
            <input type="text" name="localidad" id="localidad" required oninput="capitalizar(this)">

            <label for="municipio" class="required">Municipio</label>
            <select name="municipio" id="municipio" required>
                <option value="" disabled selected>Selecciona un municipio</option>
                <option value="Pedro Escobedo">Pedro Escobedo</option>
            </select>

            <label for="ciudad" class="required">Ciudad</label>
            <select name="ciudad" id="ciudad" required>
                <option value="" disabled selected>Selecciona una ciudad</option>
                <option value="Pedro Escobedo">Pedro Escobedo</option>
            </select>

            <label for="estado" class="required">Estado</label>
            <select name="estado" id="estado" required>
                <option value="" disabled selected>Selecciona un estado</option>
                <option value="Querétaro">Querétaro</option>
            </select>

            <div class="buttons">
                <a href="{{ url('/solicitud') }}" class="btn">Atrás</a>
                <button type="submit" class="btn">Siguiente</button>
            </div>
        </form>
    </div>

    <script>
        function capitalizar(input) {
            input.value = input.value
                .toLowerCase()
                .replace(/(^|\s)\S/g, letra => letra.toUpperCase());
        }

        function validarCorreo(input) {
            const regex = /^[a-zA-Z0-9._%+-]+@cbta256\.edu\.mx$/;
            if (!regex.test(input.value)) {
                input.setCustomValidity("El correo debe terminar en @cbta256.edu.mx");
            } else {
                input.setCustomValidity("");
            }
        }

        document.getElementById('formAlumno').addEventListener('submit', function (e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                this.reportValidity();
            }
        });
    </script>
</body>
</html>
