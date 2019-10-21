<template>
  <div class="projetos-page">
    <section class="hero is-info">
      <div class="hero-body">
        <div class="container">
          <div class="wrap-search">
            <busca padding="true"></busca>
          </div>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container page-content is-flex">
        <div class="columns">
          <aside class="sidebar column is-two-fifths">
            <h4 class="title title--section is-3">
              <span class="icon-section">
                <i class="far fa-sticky-note"></i>
              </span>
              Resumo
            </h4>
            <div class="version" href>
              <span class="is-flex flex-column center">
                <div>
                  <strong>Versão</strong>
                </div>
                <small>{{main_version}}</small>
              </span>
            </div>
            <div class="version" href>
              <span class="is-flex flex-column center">
                <div>
                  <strong>Licença</strong>
                </div>
                <small>{{license}}</small>
              </span>
            </div>
            <nav class="intro-buttons">
              <a class="button button--alter is-medium is-link" target="_blank" :href="git_url"> 
                <span>
                  <i class="fab fa-github"></i>
                  <strong>Acessar repositório</strong>
                </span>
              </a>
              <a class="button button--alter is-medium is-light btn-rounded is-outlined" href>
                <span>
                  <i class="fas fa-book-open"></i>
                  <strong>Acessar monografia</strong>
                </span>
              </a>
            </nav>
          </aside>
          <article class="content column">
            <h4 class="title title--section is-3">
              <span class="icon-section">
                <i class="fas fa-info"></i>
              </span>
              Informações
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Nome</td>
                  <td class="td-description">{{project.nome_projeto}}</td>
                </tr>
                <tr>
                  <td class="td-name">Linguagem</td>
                  <td class="td-description">{{main_linguagem}}</td>
                </tr>
                <tr>
                  <td class="td-name">Resumo</td>
                  <td class="td-description">{{resume}}</td>
                </tr>
                <tr>
                  <td class="td-name">Licença</td>
                  <td class="td-description">{{license}}</td>
                </tr>
                <tr>
                  <td class="td-name">Monografia</td>
                  <td class="td-description">Returns the value of a specific field.</td>
                </tr>
              </tbody>
            </table>
          </article>
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
import config from '../config';
import Axios from 'axios'
import Loading from 'vue-loading-overlay';

export default {
  name: "detalhes-projeto",
  data() {
    return {
       project:"",
       main_linguagem:"",
       main_version:"",
       resume:"",
       license:"",
       git_url:"",
       isLoading: false,
       fullPage: true
    };
  },
  methods:{
     GetInfoProject(){
        this.isLoading = true;
        Axios.get(config.ENDPOINT_URLL+"/project/"+this.$route.params.nome).then(response=>{
           this.isLoading = false
           this.project = response.data[0]
           this.main_linguagem = Object.getOwnPropertyNames(this.project.linguagens)[0]
           this.main_version = this.project.versoes.length == 0 ? "Nenhuma": this.project.versoes[0].versao
           
           if(this.project.versoes.length > 0){
             this.resume = this.project.versoes[0].resumo == "" ? "Nenhuma": this.project.versoes[0].resumo
           }else{
             this.resume = "Nenhuma"
           }
           this.git_url = this.project.git_url
           this.license = this.project.licenca == null ? "Nenhuma": this.project.licenca.name
        })
     }
  },
  created(){
    this.$nextTick(()=>{
        this.GetInfoProject()
    })
  },
  components: {
    busca: Busca,
    card: CardProjetos,
    Loading
  }
};
</script>
