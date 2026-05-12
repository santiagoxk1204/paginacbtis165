<?php

$host = getenv('MYSQLHOST');
$port = getenv('MYSQLPORT');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD'); 
$db   = getenv('MYSQLDATABASE');

$conexion = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Esto es vital para los acentos
mysqli_set_charset($conexion, "utf8");
?>
<?php
// 2. Consulta para obtener los programas de la tabla
$query = "SELECT * FROM programas";
$resultado = mysqli_query($conexion, $query); 

// Verificación de seguridad
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Programas Escolares</title>

    <link rel="stylesheet" href="estilos2.css">
</head>
<body>

    <!-- ENCABEZADO -->
    <header class="encabezado">
        <img src="logo.jpg" alt="Logo escolar">
        <div>
            <h1>Portal de Programas y Actividades Escolares</h1>
            <p>Formación integral para estudiantes</p>
        </div>
    </header>

    <!-- MENÚ -->
    <nav class="menu">
        <a href="#academico">Académico</a>
        <a href="#salud">Salud</a>
        <a href="#integral">Integral</a>
        <a href="#emprendimiento">Talento</a>
        <a href="#opiniones">Opiniones</a>
    </nav>

    <main>

        <!-- APOYO ACADÉMICO -->
        <section id="academico" class="bloque">
            <div class="info">
                <h2>Apoyo Académico</h2>

                <h3>SINATA</h3>
                <p>
                    Estrategia educativa enfocada en tutorías y acompañamiento
                    para fortalecer el rendimiento escolar y la formación integral.
                </p>

                <h3>PRONAFOLE</h3>
                <p>
                    Programa que fomenta la lectura mediante actividades culturales,
                    círculos literarios y dinámicas de investigación.
                </p>
            </div>

            <div class="imagenes">
                <img src="SINATA.jpg" alt="">
                <img src="pronafole1.jpg" alt="">
            </div>
        </section>

        <!-- BIENESTAR -->
        <section id="salud" class="bloque">
            <div class="info">
                <h2>Bienestar y Salud</h2>

                <h3>FOMALASA</h3>

                <p>
                    Promueve hábitos saludables y prevención de riesgos en los estudiantes.
                </p>

                <ul>
                    <li>Atención médica</li>
                    <li>Orientación responsable</li>
                    <li>Prevención de adicciones</li>
                    <li>Promoción de salud física</li>
                </ul>
            </div>

            <div class="imagenes">
                <img src="fomalasa.jpg" alt="">
            </div>
        </section>

        <!-- DESARROLLO -->
        <section id="integral" class="bloque">
            <div class="info">
                <h2>Desarrollo Integral</h2>

                <h3>ECALE</h3>
                <p>
                    Actividades cinematográficas para reflexión y análisis en grupo.
                </p>

                <h3>AMA DGETI</h3>
                <p>
                    Programa enfocado en sustentabilidad y cuidado del medio ambiente.
                </p>
            </div>

            <div class="imagenes">
                <img src="ecale.jpg" alt="">
                <img src="amadgeti.jpg" alt="">
            </div>
        </section>

        <!-- EMPRENDIMIENTO -->
        <section id="emprendimiento" class="bloque">
            <div class="info">
                <h2>Emprendimiento y Talento</h2>

                <h3>MEEMS</h3>
                <p>
                    Desarrollo de competencias emprendedoras para impulsar ideas y proyectos.
                </p>

                <h3>Clubes Escolares</h3>

                <ul>
                    <li>Fútbol</li>
                    <li>Basquetbol</li>
                    <li>Robótica</li>
                    <li>Dibujo y pintura</li>
                </ul>
            </div>

            <div class="imagenes">
                <img src="meems.jpg" alt="">
                <img src="deporte.jpg" alt="">
            </div>
        </section>

        <!-- TABLA DINÁMICA -->
        <section id="tabla" class="tabla-programas">

            <h2>Programas Registrados</h2>

            <table>

                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Programa</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                    </tr>
                </thead>

                <tbody>

                <?php

                if(mysqli_num_rows($datosProgramas) > 0){

                    foreach($datosProgramas as $fila){

                        echo "
                        <tr>
                            <td>{$fila['id']}</td>
                            <td>{$fila['nombre']}</td>
                            <td>{$fila['descripcion']}</td>
                            <td>{$fila['categoria']}</td>
                        </tr>
                        ";
                    }

                } else {

                    echo "
                    <tr>
                        <td colspan='4'>No hay registros disponibles</td>
                    </tr>
                    ";
                }

                ?>

                </tbody>

            </table>

        </section>

        <!-- OPINIONES -->
        <section id="opiniones" class="opiniones">

            <h2>Comparte tu opinión</h2>

            <form method="POST">

                <textarea 
                    name="comentario" 
                    placeholder="Escribe tu opinión..."
                    required>
                </textarea>

                <button type="submit" name="guardar">
                    Enviar
                </button>

            </form>

            <p class="mensaje">
                <?php echo $mensaje; ?>
            </p>

        </section>

    </main>

    <!-- PIE -->
    <footer>

        <p><strong>CBTIS 165</strong></p>

        <p>
            Teléfono: 771-896-5242
        </p>

        <p>
            Correo: contacto@cbtis.edu.mx
        </p>

        <p>
            Elaborado por Santiago Valentín Encarnación Francisco | 2026
        </p>

    </footer>

</body>
</html>