Sistema de Gestión de Bibliotecas en PHP
Un sistema completo de gestión de bibliotecas desarrollado con PHP utilizando Programación Orientada a Objetos (POO), con una interfaz web moderna y responsive.

🚀 Características
Gestión completa de libros: Agregar, editar, eliminar y buscar libros

Sistema de préstamos: Registrar préstamos y devoluciones de libros

Búsqueda avanzada: Buscar libros por título, autor, categoría o ISBN

Interfaz moderna: Diseño responsive que se adapta a dispositivos móviles

Persistencia de datos: Los datos se mantienen entre sesiones mediante almacenamiento en sesión

Programación Orientada a Objetos: Implementación de los principios de POO

🛠️ Tecnologías Utilizadas
PHP 7.4+: Lenguaje de programación del lado del servidor

HTML5: Estructura de la interfaz web

CSS3: Estilos y diseño responsive

Programación Orientada a Objetos: Encapsulación, herencia, polimorfismo y abstracción

📋 Requisitos Previos
Servidor web con PHP 7.4 o superior (XAMPP, WAMP, o servidor PHP integrado)

Navegador web moderno

🚀 Instalación y Configuración
Clona el repositorio: 
git clone https://github.com/Vic2910/Proyecto-Bibliotech-Gesti-n-de-Libros-en-PHP

Navega al directorio del proyecto:
cd Proyecto-Bibliotech-Gesti-n-de-Libros-en-PHP

Si estás usando XAMPP/WAMP, copia la carpeta del proyecto a htdocs (XAMPP) o www (WAMP)

Inicia tu servidor web y PHP

Abre tu navegador y visita:
http://localhost/Proyecto-Bibliotech-Gesti-n-de-Libros-en-PHP

Ejecutar con PHP Server integrado (VS Code)
Abre el proyecto en VS Code

Instala la extensión "PHP Server" si no la tienes

Haz clic derecho en index.php y selecciona "PHP Server: Serve project"

El navegador se abrirá automáticamente con la aplicación

📖 Estructura del Proyecto
PHPBiblioteca/
├── index.php              # Archivo principal de la aplicación
├── classes/               # Directorio de clases
│   ├── Biblioteca.php     # Clase para gestionar la biblioteca
│   └── Libro.php          # Clase que representa un libro
└── README.md              # Este archivo

🎯 Funcionalidades
Gestión de Libros
Agregar nuevos libros con título, autor, ISBN, categoría y año de publicación

Eliminar libros existentes

Buscar libros por diferentes criterios

Visualizar todos los libros en un inventario organizado

Sistema de Préstamos
Registrar préstamos de libros a usuarios

Registrar devoluciones de libros

Visualizar el estado de disponibilidad de cada libro

Búsqueda Avanzada
Búsqueda por título, autor, categoría o ISBN

Resultados en tiempo real

Interfaz intuitiva para realizar búsquedas

🎨 Diseño de la Interfaz
La interfaz ha sido diseñada con:

Esquema de colores profesional y armonioso

Diseño responsive que se adapta a diferentes tamaños de pantalla

Tarjetas para organizar el contenido de forma clara

Formularios intuitivos y fáciles de usar

Mensajes de retroalimentación para el usuario

Indicadores visuales del estado de los libros (disponible/prestado)

🧩 Clases y Estructura POO
Clase Libro
Representa un libro con todas sus propiedades y métodos relacionados:

Propiedades: título, autor, ISBN, categoría, año de publicación, estado de préstamo

Métodos: getters, setters, prestar(), devolver()

Clase Biblioteca
Gestiona la colección de libros y las operaciones relacionadas:

Métodos: agregarLibro(), eliminarLibro(), buscarLibros(), prestarLibro(), devolverLibro()

🔧 Personalización
Puedes personalizar el sistema modificando:

Los colores en la sección :root del CSS

Los libros de ejemplo en la inicialización

Los campos de los libros editando la clase Libro

Las funcionalidades extendiendo las clases existentes

📝 Próximas Mejoras
Algunas ideas para futuras versiones:

Implementación de base de datos para persistencia permanente

Sistema de usuarios con autenticación

Historial de préstamos

Fechas de vencimiento para préstamos y sistema de multas

Exportación de datos a CSV o PDF

API REST para integración con otros sistemas

🐛 Solución de Problemas
Error común: "The script tried to call a method on an incomplete object"
Solucionado en la versión actual asegurando que las clases se carguen antes de iniciar la sesión.

Los cambios no se reflejan
Si usas el servidor de sesiones de PHP, recuerda que los datos persisten entre recargas. Para reiniciar, puedes limpiar las cookies de tu navegador o reiniciar el servidor.

📄 Licencia
Este proyecto está bajo la Licencia MIT. Ver el archivo LICENSE para más detalles.

👥 Contribuciones
Las contribuciones son bienvenidas. Por favor:

Haz un fork del proyecto

Crea una rama para tu feature (git checkout -b feature/AmazingFeature)

Commit tus cambios (git commit -m 'Add some AmazingFeature')

Push a la rama (git push origin feature/AmazingFeature)

Abre un Pull Request

📞 Contacto
Si tienes preguntas o sugerencias, no dudes en contactarnos a través de los issues del repositorio.
