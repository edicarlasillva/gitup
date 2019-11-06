<template>
  <div class="home">
    <header class="header">
      <div class="container header-align">
        <!-- <p>Repositório de projetos de software</p> -->
        <div class="logo">
          <a href @click.prevent="RedirectHome" class="is-flex">
            <img src="../../static/images/logo.svg" alt="Logotipo GitUP" />
            <h4 class="title is-4">GitUP</h4>
          </a>
        </div>
        <nav class="navbar">
          <div class="container">
            <div class="navbar-brand">
              <span class="navbar-burger burger" data-target="navbarMenuHeroA">
                <span></span>
                <span></span>
                <span></span>
              </span>
            </div>
            <div id="navbarMenuHeroA" class="navbar-menu">
              <div class="navbar-end">
                <a href="https://github.com/edicarlasillva/gitup" class="navbar-item">Sobre o GitUP</a>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>

    <router-view></router-view>

    <footer>
      <section class="colab">
        <div class="container">
          <h2>Colabore</h2>
          <div class="columns is-desktop footer-area">
            <div class="left column is-6">
              <p>
                Projeto open source.
                <br />Ajude a evoluir o GitUP!
              </p>
            </div>
            <div class="right column is-6">
              <a href="https://github.com/edicarlasillva/gitup" target="_blank">
                <div>
                  <i class="fab fa-github"></i>
                </div>
                <p class="colab-name">Contribuir</p>
              </a>
            </div>
          </div>
        </div>
      </section>
      <div class="hero-footer">
        <div class="container">
          <div class="columns">
            <div class="column">
              <div class="has-text-centered">
                <div class="content">
                  © 2019 Todos os direitos reservados.
                  <p>
                    Trabalho de conclusão de curso -
                    <a
                      href="https://www.ufba.br/"
                      title="Site UFBA"
                      target="_blank"
                    >UFBA</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: "home",
  data() {
    return {};
  },
  methods: {
    RedirectHome(){
        window.location = "#/index"
     }
  },
  mounted() {}
};
</script>