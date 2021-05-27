<template>
    <div>
        <h1 id="cc_feed-title" class="my-5 pt-5">Most Recent</h1>
        <ul id="article-card--large" v-if="this.displayList">
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
                                {{ item.description }}
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <div class="spinner-border text-warning" role="status" v-else>
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
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
            loadArticleOffset: 10,
            displayList: true,
            scrollToTop: false
        };
    },
    created() {
        VueEvent.$on('updatedArticles', (updatedArticles) => {

            if(!window.scrollY == 0){
                window.scrollTo(0, 0)
                this.scrollToTop = true
            }

            this.displayList = false
           
            this.mutableArticles = []
            this.mutableArticles = updatedArticles.updatedArticles

            if(window.scrollY == 0){
                setTimeout(this.test, 1000)
            }
        })

        this.handleDebouncedScroll = this.debounce(this.handleScroll, 100)
        window.addEventListener('scroll', this.handleDebouncedScroll)
    },
    destroyed () {
        window.removeEventListener('scroll', this.handleDebouncedScroll)
    },
    methods : {
        updateArticles: function(){
            this.mutableArticles = updatedArticles.updatedArticles
            this.displayList = true 
        },
        handleScroll: function(test){
            if(window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 1){
                this.fetchMoreArticles()
            }

            if(window.scrollY == 0 && this.scrollToTop == true){
                setTimeout(this.test, 1000)
            }
        },
        test: function(){
            this.scrollToTop = false
            this.displayList = true
        },
        fetchMoreArticles: function(){
            window.axios.post("/test-fetch", {
            "offset": this.loadArticleOffset
            }).then(
                response => {
                    const fetchedArticles = this.mutableArticles.concat(response.data);
                    this.mutableArticles = fetchedArticles
                },
                error => {
                    console.log(error.response.data)
                }
            )
        
        this.loadArticleOffset += 10
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
