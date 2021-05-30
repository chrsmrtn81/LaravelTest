<template>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">


                <div class="row m-0 h-100">

                    <div class="col-2 text-center d-flex">
                        <span class="my-auto me-auto ms-0"><i class="bi bi-chevron-left"></i></span>
                    </div>
                    <div class="col-8">
                        <h3 id="offcanvasRightLabel">{{ article.title }}</h3>
                        <div class="article-card__info-meta mb-4">
                            {{ article.source_name }} / {{ article.pub_date }}
                        </div>
                        


                        <div class="w-100 mb-4" v-if="article.image">
                            <img :src="article.image" />
                        </div>

                        <div v-html="article.content"></div>
                        

                        
                    </div>
                    <div class="col-2 text-center d-flex">
                        <span class="my-auto me-0 ms-auto"><i class="bi bi-chevron-right"></i></span>
                    </div>

                </div>



        </div>

    </div>
</template>

<style scoped>
.offcanvas-end {
    width: 75vw;
}
</style>

<script type="application/javascript">

export default {
    name: "ArticleOffCanvas",
    data() {
        return {
            article: {
                title: null,
                image: null,
                pub_date: null,
                source_name: null,
                content: null
            }
        };
    },
    created() {
        VueEvent.$on('fetchedArticle', (fetchedArticle) => {
            this.article.title = fetchedArticle.data.title  
            this.article.image = fetchedArticle.data.image
            this.article.pub_date = fetchedArticle.data.pub_date
            this.article.source_name = fetchedArticle.data.source_name 
            this.article.content = fetchedArticle.data.content
        })
    },
    updated() {
        twttr.widgets.load()

    }
};
</script>