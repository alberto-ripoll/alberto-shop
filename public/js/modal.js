class Carrito extends HTMLElement {
  carritoHTML = ``;
  visible = false;
  updateCartHTML() {
   let productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    this.carritoHTML = ``;
    let cantidad = 0;
    productosLocalStorage.forEach((producto) => {
      this.carritoHTML += `
      <tr>
        <td>${producto.nombre}</td>
        <td><img height="100px" width="100px" src="${producto.image}" alt="..." /></td> 
        <td><button onclick="this.getRootNode().host.reducirCantidad(${producto.id})" class="reducir btn" data-id='${producto.id}'><i class="fas fa-arrow-down"></i></button></td> 
        <td>${producto.cantidad}</td> 
        <td><button onclick="this.getRootNode().host.aumentarCantidad(${producto.id})" class="aumentar btn" data-id='${producto.id}'><i class="fas fa-arrow-up"></i></button></td> 
        <td>${producto.precio}€</td> 
        <td><button onclick="this.getRootNode().host.sacarDelCarrito(${producto.id})" class="eliminar btn" data-id='${producto.id}'><i class="fas fa-trash"></i></button></td> 
        </tr>
      `;
      cantidad += producto.cantidad;
    });
    this.shadowRoot.querySelector('#carrito').innerHTML = this.carritoHTML;

    document.querySelector("#cantidadCarrito").innerHTML = cantidad;

  }

  aumentarCantidad(id) {
    this.dispatchEvent(new CustomEvent("ok"))

    let productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let indice = productosLocalStorage.findIndex(
      (producto) => producto.id == id
    );
    productosLocalStorage[indice].cantidad = productosLocalStorage[indice].cantidad + 1;
    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    this.updateCartHTML();
  }
  reducirCantidad(id) {
    this.dispatchEvent(new CustomEvent("ok"))

    let productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let indice = productosLocalStorage.findIndex(
      (producto) => producto.id == id
    );
    productosLocalStorage[indice].cantidad = productosLocalStorage[indice].cantidad - 1;
    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    if (productosLocalStorage[indice].cantidad == 0) {
      this.sacarDelCarrito(id);
    }

    this.updateCartHTML();
  }
  sacarDelCarrito(id) {
    this.dispatchEvent(new CustomEvent("ok"))

    console.log("SACAR", id);

    let productosLocalStorage = JSON.parse(localStorage.getItem("productos"));

    productosLocalStorage = productosLocalStorage.filter(
      (producto) => producto.id != id
    );
    console.log(productosLocalStorage);

    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    this.updateCartHTML();
  }
  static get observedAttributes() {
    return ["visible", "title",'update'];
  }

  attributeChangedCallback(name, oldValue, newValue) {
    if (name == "title" && this.shadowRoot) {
      this.shadowRoot.querySelector(".title").textContent = newValue;
    }
    if (name == "visible" && this.shadowRoot) {
      if (newValue == 'false') {
        this.shadowRoot.querySelector(".wrapper").classList.remove("visible");
      } else {
        this.shadowRoot.querySelector(".wrapper").classList.add("visible");
        this.updateCartHTML();
      }
    }
    if (name == "update" && this.shadowRoot) {
      this.updateCartHTML();
      this.visible = false;

    }
  }
  get title() {
    return this.getAttribute("title");
  }

  set title(value) {
    this.setAttribute("title", value);
  }
  get visible() {
    return this.getAttribute("visible");
  }

  set visible(value) {
    this.setAttribute("visible", value);

  }
    constructor() {
      super();
    }
  
    connectedCallback() {
    this._render();
    this._attachEventHandlers();
    }

    _attachEventHandlers() {
      const cancelButton = this.shadowRoot.querySelector(".cancel");
      cancelButton.addEventListener('click', e => {
        this.dispatchEvent(new CustomEvent("cancel"))
        this.visible = false;
      });
      const okButton = this.shadowRoot.querySelector(".ok");
      okButton.addEventListener('click', e => {
        this.dispatchEvent(new CustomEvent("ok"))
        this.visible = false;
      });

    }
    vaciarCarrito(){
      let productosLocalStorage = [];
      localStorage.setItem("productos", JSON.stringify(productosLocalStorage));
      this.updateCartHTML();
    }
    _render() {
      const wrapperClass = this.visible ? "wrapper visible" : "wrapper";

      const container = document.createElement("div");
      container.innerHTML = `
        <style>
          .wrapper {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #212529;
            opacity: 0.5;
            visibility: hidden;
            transform: scale(1.1);
            transition: visibility 0s linear .25s,opacity .25s 0s,transform .25s;
            z-index: 1;
          }
          .visible {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
            transition: visibility 0s linear 0s,opacity .25s 0s,transform .25s;
            cursor:auto;
          }
          .modal {
            color:black !important;
            font-family: Helvetica;
            font-size: 14px;
            padding: 10px 10px 5px 10px;
            background-color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            border-radius: 2px;
            min-width: 300px;
            background-color:white;
            min-height:400px;
            width:800px;
            display:flex;
            flex-direction:column;
            justify-content:space-around;
          }
          .title {
            font-size: 18px;
          }
          .button-container {
            margin-top:auto;
            display:flex;
            align-items:center;
            justify-content:space-around;
          }
          button {
            min-width: 80px;
            background-color: #848e97;
            border-color: #848e97;
            border-style: solid;
            border-radius: 2px;
            padding: 3px;
            color:white;
            cursor: pointer;
          }
          .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
               -moz-user-select: none;
                -ms-user-select: none;
                    user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
          }
          .eliminar{
            color: red;
          }
          .aumentar{
            color: green;
          }
          .reducir{
            color:grey;
          }

        </style>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <div class='${wrapperClass}'>
          <div class='modal'>
            <span class='title'>${this.title}</span>
              <table>
              <thead>
                  <tr>
                      <th>PRODUCTO</th>    
                      <th>IMAGEN</th> 
                      <th colspan="3">CANTIDAD</th>    
                      <th>PRECIO</th>   
                      <th>X</th>   

                  </tr>
              </thead>
              <tbody id="carrito">
                ${this.carritoHTML}
              </tbody>
              </table>

            <div class='button-container'>
            <button onclick="this.getRootNode().host.vaciarCarrito()" class='cancel'>Vaciar carrito</button>
            <button class='ok'>Comprar</button>
          </div>
          </div>
        </div>`;
  
      this.attachShadow({ mode: "open" });
      // shadowRoot.appendChild(container);
      this.shadowRoot.appendChild(container.cloneNode(true));

      this.updateCartHTML();

    }
  }
  window.customElements.define("x-modal", Carrito);