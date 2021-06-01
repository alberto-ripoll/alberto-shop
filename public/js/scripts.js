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
      localStorage.setItem("productos", JSON.stringify(''));
    }
    console.log('INIT');
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

  function ordenarPor(filtro){
    if (filtro == "nuevos"){
      console.log('MUESTRO', filtro)
    }
    if (filtro == "valorados"){
      console.log('MUESTRO', filtro)

    }
    if (filtro == "baratos"){
      console.log('MUESTRO', filtro)

    }
  }
  function updateHTML() {
    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let tbody = document.getElementById("carrito");
    tbody.innerHTML = ``;
    let cantidad = 0;
    productosLocalStorage.forEach(producto => {
      tbody.innerHTML += `
        <td>${producto.nombre}</td>
        <td><img height="100px" width="100px" src="${producto.image}" alt="..." /></td> 
        <td><button class="reducir" data-id=${producto.id}>Reducir</button></td> 
        <td>${producto.cantidad}</td> 
        <td><button class="aumentar" data-id=${producto.id}>Aumentar</button></td> 
        <td>${producto.precio}</td> 
        <td><button class="eliminar" data-id=${producto.id}>Eliminar</button></td> 
      `;
      cantidad+= producto.cantidad;
    })
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
    })
    btnsEliminar = document.querySelectorAll(`.eliminar`);
    btnsEliminar.forEach((btn) => {
      btn.addEventListener("click", (event) => {
        sacarDelCarrito(event.target.dataset.id);
      });
    })
    document.querySelector("#cantidadCarrito").innerHTML = cantidad;
    if ( document.querySelector("#cantidadCarrito").innerHTML==0){
      document.querySelector('#cnt-finalizarCompra').style.visibility = 'hidden';
    }else{
      document.querySelector('#cnt-finalizarCompra').style.visibility = 'visible';

    }
  }

  function aumentarCantidad(id){
    console.log('Cantidad',id)

    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let indice = productosLocalStorage.findIndex(
      (producto) => producto.id === id
    );
    productosLocalStorage[indice].cantidad++;
    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    updateHTML();
  }
  function reducirCantidad(id){
    let producto_id = id;
    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let indice = productosLocalStorage.findIndex(
      (producto) => producto.id === id
    );
    productosLocalStorage[indice].cantidad--;
    if (productosLocalStorage[indice].cantidad ==0){
      sacarDelCarrito(producto_id);
    }
    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    updateHTML();
  }
  function sacarDelCarrito(id){
    console.log('SACAR',id)

    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    
    let indice = productosLocalStorage.findIndex(
      (producto) => producto.id === id
    );
    productosLocalStorage.splice(indice,1)

    localStorage.setItem("productos", JSON.stringify(productosLocalStorage));

    updateHTML();
  }
  init();
});
