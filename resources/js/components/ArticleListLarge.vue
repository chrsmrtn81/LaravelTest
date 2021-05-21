<template>
    <ul>

        <li v-for="item, key in articles" class="article-card__animated" v-bind:style="{'--animation-order': key}">
            <div class="row mb-4 py-3 article-card">
                <div class="col-2">
                    <div
                        class="w-100 article-card__img"
                        v-bind:style="{'background-image': 'url(' + item.image + ')'}"
                    ></div>
                </div>
                <div class="col-10">
                    <a class="m-0">{{ item.title }}</a
                    ><br />
                    <div class="article-card__info-meta">
                        {{ item.source_name }} / {{ item.pub_date }}
                    </div>
                    <div class="article-card__info-meta">
                        {{ item.short_description }}
                    </div>
                </div>
            </div>
        </li>

    </ul>
</template>

<script type="application/javascript">
//import axios from "axios";

export default {
    name: "app",
    created() {
        //this.fetchData()
    },
    props: {
        articles: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            //sourceFilters: []
        };
    }
};
</script>
