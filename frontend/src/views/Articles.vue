<template>
    <div>
        <h1>Articles list</h1>
        <v-card class="mb-5" v-for="article in articles" :key="article.id">
           <v-card-title primary-title class="py-4">{{article.title}}</v-card-title>
           <div class="font-weight-regular">{{ article.body }}</div>
        </v-card>
    </div>
</template>

<script>
import axiox from 'axios';
export default {
  name: 'articles',
  components: {
  },
  data () {
    return {
      articles: null
    }
  },
  created () {
    this.getArticles()
  },
  methods: {
    getArticles(){
      axiox
        .get('/api/articles')
        .then(response =>{
          const {data:{data}} = response
          this.articles = data
          console.log(response)
        } )
    }
  }
}
</script>

