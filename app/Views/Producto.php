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
<style>
    .eliminar {
        color: red;
    }

    .aumentar {
        color: green;
    }

    .reducir {
        color: grey;
    }

    .card-img-top {
        height: 19rem;
        width: 16rem;
    }

    td,
    th {
        padding: 1rem;
        text-align: center;
    }

    #cnt-finalizarCompra {
        visibility: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-left: 1rem;
    }

    .btn-outline-blue {
        border-color: #1167b1;
        color: #1167b1;
    }

    .btn-outline-blue:hover {
        background-color: #1167b1;
        color: white;
    }

    .btn-outline-green {
        border-color: green;
        color: green;
    }

    .btn-outline-green:hover {
        background-color: green;
        color: white;
    }
</style>

<body>
    <nav style="position: fixed;z-index: 1;width: 100%;" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/">Alberto-Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item dropdown">
                        <a class="btn btn-outline-dark dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi-cart-fill me-1"></i>Carrito<span id="cantidadCarrito" class="badge bg-dark text-white ms-1 rounded-pill">0</span></a>
                        <table style="left:-100px;position:absolute;width:50rem;" class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <thead>
                                <tr>
                                    <th>PRODUCTO</th>
                                    <th>IMAGEN</th>
                                    <th colspan="3">CANTIDAD</th>
                                    <th>PRECIO</th>
                                </tr>
                            </thead>
                            <tbody id="carrito">
                            </tbody>

                        </table>
                    </li>
                    <div id="cnt-finalizarCompra">
                        <a href="/pay" class="btn btn-outline-green"><i class="bi bi-currency-bitcoin"></i>Finalizar compra</a>
                    </div>
                </ul>


                <?php if (isset(($_SESSION['logged']))) : ?>
                    <a class="btn btn-outline-dark" href="/logout">Cerrar sesion</a>
                <?php else : ?>
                    <a class="btn btn-outline-dark" href="/signin">Crear cuenta</a>

                    <a class="btn btn-outline-dark" href="/login">Iniciar sesion</a>
                <?php endif ?>
            </div>
        </div>
    </nav>
    <!-- Header-->

    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <?php if (isset($_SESSION['logged'])) : ?>
                    <h1 class="display-4 fw-bolder">Hola de nuevo, <?= $_SESSION["usuario"] ?></h1>
                <?php else : ?>
                    <h1 class="display-4 fw-bolder">Bienvenido a la tienda</h1>
                <?php endif ?>
                <h3 style="display:block;height:1rem;" id="viendo"></h3>

            </div>
        </div>
    </header>
    <hr>
    <div id="shop-content" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <app-producto id="<?= $producto["id"] ?>"></app-producto>
    </div>
    </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Alberto-Shop 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/producto.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function (event) {
        function updateCartHTML() {
            productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
            let carrito = ``;
            let cantidad = 0;
            productosLocalStorage.forEach((producto) => {
            carrito += `
            <tr>
                <td>${producto.nombre}</td>
                <td><img height="100px" width="100px" src="${producto.image}" alt="..." /></td> 
                <td><button class="reducir btn" data-id='${producto.id}'><i class="fas fa-arrow-down"></i></button></td> 
                <td>${producto.cantidad}</td> 
                <td><button class="aumentar btn" data-id='${producto.id}'><i class="fas fa-arrow-up"></i></button></td> 
                <td>${producto.precio}</td> 
                <td><button class="eliminar btn" data-id='${producto.id}'><i class="fas fa-trash"></i></button></td> 
            </tr>
            `;
            cantidad += producto.cantidad;
            document.querySelector("#carrito").innerHTML = carrito;
            });
        
            btnsAumentar = document.querySelectorAll(`.aumentar`);
            btnsAumentar.forEach((btn) => {
            btn.addEventListener("click", (event) => {
                console.log('AUMENTAR',event.target.dataset.id);
                aumentarCantidad(event.target.dataset.id);
            });
            });
            btnsReducir = document.querySelectorAll(`.reducir`);
            btnsReducir.forEach((btn) => {
                btn.addEventListener("click", (event) => {
                console.log('REDUCIR',event.target.dataset.id);
                reducirCantidad(event.target.dataset.id);
                });
            });
            btnsEliminar = document.querySelectorAll(`.eliminar`);
            btnsEliminar.forEach((btn) => {
                btn.addEventListener("click", (event) => {
                console.log('eliminar',event.target.dataset.id);    
                sacarDelCarrito(event.target.dataset.id);
            });
            });
            document.querySelector("#cantidadCarrito").innerHTML = cantidad;
            if (document.querySelector("#cantidadCarrito").innerHTML == 0) {
                document.querySelector("#cnt-finalizarCompra").style.visibility ="hidden";
            } else {
                document.querySelector("#cnt-finalizarCompra").style.visibility = "visible";
            }
            }

        function aumentarCantidad(id) {
                productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
                let indice = productosLocalStorage.findIndex(
                (producto) => producto.id == id
                );
                productosLocalStorage[indice].cantidad = productosLocalStorage[indice].cantidad + 1;
                localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

            updateCartHTML();
        }
        function reducirCantidad(id) {
    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let indice = productosLocalStorage.findIndex(
      (producto) => producto.id == id
    );
    productosLocalStorage[indice].cantidad = productosLocalStorage[indice].cantidad - 1;
    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    if (productosLocalStorage[indice].cantidad == 0) {
      sacarDelCarrito(id);
    }

    updateCartHTML();
  }
  function sacarDelCarrito(id) {

    console.log("SACAR", id);

    let productosLocalStorage = JSON.parse(localStorage.getItem("productos"));

    productosLocalStorage = productosLocalStorage.filter(
      (producto) => producto.id !== id
    );

    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    updateCartHTML();
  }

  async function init() {
    document.addEventListener("addToCart", (event) => {
      updateCartHTML();
    });;
    if (localStorage.getItem("productos") === null) {
      // let productosLocalStorage = [];
      localStorage.setItem("productos", JSON.stringify([]));
    }
    updateCartHTML();
  }
  init();

            })
            </script>
</body>

</html>