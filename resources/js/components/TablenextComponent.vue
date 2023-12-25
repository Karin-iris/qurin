<template>
    <div>
        <vue-good-table
            :columns="columns"
            :rows="rows"
        ></vue-good-table>
    </div>
</template>

<script>
import 'vue-good-table-next/dist/vue-good-table-next.css'
import { VueGoodTable } from "vue-good-table-next";
import axios from "axios";

export default {
    name: 'TablenextComponent',
    components: {
        VueGoodTable,
    },
    methods:{
        idField(rowObj) {
            return rowObj.id+ '<br>' + rowObj.user_id;
        },
        textField(rowObj) {
            return rowObj.text;
        },
    },
    mounted() {
        axios.get('/api/question_case/get_question_cases')
            .then(response => {
                this.rows = response.data;
            })
            .catch(error => {
                console.error('Error fetching the items:', error);
            });
    },

    data() {
        return {
            columns: [
                {
                    label: 'Quiz id',
                    field: this.idField,
                },
                {
                    label: 'Topic',
                    field: 'topic',
                },
                {
                    label: 'Text',
                    field: this.textField,
                },
                {
                    label: 'Created On ',
                    field: 'createdAt',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'MMM do yy',
                },
                {
                    label: 'Percent',
                    field: 'score',
                    type: 'percentage',
                },
            ],

            rows: [
            ],
        };
    },
};
</script>
