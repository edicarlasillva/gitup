const github = require('octonode')
var client = github.client({
   username:"welcome-the-future",
   password:"(thewtf10*)"
})

let repo = client.repo("welcome-the-future/conarec")
repo.info((x,data,y)=>{
     console.log(data.license)
})