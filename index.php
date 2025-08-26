<?php
require_once 'classes/Biblioteca.php';
require_once 'classes/Libro.php';

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['biblioteca'])) {
    $_SESSION['biblioteca'] = new Biblioteca();
    
    // Agregar algunos libros de ejemplo
    $libro1 = new Libro("Cien años de soledad", "Gabriel García Márquez", "9788437604947", "Novela", 1967);
    $libro2 = new Libro("1984", "George Orwell", "9780451524935", "Ciencia Ficción", 1949);
    $libro3 = new Libro("El principito", "Antoine de Saint-Exupéry", "9780156012195", "Fábula", 1943);
    
    $_SESSION['biblioteca']->agregarLibro($libro1);
    $_SESSION['biblioteca']->agregarLibro($libro2);
    $_SESSION['biblioteca']->agregarLibro($libro3);
}

$biblioteca = $_SESSION['biblioteca'];
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar_libro'])) {
        $titulo = htmlspecialchars($_POST['titulo']);
        $autor = htmlspecialchars($_POST['autor']);
        $isbn = htmlspecialchars($_POST['isbn']);
        $categoria = htmlspecialchars($_POST['categoria']);
        $anio_publicacion = intval($_POST['anio_publicacion']);
        
        $libro = new Libro($titulo, $autor, $isbn, $categoria, $anio_publicacion);
        if ($biblioteca->agregarLibro($libro)) {
            $mensaje = "Libro agregado con éxito.";
        } else {
            $mensaje = "Error: El libro ya existe.";
        }
    }
    
    if (isset($_POST['prestar_libro'])) {
        $isbn = htmlspecialchars($_POST['isbn_prestar']);
        $usuario = htmlspecialchars($_POST['usuario']);
        
        if ($biblioteca->prestarLibro($isbn, $usuario)) {
            $mensaje = "Libro prestado con éxito.";
        } else {
            $mensaje = "Error: No se pudo prestar el libro. Puede que no exista o ya esté prestado.";
        }
    }
    
    if (isset($_POST['devolver_libro'])) {
        $isbn = htmlspecialchars($_POST['isbn_devolver']);
        
        if ($biblioteca->devolverLibro($isbn)) {
            $mensaje = "Libro devuelto con éxito.";
        } else {
            $mensaje = "Error: No se pudo devolver el libro.";
        }
    }
    
    if (isset($_POST['buscar'])) {
        $termino = htmlspecialchars($_POST['termino_busqueda']);
        $criterio = htmlspecialchars($_POST['criterio_busqueda']);
        $resultados = $biblioteca->buscarLibros($termino, $criterio);
    }
    
    if (isset($_POST['eliminar_libro'])) {
        $isbn = htmlspecialchars($_POST['isbn_eliminar']);
        
        if ($biblioteca->eliminarLibro($isbn)) {
            $mensaje = "Libro eliminado con éxito.";
        } else {
            $mensaje = "Error: No se pudo eliminar el libro.";
        }
    }
}

$libros = $biblioteca->getLibros();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Biblioteca</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Sistema de Gestión de Biblioteca</h1>
        </div>
    </header>
    
    <div class="container">
        <?php if (!empty($mensaje)): ?>
            <div class="alert <?php echo strpos($mensaje, 'éxito') !== false ? 'alert-success' : 'alert-danger'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        
        <div class="card">
            <h2>Agregar Nuevo Libro</h2>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input type="text" id="autor" name="autor" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" id="isbn" name="isbn" required>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoría</label>
                        <input type="text" id="categoria" name="categoria" required>
                    </div>
                    <div class="form-group">
                        <label for="anio_publicacion">Año de Publicación</label>
                        <input type="number" id="anio_publicacion" name="anio_publicacion" required min="1000" max="<?php echo date('Y'); ?>">
                    </div>
                </div>
                
                <button type="submit" name="agregar_libro">Agregar Libro</button>
            </form>
        </div>
        
        <div class="card">
            <h2>Buscar Libros</h2>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="termino_busqueda">Término de Búsqueda</label>
                        <input type="text" id="termino_busqueda" name="termino_busqueda" required>
                    </div>
                    <div class="form-group">
                        <label for="criterio_busqueda">Criterio de Búsqueda</label>
                        <select id="criterio_busqueda" name="criterio_busqueda">
                            <option value="titulo">Título</option>
                            <option value="autor">Autor</option>
                            <option value="categoria">Categoría</option>
                            <option value="isbn">ISBN</option>
                        </select>
                    </div>
                </div>
                <button type="submit" name="buscar">Buscar</button>
            </form>
            
            <?php if (isset($resultados) && !empty($resultados)): ?>
                <div class="search-results">
                    <h3>Resultados de la Búsqueda</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>ISBN</th>
                                <th>Categoría</th>
                                <th>Año</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados as $libro): ?>
                                <tr>
                                    <td><?php echo $libro->getTitulo(); ?></td>
                                    <td><?php echo $libro->getAutor(); ?></td>
                                    <td><?php echo $libro->getIsbn(); ?></td>
                                    <td><?php echo $libro->getCategoria(); ?></td>
                                    <td><?php echo $libro->getAnioPublicacion(); ?></td>
                                    <td class="<?php echo $libro->estaPrestado() ? 'status-prestado' : 'status-disponible'; ?>">
                                        <?php echo $libro->estaPrestado() ? 'Prestado' : 'Disponible'; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif (isset($resultados) && empty($resultados)): ?>
                <p>No se encontraron resultados.</p>
            <?php endif; ?>
        </div>
        
        <div class="card">
            <h2>Gestión de Préstamos</h2>
            <div class="form-row">
                <div class="form-group">
                    <h3>Prestar Libro</h3>
                    <form method="POST">
                        <div class="form-group">
                            <label for="isbn_prestar">ISBN del Libro</label>
                            <input type="text" id="isbn_prestar" name="isbn_prestar" required>
                        </div>
                        <div class="form-group">
                            <label for="usuario">Nombre del Usuario</label>
                            <input type="text" id="usuario" name="usuario" required>
                        </div>
                        <button type="submit" name="prestar_libro" class="btn-success">Prestar Libro</button>
                    </form>
                </div>
                
                <div class="form-group">
                    <h3>Devolver Libro</h3>
                    <form method="POST">
                        <div class="form-group">
                            <label for="isbn_devolver">ISBN del Libro</label>
                            <input type="text" id="isbn_devolver" name="isbn_devolver" required>
                        </div>
                        <button type="submit" name="devolver_libro">Devolver Libro</button>
                    </form>
                </div>
            </div>
        </div>
        
        <h2 class="section-title">Inventario de Libros</h2>
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>ISBN</th>
                        <th>Categoría</th>
                        <th>Año</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($libros)): ?>
                        <?php foreach ($libros as $libro): ?>
                            <tr>
                                <td><?php echo $libro->getTitulo(); ?></td>
                                <td><?php echo $libro->getAutor(); ?></td>
                                <td><?php echo $libro->getIsbn(); ?></td>
                                <td><?php echo $libro->getCategoria(); ?></td>
                                <td><?php echo $libro->getAnioPublicacion(); ?></td>
                                <td class="<?php echo $libro->estaPrestado() ? 'status-prestado' : 'status-disponible'; ?>">
                                    <?php echo $libro->estaPrestado() ? 'Prestado' : 'Disponible'; ?>
                                </td>
                                <td>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="isbn_eliminar" value="<?php echo $libro->getIsbn(); ?>">
                                        <button type="submit" name="eliminar_libro" class="btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center;">No hay libros en el inventario.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>