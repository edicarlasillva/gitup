<template>
  <div class="box column is-4-desktop is-half-tablet">
    <article class="media">
      <div class="media-content">
        <div class="content">
          <header class="mini-article-card-header">
            <div class="mini-article-card-title">
              <div class="mini-article-language">
                <span>{{data.programmingLanguage}}</span>
              </div>
              <h2>
                <a href="#" @click.prevent="DetailsProject(data)">{{data.name}}</a>
              </h2>
            </div>
          </header>
          <div class="mini-article-meta">
            <div class="mini-article-author is-flex">
              <span class="author-label">Autor</span>
              <a href="#">
                <span class="author-name">{{CreatorProject}}</span>
              </a>
            </div>
            <div class="mini-article-tags">
              <a
                href="#"
                @click.prevent="SearchKeyword(item)"
                v-for="item in data.keywords"
                :key="item"
              >{{item}}</a>
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
  props: ["data"],
  data() {
    return {};
  },
  computed: {
      CreatorProject(){
         if(this.data.hasOwnProperty("nameCreator")){
            return this.data.nameCreator
         }else{
           return this.data.nameMaintainer
         }
      }
  },
  methods: {
    DetailsProject(data) {
      this.$store.commit("SetProjectData", data);
      this.$router.replace({ path: "/detalhes-projeto/" + data.name });
    },
    SearchKeyword(keyword) {
      this.$router.push("/projetos?q=" + keyword);
    }
  }
};
</script>