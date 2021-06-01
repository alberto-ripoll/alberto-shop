document.addEventListener("DOMContentLoaded", function (event) {
  async function getProducto(id) {
    const res = await axios.get(
      `http://desarrollo.zataca.com/api/producto?id=${id}`
    );
    return res.data.producto;
  }

  function init() {
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

    if (localStorage.getItem("productos") === null) {
      // let productosLocalStorage = [];
      localStorage.setItem("productos", JSON.stringify(""));
    }
    console.log("INIT");
    updateHTML();
  }

  async function addtoCart(id) {
    newProducto = await getProducto(id);
    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let existe = productosLocalStorage.findIndex(
      (producto) => producto.id === newProducto.id
    );
    if (existe == -1) {
      newProducto.cantidad = 1;
      productosLocalStorage.push(newProducto);
    } else {
      newProducto.cantidad = productosLocalStorage[existe].cantidad + 1;
      productosLocalStorage[existe] = newProducto;
    }

    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));
    updateHTML();
  }

  async function ordenarPor(filtro) {
    let shopContent = document.querySelector("#shop-content");
    let res = await axios.get(`http://desarrollo.zataca.com/api/productos`);
    const productos = res.data.productos;

    if (filtro == "nuevos") {
      productos.sort(function (a, b) {
          return new Date(b.created_at) - new Date(a.created_at);

      });
    }
    if (filtro == "valorados") {
      productos.sort(function (a, b) {
        return b.puntuacion - a.puntuacion;
      });
    }
    
    if (filtro == "baratos") {
      productos.sort(function (a, b) {
        return a.precio - b.precio;
      });
    }

    shopContent = ``;

    productos.forEach((producto) => {
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
                  shopContent += `<div class="bi-star-fill"></div>`
                }
          shopContent += `
                  </div>
                  <!-- Product price-->
                  $${producto.precio}
              </div>
          </div>
          <!-- Product actions-->
          <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center"><button class="btn btn-outline-dark mt-auto addToCart" data-id="${producto.id}">Añadir al carrito</button></div>
          </div>
      </div>
    </div>`;
    });
    document.querySelector("#viendo").innerHTML = 'Ordenado por '+filtro;
    document.querySelector("#shop-content").innerHTML = shopContent;
  }

  function updateHTML() {
    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let tbody = document.getElementById("carrito");
    tbody.innerHTML = ``;
    let cantidad = 0;
    productosLocalStorage.forEach((producto) => {
      tbody.innerHTML += `
        <td>${producto.nombre}</td>
        <td><img height="100px" width="100px" src="${producto.image}" alt="..." /></td> 
        <td><button class="reducir" data-id=${producto.id}>Reducir</button></td> 
        <td>${producto.cantidad}</td> 
        <td><button class="aumentar" data-id=${producto.id}>Aumentar</button></td> 
        <td>${producto.precio}</td> 
        <td><button class="eliminar" data-id=${producto.id}>Eliminar</button></td> 
      `;
      cantidad += producto.cantidad;
    });
    btnsAumentar = document.querySelectorAll(`.aumentar`);
    btnsAumentar.forEach((btn) => {
      btn.addEventListener("click", (event) => {
        aumentarCantidad(event.target.dataset.id);
      });
    });
    btnsReducir = document.querySelectorAll(`.reducir`);
    btnsReducir.forEach((btn) => {
      btn.addEventListener("click", (event) => {
        reducirCantidad(event.target.dataset.id);
      });
    });
    btnsEliminar = document.querySelectorAll(`.eliminar`);
    btnsEliminar.forEach((btn) => {
      btn.addEventListener("click", (event) => {
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

  function aumentarCantidad(id) {
    console.log("Cantidad", id);

    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let indice = productosLocalStorage.findIndex(
      (producto) => producto.id === id
    );
    productosLocalStorage[indice].cantidad++;
    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    updateHTML();
  }
  function reducirCantidad(id) {
    let producto_id = id;
    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let indice = productosLocalStorage.findIndex(
      (producto) => producto.id === id
    );
    productosLocalStorage[indice].cantidad--;
    if (productosLocalStorage[indice].cantidad == 0) {
      sacarDelCarrito(producto_id);
    }
    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    updateHTML();
  }
  function sacarDelCarrito(id) {
    console.log("SACAR", id);

    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));

    let indice = productosLocalStorage.findIndex(
      (producto) => producto.id === id
    );
    productosLocalStorage.splice(indice, 1);

    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    updateHTML();
  }
  init();
});
