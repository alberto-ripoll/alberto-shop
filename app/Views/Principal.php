<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Alberto Shop</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <app-navbar>
        <div slot="carrito">
            <button class="btn btn-outline-dark open"><i class="bi-cart-fill me-1"></i>Carrito<span id="cantidadCarrito" class="badge bg-dark text-white ms-1 rounded-pill">0</span></a>
            <x-modal title="Carrito de compra" visible="false"></x-modal>
        </div>
    </app-navbar>

    <!-- Header -->
    <?php if (isset($_SESSION['logged'])) : ?>
        <app-header id="header" viendo="" message="Hola de nuevo, <?= $_SESSION["usuario"] ?>"></app-header>
    <?php else : ?>
        <app-header id="header" viendo="" message="Bienvenido a la tienda"></app-header>
    <?php endif ?>

    <!-- Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ordenar por</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><button id="baratos" class="dropdown-item">Más baratos</button></li>
                <li><button id="valorados" class="dropdown-item">Mejores valorados</button></li>
                <li><button id="nuevos" class="dropdown-item">Más nuevos</button></li>
            </ul>
            <hr>
            <div id="shop-content" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <!-- Aqui se cargaran los productos de la tienda--> 
            </div>
        </div>
    </section>
    <!-- Footer-->
    <app-footer></app-footer> 
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/router.js"></script>

    <script src="js/principal.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/header.js"></script>
    <script src="js/producto_card.js"></script>
    <script src="js/carrito.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/footer.js"></script>

</body>

</html>