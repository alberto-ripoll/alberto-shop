let template_footer = document.createElement('template');
template_footer.innerHTML = `
<link href="css/styles.css" rel="stylesheet" />

<footer class="py-5 bg-dark">
<div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; Alberto-Shop 2021</p>
</div>
</footer> 
`

class Footer extends HTMLElement{
    constructor(){
        super();
    }

    connectedCallback() {
        this.attachShadow({mode: 'open'})
        this.shadowRoot.appendChild(template_footer.content.cloneNode(true));
    
     }
}
window.customElements.define("app-footer", Footer);
