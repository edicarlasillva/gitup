<template>
  <section class="search-content" :class="{'is-paddingless':PaddingCss}">
    <div class="container">
      <div class="search">
        <input
          type="text"
          @keydown.enter="Search"
          placeholder="Digite uma palavra-chave para buscar projetos"
          v-model="searchQuery"
        />
        <button class="button button--rounded is-link" @click="Search">
          <span class="icon">
            <i class="fas fa-arrow-right"></i>
          </span>
        </button>
      </div>
      <!-- <a href="#" class="is-pulled-right has-text-weight-semibold is-link">Busca avançada</a> -->
    </div>
  </section>
</template>

<script>
export default {
  name: "busca",
  props: ["padding", "buscaHome"],
  computed: {
    PaddingCss() {
      if (this.padding === "true") return true;
      else return false;
    }
  },
  data() {
    return {
      searchQuery: ""
    };
  },
  methods: {
    Search() {
      if (this.searchQuery == "") {
        alert("Digite uma palavra chave para efetuar uma busca.");
      } else {
        if (this.buscaHome == "true") {
          this.$router.push("/projetos?q=" + this.searchQuery);
        } else {
          //dispara um evento solicitando a busca novamente dos dados
          this.$router.push("/projetos?q=" + this.searchQuery);
          this.$emit("search-projects");
        }
      }
    }
  },
  beforeRouteUpdate(to, from, next) {
    next();
    this.searchQuery = this.$route.query.q;
  },
  mounted() {
    this.searchQuery = this.$route.query.q;
  }
};
</script>