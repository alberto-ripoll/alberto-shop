// const nav_template = document.createElement('template');
// nav_template.innerHTML = `
// <nav style="position: fixed;z-index: 1;width: 100%;" class="navbar navbar-expand-lg navbar-light bg-light">
// <div class="container px-4 px-lg-5">
//     <a class="navbar-brand" href="/">Alberto-Shop</a>
//     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
//     <div class="collapse navbar-collapse" id="navbarSupportedContent">
//         <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
//             <li class="nav-item dropdown">
//                 <a class="btn btn-outline-dark dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi-cart-fill me-1"></i>Carrito<span id="cantidadCarrito" class="badge bg-dark text-white ms-1 rounded-pill">0</span></a>
//                 <table style="left:-100px;position:absolute;width:50rem;" class="dropdown-menu"  aria-labelledby="navbarDropdown">
//                 <thead>
//                     <tr>
//                         <th>PRODUCTO</th>    
//                         <th>IMAGEN</th> 
//                         <th colspan="3">CANTIDAD</th>    
//                         <th>PRECIO</th>   
//                     </tr>
//                 </thead>
//                 <tbody id="carrito">
//                 </tbody>

//                 </table>
//             </li>
//             <div id="cnt-finalizarCompra">
//                         <a href="/pay" class="btn btn-outline-green"><i class="bi bi-currency-bitcoin"></i>Finalizar compra</a>
//                     </div>
//         </ul>


// </li>
//     </div>
// </div>
// </nav>
// `
// <?php if (isset($_SESSION['logged'])):?>
// <a class="btn btn-outline-dark" href="/logout">Cerrar sesion</a>
// <?php else:?>
//     <a class="btn btn-outline-dark" href="/signin">Crear cuenta</a>

// <a class="btn btn-outline-dark" href="/login">Iniciar sesion</a>
// <?php endif?>
class Navbar extends HTMLElement{
    constructor(){
        super();
        this.innerHTML = `
        <nav style="position: fixed;z-index: 1;width: 100%;" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/">Alberto-Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item dropdown">
                        <a class="btn btn-outline-dark dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi-cart-fill me-1"></i>Carrito<span id="cantidadCarrito" class="badge bg-dark text-white ms-1 rounded-pill">0</span></a>
                        <table style="left:-100px;position:absolute;width:50rem;" class="dropdown-menu"  aria-labelledby="navbarDropdown">
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
        
        
        </li>
            </div>
        </div>
        </nav>
        `;
        // this.attachShadow({mode: 'open'});
        // this.shadowRoot.appendChild(nav_template.content.cloneNode(true));
        // // this.shadowRoot.querySelector('h1').innerText = this.getAttribute('message');
        // // this.innerHTML = `${this.getAttribute('message')}`;
    }
}

window.customElements.define('app-navbar',Navbar);