<template>
  <div class="index">
    <main class="wrap-top section">
      <div class="wrap-search">
        <section class="hero">
          <div class="container">
            <h1 class="title title--alter is-size-1">
              Repositório de projetos UFBA
            </h1>
            <p class="subtitle subtitle--alter">
              Digite uma palavra-chave para buscar projetos de software na nossa
              base
            </p>
          </div>
        </section>
        <busca padding="false" busca-home="true"></busca>
      </div>
    </main>

    <section class="section info-started">
      <div class="container">
        <div class="getting-started">
          <div class="columns">
            <div class="bd-focus-item column has-text-centered">
              <span class="icon-section">
                <i class="far fa-lightbulb"></i>
              </span>
              <p class="title is-4">
                <strong>Ideias de projetos</strong>
              </p>
              <p class="subtitle subtitle--alter is-6">
                Designed for
                <strong>mobile</strong> first
              </p>
            </div>

            <div class="bd-focus-item column has-text-centered">
              <span class="icon-section">
                <i class="fas fa-code-branch"></i>
              </span>
              <p class="title is-4">
                <strong>Contribuições</strong>
              </p>
              <p class="subtitle subtitle--alter is-6">
                Open source on
                <strong>GitHub</strong>
              </p>
            </div>

            <div class="bd-focus-item column has-text-centered">
              <span class="icon-section">
                <i class="fab fa-github"></i>
              </span>
              <p class="title is-4">
                <strong>Reuso</strong>
              </p>
              <p class="subtitle subtitle--alter is-6">
                Open source on
                <strong>GitHub</strong>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="divider-waves">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
          <path
            fill="#fff"
            fill-opacity="1"
            d="M0,32L80,53.3C160,75,320,117,480,117.3C640,117,800,75,960,58.7C1120,43,1280,53,1360,58.7L1440,64L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"
          ></path>
        </svg>
      </div>
    </section>
    <!-- Lista de projetos -->
    <section class="section hero has-text-centered last-projects">
      <div class="container">
        <h4 class="title title--section is-3">
          <span class="icon-section">
            <i class="fas fa-code"></i>
          </span>
          Últimos projetos
        </h4>
        <div class="grid-projects is-flex columns">
          <card v-for="item in ListProjects" :key="item.id" :data="item"></card>
          
        </div>
      </div>
    </section>
    <loading :active.sync="isLoading" 
        :is-full-page="fullPage"></loading>
  </div>
</template>

<script>
import Busca from "./geral/Busca";
import CardProjetos from "./geral/CardProjeto";
import config from "../config"
import Axios from "axios"
import Loading from 'vue-loading-overlay';
export default {
  name: "index",
  data() {
    return {
      ListProjects:[],
      isLoading: false,
      fullPage: true
    };
  },
  methods:{
     ListLastProjects(){
        this.isLoading = true
        Axios.get(config.ENDPOINT_URLL+"/last-projects").then(response=>{
            this.isLoading = false
            this.ListProjects = response.data
        })
     }
  },
  mounted(){
    this.$nextTick(()=>{
        this.ListLastProjects()
    })
  },
  components: {
    busca: Busca,
    card: CardProjetos,
    Loading
  }
};
</script>
