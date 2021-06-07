const nav_template = document.createElement('template');
nav_template.innerHTML = `
<link href="css/styles.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

<nav style="position: fixed;z-index: 1;width: 100%;" class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container px-4 px-lg-5">
    <a class="navbar-brand" href="/">Alberto-Shop</a>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                         <li class="nav-item dropdown">
                             <a class="btn btn-outline-dark dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi-cart-fill me-1"></i>Carrito<span id="cantidadCarrito" class="badge bg-dark text-white ms-1 rounded-pill">0</span></a>
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

                         </ul>        <div id="cnt-finalizarCompra">
        <a href="/pay" class="btn btn-outline-green"><i class="bi bi-currency-bitcoin"></i>Finalizar compra</a>
    </div>
    </div>

    <a class="btn btn-outline-dark" href="/login">Iniciar sesión</a>
    <a class="btn btn-outline-dark" href="/signin">Crear cuenta</a>
</li>
    </div>
</div>
</nav>`
{/* <slot name="carrito"></slot> 
<link href="css/styles.css" rel="stylesheet" />
*/}

class Navbar extends HTMLElement{
    constructor(){
        super();

    }
        connectedCallback() {
            this.attachShadow({mode: 'open'});
            this.shadowRoot.appendChild(nav_template.content.cloneNode(true));
        }

   }


window.customElements.define('app-navbar',Navbar);