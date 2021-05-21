<template>

</template>

<script type="application/javascript">
import axios from "axios";

export default {
    name: "app",
    created() {
        this.fetchData();
    },
    data() {
        return {
            sourceFilters: []
        };
    },
    methods: {
        fetchData() {
            axios.post("/ajax").then(
                response => {
                    let selectedSourceFilters = JSON.parse(
                        localStorage.getItem("selectedSourceFilters")
                    );

                    let i;
                    for (i = 0; i < response.data.length; i++) {
                        if (
                            selectedSourceFilters.includes(
                                response.data[i].id.toString()
                            )
                        ) {
                            response.data[i].checked = true;
                        } else {
                            response.data[i].checked = false;
                        }
                    }

                    this.sourceFilters = response.data;
                },
                error => {
                    console.log(error.response.data);
                }
            );
        },
        toggleChecked(id) {
            let values = [];
            let checked = document.querySelectorAll(
                "input[name=sourceNameFilter]:checked"
            );

            let i;
            for (i = 0; i < checked.length; i++) {
                values.push(checked[i].value);
            }

            localStorage.setItem(
                "selectedSourceFilters",
                JSON.stringify(values)
            );
        }
    }
};
</script>
