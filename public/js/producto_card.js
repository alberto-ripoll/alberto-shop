class ProductoCard extends HTMLElement{

    constructor(){
        super();
    }

     async connectedCallback() {
        this.attachShadow({mode: 'open'})
            .innerHTML = `<link href="css/styles.css" rel="stylesheet" />`+
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
              <img class="card-img-top" src="${producto.image}" alt="..." />
              <!-- Product details-->
              <div class="card-body p-4">
                  <div class="text-center">
                      <!-- Product name-->
                      <h5 class="fw-bolder">${producto.nombre}</h5>
                      <!-- Product reviews-->
                       <div class="d-flex justify-content-center small text-warning mb-2">
                       `;
                       for (let index = 0; index < producto.puntuacion; index++) {
                        shopContent+=`<div class="bi-star-fill"></div>`
                         
                       }
                      shopContent+=`</div>
                      <!-- Product price-->
                      $${producto.precio}
                  </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                  <div class="text-center"><a class="btn btn-outline-blue mt-auto" href="/producto?id=${producto.id}">Más información</a></div>
                  <hr>
                  <div class="text-center"><button onclick="this.getRootNode().host.addtoCart(${producto.id})" class="btn btn-outline-dark mt-auto addToCart" data-id="${producto.id}">Añadir al carrito</button></div>
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