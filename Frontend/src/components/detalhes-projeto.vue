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
                  <strong>Linguagem de programação</strong>
                </div>
                <small>{{main_linguagem}}</small>
              </span>
            </div>
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
                  <td class="td-name">Data de criação</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Resumo</td>
                  <td class="td-description">{{resume}}</td>
                </tr>
                <tr>
                  <td class="td-name">Descrição</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Categoria</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Palavras-chave</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Sistema operacional</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Site</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Sites antigos</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Página de download</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Lista de discussão</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Rastreador de bugs</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Link das telas</td>
                  <td class="td-description"></td>
                </tr>
              </tbody>
            </table>
            <h4 class="title title--section title-table  is-3">
              <span class="icon-section">
                <i class="fas fa-info"></i>
              </span>
              Versão
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Data de lançamento</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Versão</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Descrição</td>
                  <td class="td-description"></td>
                </tr>
              </tbody>
            </table>
            <h4 class="title title--section title-table  is-3">
              <span class="icon-section">
                <i class="fas fa-info"></i>
              </span>
              Repositório
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Link do repositório</td>
                  <td class="td-description">{{git_url}}</td>
                </tr>
              </tbody>
            </table>
            <h4 class="title title--section title-table  is-3">
              <span class="icon-section">
                <i class="fas fa-info"></i>
              </span>
              Especificação de implementação
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Data de criação</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Resumo</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Descrição</td>
                  <td class="td-description"></td>
                </tr>
              </tbody>
            </table>
            <h4 class="title title--section title-table  is-3">
              <span class="icon-section">
                <i class="fas fa-info"></i>
              </span>
              Monografia
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Orientador</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Coorientador</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Idioma</td>
                  <td class="td-description"></td>
                </tr>
                <tr>
                  <td class="td-name">Link da monografia</td>
                  <td class="td-description"></td>
                </tr>
              </tbody>
            </table>
          </article>
        </div>
      </div>
    </section>
    <!-- Lista de projetos -->
    <section class="section related-projects">
      <div class="container">
        <h4 class="title title--section is-3">
          <span class="icon-section">
            <i class="fas fa-code"></i>
          </span>
          Projetos relacionados
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
