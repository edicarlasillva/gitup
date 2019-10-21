<template>
  <div class="home">
    <header class="header">
      <div class="container header-align">
        <!-- <p>Repositório de projetos de software</p> -->
        <div class="logo">
          <a href="" @click.prevent="$router.push('index')" class="is-flex">
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
                <!-- <a class="navbar-item">
											Login
                </a>-->
                <span class="navbar-item">
                  <button class="button button--alter is-link">
                    <span class="icon">
                      <i class="fab fa-github"></i>
                    </span>
                    <span>Contribuir</span>
                  </button>
                </span>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>

    <router-view></router-view>

    <footer>
      <section class="colab">
        <div class="container is-flex">
          <div class="left">
            <h2>Colabore</h2>
            <p>
              Projeto open source.
              <br />Ajude a evoluir o GitUP!
            </p>
          </div>
          <div class="right">
            <a href="https://github.com/edicarlasillva/gitup" target="_blank">
              <div>
                <i class="fab fa-github"></i>
              </div>
              <p class="colab-name">Contribuir</p>
            </a>
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
                  <br />Desenvolvido por
                  <a
                    href="https://github.com/edicarlasillva"
                    title="Github"
                    target="_blank"
                  >@edicarlasillva</a>
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
  methods:{
     
  },
  mounted() {
    
  }
};
</script>