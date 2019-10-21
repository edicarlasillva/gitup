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
                    <label class="o-checkbox t-capitalize t-block -xs-small">
                      <input type="checkbox" class="o-checkbox__input" />
                      <span class="o-checkbox__blank"></span>
                      <span class="o-checkbox__label">Javascript</span>
                    </label>
                  </div>
                  <div class="o-grid__item -xs-24">
                    <label class="o-checkbox t-capitalize t-block -xs-small">
                      <input type="checkbox" class="o-checkbox__input" />
                      <span class="o-checkbox__blank"></span>
                      <span class="o-checkbox__label">PHP</span>
                    </label>
                  </div>
                </div>
              </bulma-accordion-item>
              <!-- add as many of these items as you need - fill them with content via the slots -->
              <bulma-accordion-item>
                <h4 slot="title">Categoria</h4>
                <p
                  slot="content"
                >Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus eos illo expedita asperiores rem iure aliquid dolore, pariatur dignissimos, minima inventore? Minima voluptatum nulla, error omnis laboriosam voluptatibus rem aperiam.</p>
              </bulma-accordion-item>
              <bulma-accordion-item>
                <h4 slot="title">Autor</h4>
                <p
                  slot="content"
                >Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus eos illo expedita asperiores rem iure aliquid dolore, pariatur dignissimos, minima inventore? Minima voluptatum nulla, error omnis laboriosam voluptatibus rem aperiam.</p>
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
                <ul class="pagination-list">
                  <li>
                    <a class="pagination-link" aria-label="Goto page 1">1</a>
                  </li>
                  <li>
                    <span class="pagination-ellipsis">&hellip;</span>
                  </li>
                  <li>
                    <a class="pagination-link" aria-label="Goto page 45">45</a>
                  </li>
                  <li>
                    <a
                      class="pagination-link is-current"
                      aria-label="Page 46"
                      aria-current="page"
                    >46</a>
                  </li>
                  <li>
                    <a class="pagination-link" aria-label="Goto page 47">47</a>
                  </li>
                  <li>
                    <span class="pagination-ellipsis">&hellip;</span>
                  </li>
                  <li>
                    <a class="pagination-link" aria-label="Goto page 86">86</a>
                  </li>
                </ul>
              </nav>
            </div>
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
import { BulmaAccordion, BulmaAccordionItem } from "vue-bulma-accordion";
import Axios from 'axios';
import config from '../config';
import Loading from 'vue-loading-overlay';
export default {
  name: "projetos",
  data() {
    return {
      ListProjects:[],
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
  methods:{
    List(){
      this.isLoading = true
      Axios.get(config.ENDPOINT_URLL+"/search?q="+this.$route.query.q).then(response=>{
         this.isLoading = false
         this.ListProjects = response.data
      })
    }
  },
  mounted(){
     this.List()
  }
};
</script>