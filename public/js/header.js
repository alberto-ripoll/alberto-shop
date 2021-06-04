let template_header = document.createElement('template');
template_header.innerHTML = `
<style>
.bg-dark {
    background-color: #212529 !important;
  }
  .py-5 {
    padding-top: 3rem !important;
    padding-bottom: 3rem !important;
  }
  .container {
  width: 100%;
  padding-right: var(--bs-gutter-x, 0.75rem);
  padding-left: var(--bs-gutter-x, 0.75rem);
  margin-right: auto;
  margin-left: auto;
}
.px-4 {
    padding-right: 1.5rem !important;
    padding-left: 1.5rem !important;
  }
  .px-lg-5 {
    padding-right: 3rem !important;
    padding-left: 3rem !important;
  }
  .my-5 {
    margin-top: 3rem !important;
    margin-bottom: 3rem !important;
  }
  .text-center {
    text-align: center !important;
  }
  .text-white {
    color: #fff !important;
  }
  .display-4 {
    font-size: calc(1.475rem + 2.7vw);
    font-weight: 300;
    line-height: 1.2;
  }
  .fw-bolder {
    font-weight: bolder !important;
  }
</style>
<header class="bg-dark py-5">
<div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-white">
        <h1 class="display-4 fw-bolder" id="message">/h1>
            <h3 style="display:block;height:1rem;" id="viendo"></h3>
    </div>
</div>
</header>
`

class Header extends HTMLElement{
  // toggleCheckbox(){
  //   this.dispatchEvent(this.checkEvent);
  //   console.log(this.checkEvent);
  // }
  static get observedAttributes() {
    return ['viendo'];
}
  attributeChangedCallback(name, oldValue, newValue) { // 4th W3C parameter = Namespace (not implemented in Browsers)
     console.log("attributeChangedCallback", name, oldValue || "null", newValue);
     this.shadowRoot.querySelector('#viendo').innerText = newValue;

  }
    constructor(){
        super();

        this.attachShadow({mode: 'open'});
        this.shadowRoot.appendChild(template_header.content.cloneNode(true));
        this.shadowRoot.querySelector('h1').innerText = this.getAttribute('message');
        // this.shadowRoot.querySelector('#viendo').innerText = this.getAttribute('viendo');
      //   this.checkEvent = new CustomEvent("check", {
      //     bubbles: true,
      //     cancelable: false,
      //   });

      //   this.shadowRoot.addEventListener("check", function (e) {
      //     console.log('listend to check event');
      //     console.log(e);
      // });
    }
}

window.customElements.define('app-header',Header);