<template>
    ID検索
    <id-exist-component
        @id-exist="onExistCheck"
        :name="is_quizid">
    </id-exist-component>
    quiz id<br>
    <input type="text" v-model="quizid" @input="fetchData"><br>
    qurin id<br>
    <input type="text" v-model="qurinid" @input="fetchData"><br>
    セクション
    <section-select-component
        @section-selected="onSectionSelected"
        :name="section_id">
    </section-select-component>
    カテゴリ
    <category-component
        @category-selected="onCategorySelected"
        @secondary-category-selected="onSecondaryCategorySelected"
        @primary-category-selected="onPrimaryCategorySelected"
    ></category-component>
    コンピテンシー
    <level-checkbox-component
        :max-level="2"
        @level-checked="onLevelChecked"
    >
    </level-checkbox-component>
    検索文字列:<input type="text" v-model="searchQuery" @input="fetchData"
                      class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="Search"/>

    {{ this.items.total }}
    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
        <thead
            class="p-10 text-sm text-white uppercase bg-gray-600 dark:bg-gray-800 dark:text-gray-400">
        <tr class="border-b-2 border-gray-500">
            <th class="w-20">Qurin Examination ID<br>Examination ID</th>
            <th>セクション</th>
            <th>大カテゴリ
            </th>
            <th>中カテゴリ</th>
            <th>小カテゴリ</th>
            <th @click="sort('text')">問題文
                <span v-if="sortKey === 'text'">
                    <span v-if="sortOrder === 'asc'">▲</span>
                    <span v-else>▼</span>
                </span>
            </th>
            <th @click="sort('topic')">問題トピック
                <span v-if="sortKey === 'topic'">
                    <span v-if="sortOrder === 'asc'">▲</span>
                    <span v-else>▼</span>
                </span>
            </th>
            <th>作成時間<br>更新時間</th>
            <th>編集</th>
        </tr>
        </thead>
        <!--<tr v-for="(item, index) in items" :key="index" class="border-b border-gray-500 text-sm">-->
        <draggable v-model="items.data" tag="tbody" item-key="index" class="text-md">
            <template #item="{ element }">
                <tr class="border-b border-gray-500 text-sm">
                    <td class="w-20">
                        <p>{{ element.id }}</p>
                        <p>{{ element.quiz_id }}</p>
                    </td>
                    <td class="w-20">
                        {{ element.section_id }}
                    </td>
                    <td class="w-20">
                        {{ element.p_c_name }}
                    </td>
                    <td class="w-20">
                        {{ element.s_c_name }}
                    </td>
                    <td class="w-20">
                        {{ element.c_name }}
                    </td>
                    <td>
                        {{ element.text }}
                    </td>
                    <td>
                        {{ element.topic }}
                    </td>
                    <td>
                        <p>{{ element.created_at }}</p>
                        <p>{{ element.updated_at }}</p>
                    </td>
                    <td>
                        <a :href="`/question/edit/${element.id}`">
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
    <!--
        <button @click="prevPage" :disabled="page <= 1">Prev</button>
        <span>Page {{ page }}</span>
        <button @click="nextPage" :disabled="page >= this.items.last_page">Next</button>
        -->
    </div>
</template>

<script>
import axios from 'axios';
import draggable from "vuedraggable";
import CategoryComponent from './CategoryComponent.vue';
import IdExistComponent from '../form_components/IdExistCheckboxComponent.vue';
import SectionSelectComponent from '../form_components/SectionSelectComponent.vue';
import LevelCheckboxComponent from '../form_components/LevelCheckboxComponent.vue';

export default {
    components: {
        draggable,
        SectionSelectComponent,
        CategoryComponent,
        LevelCheckboxComponent,
        IdExistComponent
    },
    data() {
        return {
            items: [
                /*{name: 'Item 1', children: [{name: 'Child 1-1'}, {name: 'Child 1-2'}]},
                {name: 'Item 2', children: [{name: 'Child 2-1'}, {name: 'Child 2-2'}]},
                {name: 'Item 3', children: []},*/
                // 他のアイテム
            ],
            editableData: {},
            c_id: '',
            s_id: '',
            p_id: '',
            se_id: '',
            has_quizid:'',
            l: [],
            searchQuery: '',
            sortKey: '',
            sortOrder: 'asc',
            page: 1,
            perPage: 10,
            activeChildIndex: null,
            quizid: '',
            qurinid: ''
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/api/question/paginate', {
                params: {
                    search: this.searchQuery,
                    c_id: this.c_id,
                    s_id: this.s_id,
                    p_id: this.p_id,
                    se_id: this.se_id,
                    has_quizid: this.is_quizid,
                    l: this.l,
                    sort: this.sortKey,
                    order: this.sortOrder,
                    page: this.page,
                    perPage: this.perPage,
                    quizid: this.quizid,
                    qurinid: this.qurinid
                }
            })
                .then(response => {
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
        onExistCheck(is_q){
            this.is_quizid = is_q;
            this.fetchData();
        },
        onSectionSelected(sectionId) {
            this.se_id = sectionId;
            this.page = '';
            this.fetchData();
        },
        onCategorySelected(categoryId) {
            this.c_id = categoryId;
            this.page = '';
            this.fetchData();
        },
        onSecondaryCategorySelected(categoryId) {
            this.s_id = categoryId;
            this.c_id = '';
            this.page = '';
            this.fetchData();
        },
        onPrimaryCategorySelected(categoryId) {
            this.p_id = categoryId;
            this.s_id = '';
            this.c_id = '';
            this.page = '';
            this.fetchData();
        },
        onLevelChecked(data) {
            if (data.isChecked === true) {
                this.l.push(data.level);
            } else {
                this.l = this.l.filter(item => item !== data.level);
            }
            this.page = '';
            this.fetchData();
            //console.log('Level changed:', data.level, 'New State:', data.isChecked);
        },
        isEditing(item) {
            return this.editableData.hasOwnProperty(item.id);
        },
        editItem(item) {
            //this.$set(this.editableData, item.id, { ...item });
            this.editableData[item.id] = {...item};
            this.fetchData();
        },
        saveItem(item) {
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
        },

    },

};
</script>
