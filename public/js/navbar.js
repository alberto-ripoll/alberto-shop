const nav_template = document.createElement('template');
nav_template.innerHTML = `
<style>
::slotted([slot=carrito]) {

}
</style>
<link href="css/styles.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<nav style="position: fixed;z-index: 1;width: 100%;" class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container px-4 px-lg-5">
    <a class="navbar-brand" href="/">Alberto-Shop</a>
    <slot name="carrito"></slot> 
    <a class="btn btn-outline-dark" href="/signin">Crear cuenta</a>
</li>
    </div>
</div>
</nav>`
{/* <slot name="carrito"></slot> 
<link href="css/styles.css" rel="stylesheet" />
*/}

class Navbar extends HTMLElement{
    constructor(){
        super();

    }
        connectedCallback() {
            this.attachShadow({mode: 'open'});
            this.shadowRoot.appendChild(nav_template.content.cloneNode(true));
        }

   }


window.customElements.define('app-navbar',Navbar);