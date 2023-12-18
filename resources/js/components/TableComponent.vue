<template>
    <table>
        <tr v-for="(item, index) in items" :key="index">
            <td @click="toggleChildren(item)">{{ item.topic }}
                <ul v-if="item.showChildren">
                    <li v-for="(child, childIndex) in item.children" :key="childIndex">
                        {{ child.topic }}
                    </li>
                </ul>
                <!--
                <ul v-if="activeChildIndex === index">
                    <li v-for="(child, childIndex) in item.children" :key="childIndex">
                        {{ child.name }}
                    </li>
                </ul>-->
            </td>
        </tr>
    </table>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            items: [
                /*{name: 'Item 1', children: [{name: 'Child 1-1'}, {name: 'Child 1-2'}]},
                {name: 'Item 2', children: [{name: 'Child 2-1'}, {name: 'Child 2-2'}]},
                {name: 'Item 3', children: []},*/
                // 他のアイテム
            ],
            activeChildIndex: null
        };
    },
    mounted() {
        axios.get('/api/question_case/get_question_cases')
            .then(response => {
                this.items = response.data;
            })
            .catch(error => {
                console.error('Error fetching the items:', error);
            });
    },
    methods: {
        async toggleChildren(item) {
            if (item.childrenLoaded) {
                item.showChildren = !item.showChildren;
                return;
            }

            try {
                const response = await axios.get(`/api/question_case/get_question_case_questions/${item.id}`);
                item.children = response.data;
                item.childrenLoaded = true;
                item.showChildren = true;
            } catch (error) {
                console.error('Error fetching children:', error);
            }

            //this.activeChildIndex = this.activeChildIndex === index ? null : index;
        }
    }
};
</script>
