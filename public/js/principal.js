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
          <producto-card data-link href=/productos/${producto.id} producto=${producto.id}></producto-card>
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
            return b.precio - a.precio;
          });
          document.querySelector("#header").setAttribute('viendo','Viendo los más económicos');
        }
    
        shopContent = ``;
    
        productos.forEach((producto) => {
          shopContent += `
          <producto-card data-link href=/productos/${producto.id} producto=${producto.id}></producto-card>
          `;
        });
        document.querySelector("#shop-content").innerHTML = shopContent;
        loadBotones();
    }
    async function init() {
        await loadProducts();
        loadBotones();
      }
      init();
})