import AbstractView from '../../AbstractView.js';

export default class Error404 extends AbstractView {
    constructor(){
        super();
        this.setTitle('Error 404');

    }

    async getHtml(){
        return `

    <!-- Header -->
        <app-header id="header" viendo="" message="Error 404"></app-header>


    <!-- Footer-->
    <app-footer></app-footer> 
        `
    }
}