const nav_template = document.createElement('template');
nav_template.innerHTML = `
<link href="css/styles.css" rel="stylesheet" />
<nav style="position: fixed;z-index: 1;width: 100%;" class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container px-4 px-lg-5">
    <a class="navbar-brand" href="/">Alberto-Shop</a>

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