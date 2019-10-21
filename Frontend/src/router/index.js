import Vue from 'vue'
import Router from 'vue-router'
import Home from './../components/home'
import Index from './../components/index'
import Projetos from './../components/projetos'
import DetalhesProjeto from './../components/detalhes-projeto'

Vue.use(Router)
let indexHome = 0;
export default new Router({
  routes: [{
    path: '/',
    name: 'home',
    redirect: "index",
    component: Home,
    beforeEnter: (to, from, next) => {
      next();
    },
    children: [{
        path: 'index',
        name: "index",
        component: Index
      },
      {
        path: 'projetos',
        name: "projetos",
        component: Projetos
      },
      {
        path: 'detalhes-projeto/:nome',
        name: "detalhes-projeto",
        component: DetalhesProjeto
      }
    ]
  }]
})
