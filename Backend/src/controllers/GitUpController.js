const bd = JSON.parse(require("../model/api"))['@graph']
const github = require('octonode')
var client = github.client({
   username: "edicarlasillva",
   password: "Carlinha@123"
})

exports.BuscarRepositorios = async (req, res, next) => {

   let query = req.query.q
   let search_result = []
   for (let i = 0; i < bd.length; i++) {

      if (bd[i].subject.includes(query)) {

         let url = bd[i]["doap:browse"].split("/");
         let rep = client.repo(url[3] + "/" + url[4])
         await rep.languagesAsync().then(data => {
            temp = {
               "id": i + 1,
               "nome_projeto": bd[i]['name'],
               "git_url": bd[i]["doap:browse"],
               "linguagens": data[0],
               "versoes": "",
               "branches": "",
               "autor": bd[i]['author'],
               "palavras_chaves": bd[i]['subject'].split(",")
            }

            return rep.releasesAsync().then(data2 => {

               let releaseList = data2[0]
               let temp2 = []
               releaseList.map(value => {
                  temp2.push({
                     versao: value.tag_name,
                     data_publicacao: value.published_at
                  })
               })
               temp.versoes = temp2

               return rep.branchesAsync().then(data3 => {
                  let branches = []
                  data3[0].map(value => {
                     let temp5 = {}
                     temp5.nome = value.name
                     branches.push(temp5)
                  })
                  temp.branches = branches
                  search_result.push(temp)
               })



            })



         })
      }
   }
   return res.status(200).json(search_result)
}

exports.ListarUltimosProjetos = async (req, res, next) => {
   console.log("OK ROTA")
   let search_result = []
   for (let i = 0; i < bd.length; i++) {

      let url = bd[i]["doap:browse"].split("/");
      let rep = client.repo(url[3] + "/" + url[4])
      await rep.languagesAsync().then(data => {
         temp = {
            "id": i + 1,
            "nome_projeto": bd[i]['name'],
            "git_url": bd[i]["doap:browse"],
            "linguagens": data[0],
            "versoes": "",
            "branches": "",
            "autor": bd[i]['author'],
            "palavras_chaves": bd[i]['subject'].split(",")
         }

         return rep.releasesAsync().then(data2 => {

            let releaseList = data2[0]
            let temp2 = []
            releaseList.map(value => {
               temp2.push({
                  versao: value.tag_name,
                  data_publicacao: value.published_at
               })
            })
            temp.versoes = temp2

            return rep.branchesAsync().then(data3 => {
               let branches = []
               data3[0].map(value => {
                  let temp5 = {}
                  temp5.nome = value.name
                  branches.push(temp5)
               })
               temp.branches = branches
               search_result.push(temp)
            })



         })



      }).catch(error => {
         console.log(error)
      })

   }
   return res.status(200).json(search_result)
}

exports.buscarProjeto = async (req, res, next) => {
   let search_result = []
   for (let i = 0; i < bd.length; i++) {
      if (bd[i]['name'].includes(req.params.name)) {
         let url = bd[i]["doap:browse"].split("/");
         let rep = client.repo(url[3] + "/" + url[4])
         await rep.languagesAsync().then(data => {
            temp = {
               "id": i + 1,
               "nome_projeto": bd[i]['name'],
               "git_url": bd[i]["doap:browse"],
               "linguagens": data[0],
               "versoes": "",
               "branches": "",
               "autor": bd[i]['author'],
               "palavras_chaves": bd[i]['subject'].split(","),
               "licenca": null
            }

            return rep.releasesAsync().then(data2 => {

               let releaseList = data2[0]

               let temp2 = []
               releaseList.map(value => {

                  temp2.push({
                     versao: value.tag_name,
                     data_publicacao: value.published_at,
                     resumo: value.body
                  })
               })
               temp.versoes = temp2

               return rep.branchesAsync().then(data3 => {
                  let branches = []
                  data3[0].map(value => {
                     let temp5 = {}
                     temp5.nome = value.name
                     branches.push(temp5)
                  })
                  temp.branches = branches

                  return rep.infoAsync().then(data6 => {
                     temp.licenca = data6[0].license
                     search_result.push(temp)
                  })



               })



            })



         })
      }
   }
   return res.status(200).json(search_result)
}