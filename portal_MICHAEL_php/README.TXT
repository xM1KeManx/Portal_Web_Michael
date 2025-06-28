# Portal Web PHP con APIs Externas

## Descripción

Este proyecto es un portal web desarrollado en PHP que integra **10 APIs externas** para ofrecer distintas funcionalidades dinámicas. Utiliza el framework CSS **Bulma** para el diseño responsivo y **Animate.css** para animaciones visuales.

El objetivo principal es mostrar cómo se pueden consumir y mostrar datos de APIs externas en un sitio web sencillo y organizado, como parte de un proyecto académico.

---

## Funcionalidades

El portal incluye las siguientes secciones, cada una basada en una API externa distinta:

- **Predicción de Género:** Estima el género probable de un nombre dado.
- **Predicción de Edad:** Estima la edad probable de una persona según el nombre.
- **Universidades:** Busca y muestra información sobre universidades.
- **Clima:** Consulta el clima actual de una ciudad o país.
- **Pokémon:** Muestra datos de Pokémon específicos.
- **Noticias:** Trae noticias actuales y relevantes.
- **Monedas:** Muestra la tasa de cambio y datos sobre diferentes monedas.
- **Imágenes:** Busca y muestra imágenes según términos indicados.
- **Datos de País:** Información general sobre países.
- **Chistes:** Muestra chistes aleatorios, incluyendo chistes oscuros.

---

## Tecnologías utilizadas

- **PHP:** Lenguaje backend para consumir APIs y generar contenido dinámico.
- **Bulma:** Framework CSS para diseño responsivo y estético.
- **Animate.css:** Librería para animaciones CSS en los elementos.
- **APIs externas:** Varias APIs REST para obtener los datos mostrados.

---

## Estructura del Proyecto

- `index.php`: Página principal de bienvenida.
- `genero.php`, `edad.php`, `universidades.php`, etc.: Páginas individuales para cada API.
- `includes/header.php` y `includes/footer.php`: Encabezado y pie común para todas las páginas.
- `css/custom.css`: Estilos personalizados.
- `img/`: Carpeta con imágenes usadas (foto, iconos, etc.).

---

## ¿Cómo funciona?

1. **Interfaz Frontend:** El usuario navega por el portal a través de un menú de navegación fijo.
2. **Petición a APIs:** Cada página envía solicitudes HTTP a la API externa correspondiente usando funciones PHP (`file_get_contents` o cURL).
3. **Procesamiento de datos:** La respuesta JSON recibida se decodifica y procesa para mostrar la información relevante.
4. **Presentación:** Los datos se muestran en HTML con estilos Bulma y animaciones Animate.css para mejorar la experiencia visual.
5. **Interactividad:** Algunas páginas permiten ingresar datos (por ejemplo, nombre para predicción de edad/género).

---

## Cómo ejecutar el proyecto

1. Clona o descarga el repositorio en tu servidor local con PHP (XAMPP, WAMP, etc.).
2. Asegúrate de tener conexión a internet para que las APIs funcionen.
3. Accede a `index.php` desde tu navegador para iniciar.
4. Navega por las distintas secciones usando el menú superior.

---

## Autor

**Michael Emmanuel Sosa Arias**  
Proyecto académico — Portal Web PHP con APIs externas.

---

## Licencia

Este proyecto es para fines educativos y académicos.

