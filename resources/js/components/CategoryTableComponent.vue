<template>
    <select id="categorySelect"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{$class}}"
            v-model="selected_primary_id"
    >
        <option disabled value="">親カテゴリを選択</option>
        <option v-for="primary_category in primary_categories" :key="primary_category.id" :value="primary_category.id">
            {{ primary_category.name }}
        </option>
    </select>

    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
        <thead
            class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="border-b-2 border-gray-500">
                <th class="w-20">Qurin Examination ID<br>Examination ID</th>
                <th>試験タイトル</th>
                <th>作成者</th>
                <th>関連問題数</th>
                <th>作成時間<br>更新時間</th>
                <th>編集</th>
            </tr>
        </thead>
        <!--<tr v-for="(item, index) in items" :key="index" class="border-b border-gray-500 text-sm">-->
        <draggable v-model="items" tag="tbody" item-key="index" class="text-md">
            <template #item="{ element }">
                <tr class="border-b border-gray-500 text-sm">
                    <td class="w-20">
                        {{ element.id }}
                    </td>
                    <td>{{ element.topic }}
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
                        {{ element.user_id }}
                    </td>
                    <td>
                        {{ element.text }}
                    </td>
                    <td>
                        <p>{{ element.created_at }}</p>
                        <p>{{ element.updated_at }}</p>
                    </td>
                    <td>
                        <a :href="`/examination/edit/${element.id}`">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            </template>
        </draggable>
    </table>
    <div v-if="page <= 1 && page >= this.items.last_page">
        <div class="flex">
            <button @click="prevPage" :disabled="page <= 1" class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
                Previous
            </button>
            <button @click="nextPage" :disabled="page >= this.items.last_page" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Next
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import draggable from "vuedraggable";
export default {
    components: {
        draggable
    },
    setup() {
        const fetchPrimaryCategories = async () => {
            try {
                const response = await axios.get('/api/examination/get/');
                primary_categories.value = response.data;
            } catch (error) {
                console.error(error);
            }
        };
    },
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
        axios.get('/api/category/get')
            .then(response => {
                this.items = response.data;
            })
            .catch(error => {
                console.error('Error fetching the items:', error);
            });
    },
};
</script>
