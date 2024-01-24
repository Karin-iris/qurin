
<template>
    <input type="text" v-model="searchQuery" @input="fetchData" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search"/>
    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
        <thead
            class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr class="border-b-2 border-gray-500">
            <th class="w-20" @click="sort('id')">Qurin Section ID<br>Section ID
                <span v-if="sortKey === 'id'">
          <span v-if="sortOrder === 'asc'">▲</span>
          <span v-else>▼</span>
        </span></th>
            <th @click="sort('title')">セクションタイトル（要約）
                <span v-if="sortKey === 'title'">
                    <span v-if="sortOrder === 'asc'">▲</span>
                    <span v-else>▼</span>
                </span>
            </th>
            <th @click="sort('topic')">セクショントピック
                <span v-if="sortKey === 'topic'">
                    <span v-if="sortOrder === 'asc'">▲</span>
                    <span v-else>▼</span>
                </span>
            </th>
            <th>紐付き問題数</th>
            <th>作成時間<br>更新時間</th>
            <th>編集</th>
        </tr>
        </thead>
        <draggable v-model="items.data" tag="tbody" item-key="index" class="text-md">
            <template #item="{ element }">
                <tr class="border-b border-gray-500 text-sm">
                    <td>
                        <p>{{ element.id }}</p>
                        <p>{{ element.sec_id }}</p>
                    </td>
                    <td>
                        <span v-if="!isEditing(element)">{{ element.topic }}</span>
                        <input v-else type="text" v-model="editableData[element.id].topic" />
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
                        <!--
                        <button class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300" v-if="!isEditing(element)" @click="editItem(element)">Edit</button>
                        <button v-else @click="saveItem(element)">Save</button>
                        -->
                    </td>
                    <td>
                        {{ element.topic }}
                    </td>
                    <td>
                        {{ element.count_questions }}
                    </td>
                    <td>
                        <p>{{ element.created_at }}</p>
                        <p>{{ element.updated_at }}</p>
                    </td>
                    <td>
                        <a :href="`/section/edit/${element.id}`">
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
    <div v-if="this.items.last_page > 1">
        <div class="flex">
            <!-- Previous Button -->
            <button @click="prevPage" :disabled="page <= 1"
                    class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
                Previous
            </button>
            <button @click="nextPage" :disabled="page >= this.items.last_page"
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Next
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';
import draggable from "vuedraggable";

const router = useRouter();
const route = useRoute();
export default {
    components: {
        draggable
    },
    props: {
        mode: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            items: [
            ],
            editableData: {},
            searchQuery: '',
            sortKey: '',
            sortOrder: 'asc',
            page: 1,
            perPage: 10,
            activeChildIndex: null
        };
    },
    mounted() {
        this.fetchData();
        console.log(this.mode);
    },
    methods: {
        fetchData() {
            axios.get('/api/section/paginate', {
                params: {
                    search: this.searchQuery,
                    sort: this.sortKey,
                    order: this.sortOrder,
                    page: this.page,
                    perPage: this.perPage
                }
            })
                .then(response => {
                    //this.items = response.data.data;
                    this.items = response.data;
                })
                .catch(error => {
                    console.error('Error fetching the items:', error);
                });
        },
        sort(key) {
            this.sortKey = key;
            this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
            this.fetchData();
        },
        isEditing(item) {
            return this.editableData.hasOwnProperty(item.id);
        },
        editItem(item) {
            //this.$set(this.editableData, item.id, { ...item });
            this.editableData[item.id] = { ...item };
            this.fetchData();
        },
        saveItem(item) {
            // ここでLaravelのAPIに保存リクエストを送る
            console.log('Saving', this.editableData[item.id]);
            delete this.editableData[item.id];
            this.fetchData();
        },
        prevPage() {
            if (this.page > 1) {
                this.page--;
                this.fetchData();
            }
        },
        nextPage() {
            if (this.page <= this.items.last_page) {
                this.page++;
                this.fetchData();
            }
        }
    }
};
</script>
