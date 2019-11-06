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
          <aside class="sidebar column is-one-third">
            <h4 class="title title--section is-3">
              <span class="icon-section">
                <i class="fas fa-sticky-note"></i>
              </span>
              Resumo
            </h4>
            <div class="version" href>
              <span class="is-flex flex-column center">
                <div>
                  <strong>Linguagem de programação</strong>
                </div>
                <small>{{programmingLanguage}}</small>
              </span>
            </div>
            <div class="version" href>
              <span class="is-flex flex-column center">
                <div>
                  <strong>Versão</strong>
                </div>
                <small>{{version.revision}}</small>
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
              <a
                class="button button--alter is-medium is-link"
                target="_blank"
                :href="linkRepository"
              >
                <span>
                  <i class="fab fa-github"></i>
                  <strong>Acessar repositório</strong>
                </span>
              </a>
              <a
                class="button button--alter is-medium is-light btn-rounded is-outlined"
                :href="monografia.linkMonografia"
                target="_blank"
              >
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
                  <td class="td-description">{{name}}</td>
                </tr>
                <tr>
                  <td class="td-name">Data de criação</td>
                  <td class="td-description">{{created}}</td>
                </tr>
                <tr>
                  <td class="td-name">Resumo</td>
                  <td class="td-description">{{shortdesc}}</td>
                </tr>
                <tr>
                  <td class="td-name">Descrição</td>
                  <td class="td-description">{{description}}</td>
                </tr>
                <tr>
                  <td class="td-name">Idioma do projeto</td>
                  <td class="td-description">{{language}}</td>
                </tr>
                <tr>
                  <td class="td-name">Palavras-chave</td>
                  <td class="td-description">{{keywords.toString()}}</td>
                </tr>
                <tr>
                  <td class="td-name">Sistema operacional</td>
                  <td class="td-description">{{so.toString()}}</td>
                </tr>
                <tr>
                  <td class="td-name">Site</td>
                  <td class="td-description">
                    <a :href="urlHomePage" target="_blank">{{urlHomePage}}</a>
                  </td>
                </tr>
                <tr>
                  <td class="td-name">Sites antigos</td>
                  <td class="td-description">
                    <a :href="urlOldHomepage" target="_blank">{{urlOldHomepage}}</a>
                  </td>
                </tr>
                <tr>
                  <td class="td-name">Página de download</td>
                  <td class="td-description">
                    <a :href="downloadPage" target="_blank">{{downloadPage}}</a>
                  </td>
                </tr>
                <tr>
                  <td class="td-name">Lista de discussão</td>
                  <td class="td-description">
                    <a :href="urlMailingList" target="_blank">{{urlMailingList}}</a>
                  </td>
                </tr>
                <tr>
                  <td class="td-name">Rastreador de bugs</td>
                  <td class="td-description">
                    <a :href="bugDatabase" target="_blank">{{bugDatabase}}</a>
                  </td>
                </tr>
                <tr>
                  <td class="td-name">Link das telas</td>
                  <td class="td-description">
                    <a :href="screenshots" target="_blank">{{screenshots}}</a>
                  </td>
                </tr>
                <tr>
                  <td class="td-name">Desenvolvedor principal</td>
                  <td class="td-description">{{nameMaintainer}}</td>
                </tr>
                <tr>
                  <td class="td-name">Desenvolvedores</td>
                  <td class="td-description">{{developers.toString()}}</td>
                </tr>
                <tr>
                  <td class="td-name">Documentadores</td>
                  <td class="td-description">{{documentors.toString()}}</td>
                </tr>
                <tr>
                  <td class="td-name">Tradutores</td>
                  <td class="td-description">{{translators.toString()}}</td>
                </tr>
                <tr>
                  <td class="td-name">Testadores</td>
                  <td class="td-description">{{testers.toString()}}</td>
                </tr>
                <tr>
                  <td class="td-name">Colaboradores</td>
                  <td class="td-description">{{collaborators.toString()}}</td>
                </tr>
              </tbody>
            </table>
            <h4 class="title title--section title-table is-3">
              <span class="icon-section">
                <i class="fas fa-code-branch"></i>
              </span>
              Versão
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Data de lançamento</td>
                  <td class="td-description">{{version.created}}</td>
                </tr>
                <tr>
                  <td class="td-name">Versão</td>
                  <td class="td-description">{{version.revision}}</td>
                </tr>
                <tr>
                  <td class="td-name">Descrição</td>
                  <td class="td-description">{{version.description}}</td>
                </tr>
              </tbody>
            </table>
            <h4 class="title title--section title-table is-3">
              <span class="icon-section">
                <i class="fas fa-box-open"></i>
              </span>
              Repositório
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Link do repositório</td>
                  <td class="td-description">
                    <a :href="linkRepository" target="_blank">{{linkRepository}}</a>
                  </td>
                </tr>
              </tbody>
            </table>
            <h4 class="title title--section title-table is-3">
              <span class="icon-section">
                <i class="fas fa-check"></i>
              </span>
              Especificação de implementação
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Data de criação</td>
                  <td class="td-description">{{specification.created}}</td>
                </tr>
                <tr>
                  <td class="td-name">Descrição</td>
                  <td class="td-description">{{specification.description}}</td>
                </tr>
              </tbody>
            </table>
            <h4 class="title title--section title-table is-3">
              <span class="icon-section">
                <i class="fas fa-file"></i>
              </span>
              Requisito
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Documento de requisitos</td>
                  <td class="td-description">
                    <a :href="requeriment.file" target="_blank">{{requeriment.file}}</a>
                  </td>
                </tr>
                <tr>
                  <td class="td-name">Sugestão de melhorias</td>
                  <td class="td-description">{{requeriment.improvement}}</td>
                </tr>
              </tbody>
            </table>
            <h4 class="title title--section title-table is-3">
              <span class="icon-section">
                <i class="fas fa-file-alt"></i>
              </span>
              Monografia
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Discente</td>
                  <td class="td-description">{{monografia.nameCreator}}</td>
                </tr>
                <tr>
                  <td class="td-name">Orientador</td>
                  <td class="td-description">{{monografia.advisorName}}</td>
                </tr>
                <tr>
                  <td class="td-name">Coorientador</td>
                  <td class="td-description">{{monografia.coadvisorName}}</td>
                </tr>
                <tr>
                  <td class="td-name">Idioma</td>
                  <td class="td-description">{{monografia.language}}</td>
                </tr>
                <tr>
                  <td class="td-name">Link da monografia</td>
                  <td class="td-description"><a :href="monografia.linkMonografia" target="_blank">{{monografia.linkMonografia}}</a></td>
                </tr>
              </tbody>
            </table>
            <h4 class="title title--section title-table is-3">
              <span class="icon-section">
                <i class="fas fa-list-ul"></i>
              </span>
              Categoria
            </h4>
            <table class="functions-list">
              <tbody>
                <tr>
                  <td class="td-name">Categoria</td>
                  <td class="td-description">{{categorys.prefLabel}}</td>
                </tr>
                <tr>
                  <td class="td-name">Nome alternativo</td>
                  <td class="td-description">{{alterCategories.toString()}}</td>
                </tr>
                <tr>
                  <td class="td-name">Categoria mãe</td>
                  <td class="td-description">{{motherCategories.toString()}}</td>
                </tr>
                <tr>
                  <td class="td-name">Categorias filhas</td>
                  <td class="td-description">{{childCategories.toString()}}</td>
                </tr>
                <tr>
                  <td class="td-name">Categoria relacionadas</td>
                  <td class="td-description">{{relatedCategories.toString()}}</td>
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
    <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
  </div>
