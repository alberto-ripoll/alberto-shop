import AbstractView from '../../AbstractView.js';

export default class Principal extends AbstractView {
    constructor(){
        super();
        this.setTitle('Tienda');
    }

    async getHtml(){
        return `
        <app-navbar>
        <div slot="carrito">
            <button class="btn btn-outline-dark open"><i class="bi-cart-fill me-1"></i>Carrito<span id="cantidadCarrito" class="badge bg-dark text-white ms-1 rounded-pill">0</span></a>
            <x-modal title="Carrito de compra" visible="false"></x-modal>
        </div>
    </app-navbar>

    <!-- Header -->
        <app-header id="header" viendo="" message="Bienvenido a la tienda"></app-header>

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
    <script src="../js/components/navbar.js"></script>
    <script src="../js/components/header.js"></script>
    <script src="../js/components/producto_card.js"></script>
    <script src="../js/components/carrito.js"></script>
    <script src="../js/components/modal.js"></script>
    <script src="../js/components/footer.js"></script>
        `
    }
}