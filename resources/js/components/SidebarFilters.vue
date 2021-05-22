<template>
    <div
        id="panelsStayOpen-collapseOne"
        class="accordion-collapse collapse show"
        aria-labelledby="panelsStayOpen-headingOne"
    >
        <div class="accordion-body sidebar__filter">
            <div v-for="item in sourceFilters" class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    :id="item.name"
                    name="sourceNameFilter"
                    :value="item.id"
                    v-on:click="toggleChecked(item.name)"
                    :checked="item.checked"
                />
                <label class="form-check-label" for="flexCheckDefault">
                    {{ item.nice_name }}
                </label>
            </div>
        </div>
    </div>
</template>

<script type="application/javascript">
import axios from "axios";

export default {
    name: "SidebarFilters",
    created() {
        //this.fetchData();
    },
    props: {
        sourceFilters: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            articles: []
        };
    },
    methods: {
        // fetchData() {
        //     axios.post("/ajax").then(
        //         response => {
        //             let selectedSourceFilters = JSON.parse(
        //                 localStorage.getItem("selectedSourceFilters")
        //             );

        //             let i;
        //             for (i = 0; i < response.data.length; i++) {
        //                 if (selectedSourceFilters) {
        //                     if (
        //                         selectedSourceFilters.includes(
        //                             response.data[i].id.toString()
        //                         )
        //                     ) {
        //                         response.data[i].checked = true;
        //                     } else {
        //                         response.data[i].checked = false;
        //                     }
        //                 } else {
        //                     response.data[i].checked = true;
        //                 }
        //             }

        //             this.sourceFilters = response.data;
        //         },
        //         error => {
        //             console.log(error.response.data);
        //         }
        //     );
        // },
        toggleChecked(id) {
            let ids = [];
            let checked = document.querySelectorAll(
                "input[name=sourceNameFilter]:checked"
            );

            let i;
            for (i = 0; i < checked.length; i++) {
                ids.push(checked[i].value)
            }

            localStorage.setItem(
                "selectedSourceFilters",
                JSON.stringify(ids)
            );

            axios.post("/updateCookies", {
                "ids": localStorage.getItem("selectedSourceFilters")
            }).then(
                response => {
                    VueEvent.$emit('updatedArticles', {'updatedArticles': response.data})
                },
                error => {
                    console.log(error.response.data)
                }
            )
        }
    }
}
</script>
