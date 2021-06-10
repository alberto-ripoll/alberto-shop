import Principal from './components/Principal/principal.js';
import Producto from './components/Producto/producto.js';
import Error404 from './components/Error404/error404.js';

const pathToRegex = path => new RegExp("^"+ path.replace(/\//g, "\\/").replace(/:\w+/g, "(.+)") + "$");

const getParams = match => {
    const values = match.result.slice(1);
    const keys = Array.from(match.route.path.matchAll(/:(\w+)/g)).map(result => result[1]);

    return Object.fromEntries(keys.map((key,i)=> {
        return [key,values[i]]
    }))
}
const router = async () => {
    const rutas = [
        {path:'',view: Error404},
        {path:'/',view: Principal},
        {path:'/productos/:id',view: Producto},
    ]
    console.log(rutas);

    const matches = rutas.map(route =>{
        return {
            route: route,
            result: location.pathname.match(pathToRegex(route.path))
            }
    })

    let ruta = matches.find(route => route.result !== null);
    if (!ruta){
        ruta = {
            route : rutas[0],
            isMatch:true
        }
    }
    
    const view = new ruta.route.view(getParams(ruta));
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
