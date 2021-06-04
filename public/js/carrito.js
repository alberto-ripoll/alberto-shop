const carrito_template = document.createElement('template');
{/* <link href="css/styles.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script> */}
carrito_template.innerHTML = `
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
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
                 </div> `
class Carrito extends HTMLElement{
    constructor(){
        super();
    }
        connectedCallback() {
            this.attachShadow({mode: 'open'})
            this.shadowRoot.appendChild(carrito_template.content.cloneNode(true));
        }
        updateCartHTML() {
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
             document.querySelector("#cnt-finalizarCompra").style.visibility =
               "hidden";
           } else {
             document.querySelector("#cnt-finalizarCompra").style.visibility =
               "visible";
           }
         }
   }


window.customElements.define('app-carrito',Carrito);