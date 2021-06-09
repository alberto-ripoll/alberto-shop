const navigateTo = url => {
    history.pushState(null,null,url);
    router();
}

const router = async () => {
    const rutas = [
        {path:'/',view: () => console.log('Viendo /')},
        {path:'/producto',view: () => console.log('Viendo /posts')},
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
    console.log(ruta.route.view())
}

document.addEventListener('DOMContentLoaded', () =>{
    document.body.addEventListener("click", e => {
        if (e.target.matches("[data-link]")) {
            e.preventDefault();
            navigateTo(e.target.href);
        }
    })

    router();
})
