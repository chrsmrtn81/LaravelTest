<template>
    <ul>

        <li v-for="item, key in mutableArticles" class="article-card__animated" :style="{'--animation-order': key}" >
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
    data() {
        return {
            mutableArticles: this.articles
        };
    },
    created() {
        VueEvent.$on('updatedArticles', (updatedArticles) => {
            this.mutableArticles = updatedArticles.updatedArticles        
        })
    },
    props: {
        articles: {
            type: Array,
            required: true
        }
    },
    methods : {
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
        }
    }
};
</script>
