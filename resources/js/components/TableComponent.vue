<template>
    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
        <thead
            class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr class="border-b-2 border-gray-500">
            <th class="w-20">Qurin Section ID<br>Section ID</th>
            <th>試験問題（要約）</th>
            <th>作成者</th>
            <th>紐付き問題数</th>
            <th>作成時間<br>更新時間</th>
            <th>問題の追加</th>
            <th>編集</th>
        </tr>
        </thead>
        <tbody class="text-md">
        <tr v-for="(item, index) in items" :key="index" class="border-b border-gray-500 text-sm">
            <td>
                {{ item.id }}
            </td>
            <td @click="toggleChildren(item)">{{ item.topic }}
                <!--<ul v-if="item.showChildren">
                    <li v-for="(child, childIndex) in item.children" :key="childIndex">
                        {{ child.topic }}
                    </li>
                </ul>-->
                <!--
                <ul v-if="activeChildIndex === index">
                    <li v-for="(child, childIndex) in item.children" :key="childIndex">
                        {{ child.name }}
                    </li>
                </ul>-->
            </td>
            <td>
                {{ item.user_id }}
            </td>
            <td>
                {{ item.count_questions }}
            </td>
            <td>
                <p>{{ item.created_at }}</p>
                <p>{{ item.updated_at }}</p>
            </td>
            <td>
                <a :href="`/question_case/q_add/${item.id}`">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                    </svg>
                </a>
            </td>
            <td>
                <a :href="`/question_case/edit/${item.id}`">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                    </svg>
                </a>
            </td>
        </tr>
        </tbody>
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
        axios.get('/api/question_case/get_question_case_with_questions')
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
