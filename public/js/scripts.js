document.addEventListener("DOMContentLoaded", function (event) {

  async function getProductos() {
    const res = await axios.get(
      `http://desarrollo.zataca.com/api/productos`
    );
    return res.data.productos;
  }
async function loadProducts(){
  let productos = await getProductos();
  loadShopHTML(productos);
}
  function loadShopHTML(productos){
    let shopContent = ``;
    productos.forEach((producto) => {
      shopContent += `
      <app-producto producto=${producto.id}></app-producto>
      `;
    });
    document.querySelector("#shop-content").innerHTML = shopContent;
  }
  function loadBotones(){
    btnsAddToCart = document.querySelectorAll(".addToCart");
    btnsAddToCart.forEach((btn) => {
      btn.addEventListener("click", (event) => {
        addtoCart(event.target.dataset.id);
      });
    });
    btnBaratos = document.querySelector("#baratos");
    btnValorados = document.querySelector("#valorados");
    btnNuevo = document.querySelector("#nuevos");

    btnBaratos.addEventListener("click", () => {
      ordenarPor("baratos");
    });
    btnValorados.addEventListener("click", () => {
      ordenarPor("valorados");
    });
    btnNuevo.addEventListener("click", () => {
      ordenarPor("nuevos");
    });
  }
  async function init() {
    await loadProducts();
    loadBotones();

    if (localStorage.getItem("productos") === null) {
      // let productosLocalStorage = [];
      localStorage.setItem("productos", JSON.stringify([]));
    }
    // updateCartHTML();
  }

  async function ordenarPor(filtro) {
    let shopContent = document.querySelector("#shop-content");
    let res = await axios.get(`http://desarrollo.zataca.com/api/productos`);
    const productos = res.data.productos;

    if (filtro == "nuevos") {
      productos.sort(function (a, b) {
          return new Date(b.created_at) - new Date(a.created_at);
      });
      document.querySelector("#header").setAttribute('viendo','Viendo los más nuevos');

    }
    if (filtro == "valorados") {
      productos.sort(function (a, b) {
        return b.puntuacion - a.puntuacion;
      });
      document.querySelector("#header").setAttribute('viendo','Viendo los mejor valorados');

    }
    
    if (filtro == "baratos") {
      productos.sort(function (a, b) {
        return a.precio - b.precio;
      });
      document.querySelector("#header").setAttribute('viendo','Viendo los más económicos');
    }

    shopContent = ``;

    productos.forEach((producto) => {
      shopContent += `
      <app-producto producto=${producto.id}></app-producto>
      `;
    });
    document.querySelector("#shop-content").innerHTML = shopContent;
    loadBotones();
  }

  // function updateCartHTML() {
  //   productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
  //   let carrito = ``;
  //   let cantidad = 0;
  //   productosLocalStorage.forEach((producto) => {
  //     carrito += `
  //     <tr>
  //       <td>${producto.nombre}</td>
  //       <td><img height="100px" width="100px" src="${producto.image}" alt="..." /></td> 
  //       <td><button class="reducir btn" data-id='${producto.id}'><i class="fas fa-arrow-down"></i></button></td> 
  //       <td>${producto.cantidad}</td> 
  //       <td><button class="aumentar btn" data-id='${producto.id}'><i class="fas fa-arrow-up"></i></button></td> 
  //       <td>${producto.precio}</td> 
  //       <td><button class="eliminar btn" data-id='${producto.id}'><i class="fas fa-trash"></i></button></td> 
  //       </tr>
  //     `;
  //     cantidad += producto.cantidad;
  //   document.querySelector("#carrito").innerHTML = carrito;
  //   });

  //   btnsAumentar = document.querySelectorAll(`.aumentar`);
  //   btnsAumentar.forEach((btn) => {
  //     btn.addEventListener("click", (event) => {
  //       console.log('AUMENTAR',event.target.dataset.id);
  //       aumentarCantidad(event.target.dataset.id);
  //     });
  //   });
  //   btnsReducir = document.querySelectorAll(`.reducir`);
  //   btnsReducir.forEach((btn) => {
  //     btn.addEventListener("click", (event) => {
  //       console.log('REDUCIR',event.target.dataset.id);

  //       reducirCantidad(event.target.dataset.id);
  //     });
  //   });
  //   btnsEliminar = document.querySelectorAll(`.eliminar`);
  //   btnsEliminar.forEach((btn) => {
  //     btn.addEventListener("click", (event) => {
  //       console.log('eliminar',event.target.dataset.id);

  //       sacarDelCarrito(event.target.dataset.id);
  //     });
  //   });
  //   document.querySelector("#cantidadCarrito").innerHTML = cantidad;
  //   if (document.querySelector("#cantidadCarrito").innerHTML == 0) {
  //     document.querySelector("#cnt-finalizarCompra").style.visibility =
  //       "hidden";
  //   } else {
  //     document.querySelector("#cnt-finalizarCompra").style.visibility =
  //       "visible";
  //   }
  // }

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
  init();
});
