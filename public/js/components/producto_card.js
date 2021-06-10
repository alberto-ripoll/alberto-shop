class ProductoCard extends HTMLElement{

    constructor(){
        super();
    }

     async connectedCallback() {
        this.attachShadow({mode: 'open'})
            .innerHTML = `
            <link href="css/styles.css" rel="stylesheet" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
            `+
            await this.loadHTML();
     }

    async getProducto(id){
        const res = await axios.get(
            `http://desarrollo.zataca.com/api/producto?id=${id}`
          );
          return res.data.producto;
    }

    async loadHTML(){

        let IDProducto = this.getAttribute('producto');
        const producto = await this.getProducto(IDProducto);
        let shopContent = ``;
          shopContent += `
          <div class="col mb-5">
          <div class="card h-100">
              <!-- Product image-->
              <div style="height: 400px; display:flex; flex-direction:column;">
              <div>
                <img class="card-img-top" src="${producto.image}" alt="..." />
              </div> 
                <!-- Product details-->
                <div class="card-body" style="
                display: flex;
                align-items: center;
                justify-content: center;
            ">
                    <div class="text-center mt-auto">
                        <!-- Product name-->
                        <h5 class="fw-bolder">${producto.nombre}</h5>
                        <!-- Product reviews-->
                         <div class="d-flex justify-content-center small text-warning mb-2">
                         `;
                         for (let index = 0; index < producto.puntuacion; index++) {
                          shopContent +=`
                          <div class="bi-star-fill"></div>
                            `                        
                        }
                        shopContent+=`</div>
                        <!-- Product price-->
                        $${producto.precio}
                    </div>
                </div>
                </div> 
             
              <hr>

              <!-- Product actions-->
              <div class="card-footer pt-0 border-top-0 bg-transparent">
                  <div class="text-center p-2"><a data-link href=/productos/${producto.id} class="btn btn-outline-blue mt-auto">Más información</a></div>
                  <div class="text-center p-2"><button onclick="this.getRootNode().host.addtoCart(${producto.id})" class="btn btn-outline-dark mt-auto addToCart" data-id="${producto.id}">Añadir al carrito</button></div>
              </div>
          </div>
      </div>
          `;
        return shopContent;
    }
    async addtoCart(id) {
        const newProducto = await this.getProducto(id);
        let productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
        let indice = productosLocalStorage.findIndex(
          (producto) => producto.id == newProducto.id
        );
        if (indice == -1) {
          newProducto.cantidad = 1;
          productosLocalStorage.push(newProducto);
        } else {
          newProducto.cantidad = productosLocalStorage[indice].cantidad + 1;
          productosLocalStorage[indice] = newProducto;
        }
        localStorage.setItem("productos", JSON.stringify(productosLocalStorage));
        document.querySelector("#cantidadCarrito").innerText = parseInt(document.querySelector("#cantidadCarrito").innerText) + 1;
        this.emitEvent(id);
        // updateCartHTML();
    }
    emitEvent(id){
        const addToCartEvent = new CustomEvent("addToCart", {
            detail: {
              id: id,
            },
            bubbles: true,
            composed: true
          });
          this.dispatchEvent(addToCartEvent);
    }
}

window.customElements.define('producto-card',ProductoCard);