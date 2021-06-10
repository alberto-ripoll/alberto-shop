import Principal from './components/Principal/principal.js';
import Producto from './components/Producto/producto.js';
import Error404 from './components/Error404/error404.js';

const navigateTo = url => {
    history.pushState(null,null,url);
    router();
}

const router = async () => {
    const rutas = [
        {path:'',view: Error404},
        {path:'/',view: Principal},
        {path:'/productos',view: Producto},
    ]
    console.log(rutas);

    const matches = rutas.map(route =>{
        let url = location.pathname.split('/');
        if (url[1]!=""){
            return {
                route: route,
                isMatch: '/'+url[1] === route.path
            }  
        }
        return {
            route: route,
            isMatch: location.pathname === route.path
            }
    })

    let ruta = matches.find(match => match.isMatch);
    if (!ruta){
        ruta = {
            route : rutas[0],
            isMatch:true
        }
    }
    
    const view = new ruta.route.view();
    document.querySelector('#app').innerHTML = await view.getHtml();
}

window.addEventListener('popstate',router);
document.addEventListener('DOMContentLoaded', () =>{
    document.body.addEventListener("click", e => {
        if (e.target.matches("[data-link]")) {
            navigateTo(e.target.getAttribute('href'));
        }
    })

    router();
})
