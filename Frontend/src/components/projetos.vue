<template>
  <div class="projetos-page">
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
          <aside class="sidebar column is-two-fifths">
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
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">JavaScript</div>
                      <div class="filter-item-count">44</div>
                    </a>
                  </div>
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">Java</div>
                      <div class="filter-item-count">32</div>
                    </a>
                  </div>
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">PHP</div>
                      <div class="filter-item-count">25</div>
                    </a>
                  </div>
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">HTML</div>
                      <div class="filter-item-count">13</div>
                    </a>
                  </div>
                </div>
              </bulma-accordion-item>
              <!-- add as many of these items as you need - fill them with content via the slots -->
              <bulma-accordion-item>
                <h4 slot="title">Categoria</h4>
                <div slot="content">
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">Música</div>
                      <div class="filter-item-count">44</div>
                    </a>
                  </div>
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">Geradores</div>
                      <div class="filter-item-count">32</div>
                    </a>
                  </div>
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">Munual</div>
                      <div class="filter-item-count">25</div>
                    </a>
                  </div>
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">Markdown</div>
                      <div class="filter-item-count">13</div>
                    </a>
                  </div>
                </div>
              </bulma-accordion-item>
              <bulma-accordion-item>
                <h4 slot="title">Autor</h4>
                <div slot="content">
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">Edicarla Silva</div>
                      <div class="filter-item-count">44</div>
                    </a>
                  </div>
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">Rafael Marques</div>
                      <div class="filter-item-count">32</div>
                    </a>
                  </div>
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">João Santos</div>
                      <div class="filter-item-count">25</div>
                    </a>
                  </div>
                  <div class="o-grid__item -xs-24">
                    <a href="#" class="filter-item">
                      <div class="filter-item-name">Ana Maria</div>
                      <div class="filter-item-count">13</div>
                    </a>
                  </div>
                </div>
              </bulma-accordion-item>
            </bulma-accordion>
          </aside>
          <article class="content column">
            <div class="filter-itens">
              <span class="tag is-default is-normal">
                Javascript
                <button class="delete is-small"></button>
              </span>
              <span class="tag is-default is-normal">
                Ontologia
                <button class="delete is-small"></button>
              </span>
              <span class="tag is-default is-normal">
                Edicarla Silva
                <button class="delete is-small"></button>
              </span>
            </div>
            <div class="grid-projects is-flex columns">
              <card v-for="item in ListProjects" :key="item.id" :data="item"></card>
            </div>
            <div class="navigate-page">
              <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
                <a class="pagination-previous">Anterior</a>
                <a class="pagination-next">Próximo</a>
              </nav>
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
      fullPage: true
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
      Axios.get(config.ENDPOINT_URLL + "/search?q=" + this.$route.query.q).then(
        response => {
          this.isLoading = false;
          this.ListProjects = response.data;
        }
      );
    }
  },
  mounted() {
    this.List();
  }
};
</script>