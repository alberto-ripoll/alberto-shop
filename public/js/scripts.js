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
      console.log("ok event raised");
      document.querySelector("x-modal").setAttribute('visible','false')
    });
  

    let cantidad = JSON.parse(localStorage.getItem("productos")).length;
    document.querySelector("#cantidadCarrito").innerHTML = cantidad;
    if (cantidad == 0) {
      // document.querySelector("#cnt-finalizarCompra").style.visibility ="hidden";
    } else {
      // document.querySelector("#cnt-finalizarCompra").style.visibility ="visible";
    }
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
