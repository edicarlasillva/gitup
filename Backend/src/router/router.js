var express = require('express');
var router = express.Router();
var controller = require('../controllers/GitUpController');

router.get("/search",controller.BuscarRepositorios)
router.get("/last-projects",controller.ListarUltimosProjetos)
router.get("/project/:name",controller.buscarProjeto)

module.exports = router