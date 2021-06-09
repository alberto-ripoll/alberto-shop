import Principal from './components/Principal/principal.js';
const navigateTo = url => {
    history.pushState(null,null,url);
    router();
}

const router = async () => {
    const rutas = [
        {path:'/',view: Principal},
        {path:'/productos',view: () => console.log('Viendo /productos')},
        {path:'/perfil',view: () => console.log('Viendo /perfil')},
    ]

    const matches = rutas.map(route =>{
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
            e.preventDefault();
            navigateTo(e.target.href);
        }
    })

    router();
})
