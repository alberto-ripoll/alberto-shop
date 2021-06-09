document.addEventListener("DOMContentLoaded", function (event) {

  function initModal(){
    
    open = document.querySelector(".open");
    open.addEventListener("click", function() {
      let visible = document.querySelector("x-modal").getAttribute('visible');
      if (visible == 'true'){
        document.querySelector("x-modal").setAttribute('visible','false');
      }
      if (visible == 'false'){
        document.querySelector("x-modal").setAttribute('visible','true');
      }
    });
    document.querySelector("x-modal").addEventListener("cancel", function() {
      document.querySelector("x-modal").setAttribute('visible','false')
    });
    document.querySelector("x-modal").addEventListener("ok", function() {
      document.querySelector("x-modal").setAttribute('visible','false')
    });
  

    let productos = JSON.parse(localStorage.getItem("productos"));
    let cantidad = 0;
    productos.forEach(producto => {
      cantidad += producto.cantidad;
    });
    document.querySelector("#cantidadCarrito").innerText = cantidad;
  }

  function updateCartHTML() {
    modal = document.querySelector("x-modal");
    modal.setAttribute('update','true');
  }

  async function init() {
    if (localStorage.getItem("productos") === null) {
      // let productosLocalStorage = [];
      localStorage.setItem("productos", JSON.stringify([]));
    }
    initModal();
    updateCartHTML();
  }


  init();
});
