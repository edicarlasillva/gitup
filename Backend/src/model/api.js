module.exports = `{
    "@context": {
        "doap": "http://usefulinc.com/ns/doap#",
        "foaf": "http://xmlns.com/foaf/0.1/",
        "rdfs": "http://www.w3.org/2000/01/rdf-schema#",
        "doap:description": {
          "@id": "doap:description",
          "@container": "@language"
        },
        "doap:shortdesc": {
          "@id": "doap:shortdesc",
          "@container": "@language"
        }
      },
      "@graph": [
        {
          "@id": ":t0",
          "author":"Rafael Marques",
          "name": "PROJETO DOAP",
          "doap:browse": "https://github.com/ewilderj/doap/",
          "subject": "Ontologia, Web Semântica, Linked Data, Motivação"
        }, {
          "@id": "http://me.markus-lanthaler.com/",
          "author":"Edicarla Silva",
          "name": "SISTEMA REALIDADE AUMENTADA CONAREC",
          "knows": { "@id": ":t0" },
          "doap:browse": "https://github.com/welcome-the-future/conarec/",
          "subject": "Motivação, Inovação"
        }
      ]
    }`