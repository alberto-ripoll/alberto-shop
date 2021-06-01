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

    if (localStorage.getItem("productos") === null) {
      let productosLocalStorage = [];
      localStorage.setItem("productos", JSON.stringify(productosLocalStorage));
    }
    updateHTML();
  }

  async function addtoCart(id) {
    newProducto = await getProducto(id);
    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    let existe = productosLocalStorage.findIndex(
      (producto) => producto.id === newProducto.id
    );
    console.log("EXISTE", existe);
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
  function updateHTML() {
    let tbody = document.getElementById("carrito");
    productosLocalStorage = JSON.parse(localStorage.getItem("productos"));
    tbody.innerHTML = ``;
    productosLocalStorage.forEach(producto => {
      tbody.innerHTML += `
        <td>${producto.nombre}</td>
        <td><img height="100px" width="100px" class="card-img-top" src="${producto.image}" alt="..." /></td> 
        <td>${producto.cantidad}</td> 
        <td>${producto.precio}</td> 

      `
    });
  }
  init();
});
