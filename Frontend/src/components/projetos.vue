<template>
  <div class="projetos-page page-list-project">
    <section class="hero is-info">
      <div class="hero-body">
        <div class="container">
          <div class="wrap-search">
            <busca padding="true" @search-projects="List" busca-home="false"></busca>
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
                <i class="fas fa-sliders-h"></i>
              </span>
              Filtrar
            </h4>
            <bulma-accordion dropdown icon="plus-minus" :initial-open-items="[1]">
              <!-- The wrapper component for all the items -->
              <bulma-accordion-item>
                <h4 slot="title">Linguagem de programação</h4>
                <div slot="content">
                  <div class="o-grid__item -xs-24" v-for="item in filters.languages" :key="item">
                    <a href="#" @click.prevent="SetFilter('LANGUAGE',item)" class="filter-item">
                      <div class="filter-item-name">{{item}}</div>
                      <!-- <div class="filter-item-count">44</div> -->
                    </a>
                  </div>
                </div>
              </bulma-accordion-item>
              <!-- add as many of these items as you need - fill them with content via the slots -->
              <bulma-accordion-item>
                <h4 slot="title">Categoria</h4>
                <div slot="content">
                  <div class="o-grid__item -xs-24" v-for="item in filters.categories" :key="item">
                    <a href="#" @click.prevent="SetFilter('CATEGORIE',item)" class="filter-item">
                      <div class="filter-item-name">{{item}}</div>
                      <!-- <div class="filter-item-count">44</div> -->
                    </a>
                  </div>
                </div>
              </bulma-accordion-item>
              <bulma-accordion-item>
                <h4 slot="title">Autor</h4>
                <div slot="content">
                  <div class="o-grid__item -xs-24">
                    <a
                      href="#"
                      @click.prevent="SetFilter('CREATOR',item)"
                      class="filter-item"
                      v-for="item in filters.creators"
                      :key="item"
                    >
                      <div class="filter-item-name">{{item}}</div>
                      <!-- <div class="filter-item-count">44</div> -->
                    </a>
                  </div>
                </div>
              </bulma-accordion-item>
            </bulma-accordion>
          </aside>
          <article class="content column">
            <div class="filter-itens">
              <span
                class="tag is-default is-normal"
                v-for="item in filterSelected"
                :key="item.filter"
              >
                {{item.filter}}
                <button
                  class="delete is-small"
                  type="button"
                  @click="RemoveFilter(item)"
                ></button>
              </span>
            </div>
            <div class="grid-projects is-flex columns">
              <h3 v-if="ListProjects.length == 0">Não foram encontrados projetos para sua busca.</h3>
              <card v-else v-for="item in ListProjects" :key="item.id" :data="item"></card>
            </div>
          </article>
        </div>
      </div>
    </section>
    <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
  </div>
</template>

<script>
import Busca from "./geral/Busca";
import CardProjetos from "./geral/CardProjeto";
import { BulmaAccordion, BulmaAccordionItem } from "vue-bulma-accordion";
import Axios from "axios";
import config from "../config";
import Loading from "vue-loading-overlay";
export default {
  name: "projetos",
  data() {
    return {
      ListProjects: [],
      isLoading: false,
      fullPage: true,
      SearchValue: "",
      filters: "",
      filterSelected: [],
      languageFilter: "",
      categorieFilter: "",
      creatorFilter: ""
    };
  },
  components: {
    busca: Busca,
    card: CardProjetos,
    BulmaAccordion,
    BulmaAccordionItem,
    Loading
  },
  methods: {
    List() {
      this.isLoading = true;
      Axios.get(
        config.ENDPOINT_URLL + "projects/search/" + this.$route.query.q
      ).then(response => {
        this.isLoading = false;
        this.ListProjects = response.data.data;
        this.ListFilters();
      });
    },
    ListFilters() {
      Axios.get(config.ENDPOINT_URLL + "project/filters/" + this.$route.query.q)
        .then(response => {
          this.filters = response.data.data;
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    },
    FilterProject() {
      this.isLoading = true;
      Axios.get(
        config.ENDPOINT_URLL +
          `project/filters-projects?keyword=${this.$route.query.q}&language=${this.languageFilter}&categorie=${this.categorieFilter}&creator=${this.creatorFilter}`
      ).then(response => {
        this.isLoading = false;
        this.ListProjects = response.data.data;
        this.ListFilters();
      });
    },
    SetFilter(type, value) {
      if (type == "LANGUAGE") {
        this.SetSelectFilter(value, "LANGUAGE");
        this.languageFilter = value;
        this.FilterProject();
      } else if (type == "CATEGORIE") {
        this.SetSelectFilter(value, "CATEGORIE");
        this.categorieFilter = value;
        this.FilterProject();
      } else if (type == "CREATOR") {
        this.SetSelectFilter(value, "CREATOR");
        this.creatorFilter = value;
        this.FilterProject();
      }
    },
    SetSelectFilter(filter, type) {
      let f = null;
      if (this.filterSelected.length > 0) {
        f = this.filterSelected.find(item => {
          return item.type == type;
        });
      }

      if (f == undefined || f == null) {
        this.filterSelected.push({ type, filter });
      } else {
        this.filterSelected.map(item => {
          if (item.type == type) {
            item.filter = filter;
          }
        });
      }
    },
    RemoveFilter(item) {
      this.filterSelected = this.filterSelected.filter(itemf => {
        return itemf.filter != item.filter;
      });
      if (item.type == "LANGUAGE") {
        this.languageFilter = "";
      } else if (item.type == "CATEGORIE") {
        this.categorieFilter = "";
      } else {
        this.creatorFilter = "";
      }
      this.FilterProject();
    }
  },
  beforeRouteUpdate(to, from, next) {
    next();
    window.scrollTo(scrollY, 0);
    this.$children[0].searchQuery = this.$route.query.q;
    this.List();
  },
  mounted() {
    this.List();
    console.log((this.$children[0].searchQuery = this.$route.query.q));
  }
};
</script>