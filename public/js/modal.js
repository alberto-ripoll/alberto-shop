class Modal extends HTMLElement {
  carritoHTML = ``;
  updateCartHTML() {
   let productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    this.carritoHTML = ``;
    let cantidad = 0;
    productosLocalStorage.forEach((producto) => {
      this.carritoHTML += `
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
    //   console.log(document.querySelector("#carrito"));

    // document.querySelector("#carrito").innerHTML = this.carritoHTML;
    });

    // btnsAumentar = document.querySelectorAll(`.aumentar`);
    // btnsAumentar.forEach((btn) => {
    //   btn.addEventListener("click", (event) => {
    //     console.log('AUMENTAR',event.target.dataset.id);
    //     aumentarCantidad(event.target.dataset.id);
    //   });
    // });
    // btnsReducir = document.querySelectorAll(`.reducir`);
    // btnsReducir.forEach((btn) => {
    //   btn.addEventListener("click", (event) => {
    //     console.log('REDUCIR',event.target.dataset.id);
   
    //     reducirCantidad(event.target.dataset.id);
    //   });
    // });
    // btnsEliminar = document.querySelectorAll(`.eliminar`);
    // btnsEliminar.forEach((btn) => {
    //   btn.addEventListener("click", (event) => {
    //     console.log('eliminar',event.target.dataset.id);
   
    //     sacarDelCarrito(event.target.dataset.id);
    //   });
    // });
    // document.querySelector("#cantidadCarrito").innerHTML = cantidad;
    // if (document.querySelector("#cantidadCarrito").innerHTML == 0) {
    //   document.querySelector("#cnt-finalizarCompra").style.visibility =
    //     "hidden";
    // } else {
    //   document.querySelector("#cnt-finalizarCompra").style.visibility =
    //     "visible";
    // }
  }

  aumentarCantidad(id) {
    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let indice = productosLocalStorage.findIndex(
      (producto) => producto.id == id
    );
    productosLocalStorage[indice].cantidad = productosLocalStorage[indice].cantidad + 1;
    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    updateCartHTML();
  }
  reducirCantidad(id) {
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
  sacarDelCarrito(id) {

    console.log("SACAR", id);

    let productosLocalStorage = JSON.parse(localStorage.getItem("productos"));

    productosLocalStorage = productosLocalStorage.filter(
      (producto) => producto.id !== id
    );

    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    updateCartHTML();
  }
  static get observedAttributes() {
    return ["visible", "title",'update'];
  }

  attributeChangedCallback(name, oldValue, newValue) {
    if (name === "title" && this.shadowRoot) {
      this.shadowRoot.querySelector(".title").textContent = newValue;
    }
    if (name === "visible" && this.shadowRoot) {
      if (newValue === 'false') {
        this.shadowRoot.querySelector(".wrapper").classList.remove("visible");
      } else {
        this.shadowRoot.querySelector(".wrapper").classList.add("visible");
      }
    }
    if (name === "update" && this.shadowRoot) {
      this.updateCartHTML();
      this.removeAttribute("visible");

    }
  }
  get title() {
    return this.getAttribute("title");
  }

  set title(value) {
    this.setAttribute("title", value);
  }
  get visible() {
    return this.hasAttribute("visible");
  }

  set visible(value) {
    if (value) {
      this.setAttribute("visible", "");
    } else {
      this.removeAttribute("visible");
    }
  }
    constructor() {
      super();
    }
  
    connectedCallback() {
    this._render();

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
    _render() {
      this.updateCartHTML();
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
            background-color: transparent;
            opacity: 0.5;
            visibility: hidden;
            transform: scale(1.1);
            transition: visibility 0s linear .25s,opacity .25s 0s,transform .25s;
            z-index: 9999;
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
            height:400px;
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

        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <div class='${wrapperClass}'>
          <div class='modal'>
            <span class='title'>${this.title}</span>
            <div class='content'>
              <table>
              <thead>
                  <tr>
                      <th>PRODUCTO</th>    
                      <th>IMAGEN</th> 
                      <th colspan="3">CANTIDAD</th>    
                      <th>PRECIO</th>   
                  </tr>
              </thead>
              <tbody id="carrito">
                ${this.carritoHTML}
              </tbody>
              </table>

            </div>
            <div class='button-container'>
            <button class='cancel'>Cancel</button>
            <button class='ok'>Okay</button>
          </div>
          </div>
        </div>`;
  
      const shadowRoot = this.attachShadow({ mode: "open" });
      shadowRoot.appendChild(container);
      this._attachEventHandlers();

    }
  }
  window.customElements.define("x-modal", Modal);