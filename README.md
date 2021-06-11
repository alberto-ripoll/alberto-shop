Agradecimientos a **Jonathan** y sus magníficas dotes como profesor

# **🎯 alberto-engine 🎯**

Este proyecto consiste en crear un framework propio para entender como funcionan los enrutadores, middlewares, resolucion de vistas, inyección de dependencias, respuestas HTTP de los framework, sin que parezca brujería...

## **📁 ESTRUCTURA DE CARPETAS 📁**

*  📁 app
       
        Nuestra lógica de negocio, el código backend en si mismo (Controladores, Middlewares, Modelos, Rutas, Providers) se encuentran en esta carpeta.

*  📁 config
    
        Las configuraciones que necesite nuestro proyecto (parámetros de las bases de datos, conversión de nombres de carpetas para que casen 
        con el estándar PSR4, o el que queramos utilizar...) se encuentran aquí

*  📁 framework
            
        Aquí está la comúnmente denominada "brujería" o "magia negra" con la que nos referimos los programadores Junior cuando no conocemos la 
        parte que conforma framework. Esta carpeta contiene la lógica interna del framework, se encuentran las clases bases que serán heredadas por 
        los controladores y facilitarán el desarrollo, la resolución de rutas, el contenedor de dependencias... 
        Esta carpeta debe ser completamente independendiente al proyecto que se quiere realizar. Se adjunta más información sobre el funcionamiento
        del framework en el siguiente apartado.

*  📁 public
        
        Contendrá el archivo index.php en el que definiremos la configuración de nuestro core(núcleo del framework), pasaremos nuestra configuración de
        rutas, proveedores y middlewares que se usarán para TODA LA APLICACIÓN.
        Además, habrá una subcarpeta con el contenido de nuestro front-end.
            📁 front-end
                Es la carpeta accesible por cualquier usuario, el front-end de nuestra aplicación(vistas HTML, estilos CSS, imágenes, Javascript)
            
*  📁 src
        
        Cada dominio estará formado por
            📁 Domain
            📁 Application
            📁 Infrastructure
    
*  📁 storage
        
        Los archivos que queramos almacenar según la lógica de nuestra aplicación (imágenes de usuario, documentos que generemos), que se puedan 
        descargar por el usuario se almacenarán en esta carpeta.


## **🛠️ FUNCIONAMIENTO INTERNO DEL FRAMEWORK 🛠️**

   **📁 framework**
*  📝 Autoloader: Carga nuestras clases cuando se inician en cualquier punto de la aplicación
*  📝 Core: Se encarga de cargar todos nuestras rutas, miiddlewares y providers.
*  📁 DB
    *  📝 Connector: Es el encargado de realizar la conexión a la base de datos especificada en el archivo de configuración. Incluye métodos para comprobar que la conexión está activa
    *  📝 QueryBuilder: Contiene métodos para preparar las consulas, comprobar la conexión, realizar commits y rollbacks..


* 📁 Modulos
    *  📝 Contenedor: Es el inyector de dependencias, que se encarga de instanciar los objetos que le pasamos a alguna clase por el constructor.
    *  📝 Controller: Clase base con atributos y metodos que serán heredados por los controladores de nuestra aplicación.
    *  📝 CustomException: Clase base que podrán heredar nuestras excepciones para crear excepciones personalizadas.
    *  📝 Middleware: Clase base que se herederará en Router Handler
    *  📝 Request: Contiene información sobre la variable global Server y Request, y se encarga de almacenar la información de estas.
    *  📝 Response: Llama a la vista con los datos necesarios y cierra el ciclo de la petición
    *  📝 Router: Contiene todas las rutas de la aplicación y se encarga de devolver el controlador asignado a cada ruta.
    *  📝 RouterHandler: Manejador de rutas. Ejecuta el método del controlador que reciba desde el Router y devuelve una respuesta
    *  📝 Session: Contiene información sobre la variable global de la sesión de PHP.
    *  📝 View: Encargada de mostrar la vista recibida por la response.