</template>

<script>
import Busca from "./geral/Busca";
import CardProjetos from "./geral/CardProjeto";
import config from "../config";
import Axios from "axios";
import Loading from "vue-loading-overlay";

export default {
  name: "detalhes-projeto",
  data() {
    return {
      ListProjects: [],
      isLoading: false,
      fullPage: true,
      name: "",
      created: "",
      programmingLanguage: "",
      shortdesc: "",
      description: "",
      homepage: "",
      oldHomepage: "",
      downloadPage: "",
      linkRepository: "",
      keywords: "",
      so: "",
      version: "",
      license: "",
      specification: "",
      monografia: "",
      urlHomePage: "",
      urlOldHomepage: "",
      downloadPage: "",
      urlMailingList: "",
      bugDatabase: "",
      screenshots: "",
      language: "",
      nameMaintainer: "",
      categorys: "",
      alterCategories: "",
      childCategories: "",
      motherCategories: "",
      relatedCategories: "",
      developers: "",
      documentors: "",
      translators: "",
      collaborators: "",
      testers: "",
      requeriment: ""
    };
  },
  methods: {
    GetInfoProject() {
      this.isLoading = true;
      Axios.get(
        config.ENDPOINT_URLL + "project/info/" + this.$route.params.nome
      )
        .then(response => {
          this.isLoading = false;
          let project = response.data.data;
          this.name = project.name;
          this.created = project.created;
          this.programmingLanguage = project.programmingLanguage;
          this.shortdesc = project.shortdesc;
          this.description = project.description;
          this.homepage = project.homepage;
          this.oldHomepage = project.oldHomepage;
          this.downloadPage = project.downloadPage;
          this.linkRepository = project.linkRepository;
          this.keywords = project.keywords;
          this.so = project.so;
          this.version = project.version;
          this.license = project.license;
          this.specification = project.specification;
          this.monografia = project.monografia;
          this.urlHomePage = project.urlHomepage;
          this.urlOldHomepage = project.urlOldHomepage;
          this.downloadPage = project.downloadPage;
          this.urlMailingList = project.urlMailingList;
          this.bugDatabase = project.bugDatabase;
          this.screenshots = project.screenshots;
          this.language = project.language;
          this.nameMaintainer = project.nameMaintainer;
          this.categorys = project.categorys;
          this.alterCategories = project.categorys.altfLabel;
          this.childCategories = project.categorys.narrower;
          this.motherCategories = project.categorys.broader;
          this.relatedCategories = project.categorys.related;
          this.developers = project.nameDeveloper;
          this.documentors = project.nameDocumenter;
          this.translators = project.nameTranslator;
          this.collaborators = project.nameHelper;
          this.testers = project.nameTester;
          this.requeriment = project.requeriment;

          this.GetRelationsProjects();
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    },
    GetRelationsProjects() {
      Axios.get(
        config.ENDPOINT_URLL + "project/relations/" + this.$route.params.nome
      )
        .then(response => {
          this.ListProjects = response.data.data;
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    }
  },
  mounted() {
    this.$nextTick(() => {
      setTimeout(() => {
        window.scrollTo(scrollY, 0);
        this.GetInfoProject();
      }, 20);
    });
  },
  beforeRouteUpdate(to, from, next) {
    next();
    window.scrollTo(scrollY, 0);
    this.GetInfoProject();
  },
  components: {
    busca: Busca,
    card: CardProjetos,
    Loading
  }
};
</script>
