<template>
  <div class="box column is-4">
    <article class="media">
      <div class="media-content">
        <div class="content">
          <header class="mini-article-card-header">
            <div class="mini-article-card-title">
              <div class="mini-article-language">
                <span>{{MainLanguagens}}</span>
              </div>
              <h2>
                <a href="#" @click.prevent="DetailsProject(data)">{{data.nome_projeto}}</a>
              </h2>
            </div>
          </header>
          <div class="mini-article-meta">
            <div class="mini-article-author is-flex">
              <span class="author-label">Autor</span>
              <a href="#">
                <span class="author-name">{{data.autor}}</span>
              </a>
            </div>
            <div class="mini-article-tags">
              <a href v-for="item in data.palavras_chaves" :key="item">{{item}}</a>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
</template>
<script>
export default {
  name: "card-projeto",
  props:["data"],
  data() {
    return {};
  },
  computed:{
     MainLanguagens(){
        let l = Object.getOwnPropertyNames(this.data.linguagens)
        return l[0]
     }
  },
  methods:{
    DetailsProject(data){
        this.$router.push({path:"detalhes-projeto/"+data.nome_projeto})
    }
  }
};
</script>