<template>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">{{ article.title }}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            {{ article.source_name }} <br>
            {{ article.pub_date }}
        </div>
    </div>
</template>

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
            }
        };
    },
    created() {
        VueEvent.$on('fetchedArticle', (fetchedArticle) => {
            this.article.title = fetchedArticle.data.title  
            this.article.image = fetchedArticle.data.image
            this.article.pub_date = fetchedArticle.data.pub_date
            this.article.source_name = fetchedArticle.data.source_name 
        })
    }
};
</script>