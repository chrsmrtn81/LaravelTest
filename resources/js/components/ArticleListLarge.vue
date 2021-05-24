<template>
    <ul>

        <li v-for="item, key in mutableArticles" class="article-card__animated">
            <a data-bs-toggle="offcanvas" v-on:click="getArticle(item)" href="#offcanvasRight" role="button" aria-controls="offcanvasRight">
                <div class="row mb-4 py-3 article-card">
                    <div class="col-2">
                        <div
                            class="w-100 article-card__img"
                            :style="[item.image ?  {'background-image': 'url(' + item.image + ')'} : {'background-image': 'url(/img/no_image.png)'}]"
                        >
                        </div>
                    </div>
                    <div class="col-10">
                        <a class="m-0">{{ item.title }}</a
                        ><br />
                        <div class="article-card__info-meta">
                            <span>{{ item.source_name }}</span> / 
                            <span>{{ item.pub_date }}</span> / 
                            <span :class="'article-card__info-meta__views-' + item.id">{{ item.views }}</span> views
                        </div>
                        <div class="article-card__info-meta">
                            {{ item.short_description }}
                        </div>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</template>

<script type="application/javascript">

import axios from "axios";

export default {
    name: "ArticleListLarge",
    props: {
        articles: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            mutableArticles: this.articles,
            loadArticleOffset: 10
        };
    },
    created() {
        VueEvent.$on('updatedArticles', (updatedArticles) => {
            this.mutableArticles = updatedArticles.updatedArticles        
        })

        this.handleDebouncedScroll = this.debounce(this.handleScroll, 100);
        window.addEventListener('scroll', this.handleDebouncedScroll);
    },
    destroyed () {
        window.removeEventListener('scroll', this.handleDebouncedScroll);
    },
    methods : {
        handleScroll: function(){

            if(window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 1){
                this.fetchMoreArticles()
            }
        },
        fetchMoreArticles: function(){
            window.axios.post("/test-fetch", {
            "offset": this.loadArticleOffset
            }).then(
                response => {

                    const array3 = this.mutableArticles.concat(response.data);

                    this.mutableArticles = array3

                    // let i = 0

                    // while(i < response.data.length){
                    //     this.mutableArticles.push(response.data[i]);
                    //     i++
                    // }
                },
                error => {
                    console.log(error.response.data)
                }
            )
        
        this.loadArticleOffset += 10

        console.log(this.loadArticleOffset)
        },
        getArticle: function(data){
            this.addArticleView(data.id)
            VueEvent.$emit('fetchedArticle', {'data': data })
        },
        addArticleView: function(id){
            axios.post("/addArticleView", {
                "id": id
            }).then(
                response => {
                    let currentViews = parseInt(document.getElementsByClassName("article-card__info-meta__views-" + id)[0].innerHTML)
                    document.getElementsByClassName("article-card__info-meta__views-" + id)[0].innerHTML = currentViews + response.data
                },
                error => {
                    console.log(error.response.data)
                }
            )
        },
        debounce: function (func, wait, immediate) {
        var timeout;

            return function executedFunction() {
                var context = this;
                var args = arguments;
                    
                var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
                };

                var callNow = immediate && !timeout;
                
                clearTimeout(timeout);

                timeout = setTimeout(later, wait);
                
                if (callNow) func.apply(context, args);
            }
        }
    }
};
</script>
