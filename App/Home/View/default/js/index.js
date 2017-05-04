var app = new Vue({
  el: '#app',
  data: {
    message: 'Hello Vue!'
  }
})

var app2 = new Vue({
    el: '#app-2',
    data:{
        message:'You loaded this page on' + new Date(),
        hello: 'WTF'
    }
})

var app3 = new Vuw({
    el: '#app-3',
    data:{
        seen:true
    }
})
