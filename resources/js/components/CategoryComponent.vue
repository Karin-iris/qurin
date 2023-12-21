<template>
    <div>
        <select id="categorySelect"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{$class}}"
                v-model="selected_primary_id"
                @change="fetchSecondaryCategories"
        >
            <option disabled value="">親カテゴリを選択</option>
            <option v-for="primary_category in primary_categories" :key="primary_category.id" :value="primary_category.id">
                {{ primary_category.name }}
            </option>
        </select>

        <select id="categorySelect"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{$class}}"
                v-model="selected_secondary_id"
                @change="fetchCategories"
                v-if="secondary_categories.length"
        >
            <option disabled value="">子カテゴリを選択</option>
            <option v-for="secondary_category in secondary_categories" :key="secondary_category.id" :value="secondary_category.id">
                {{ secondary_category.name }}
            </option>
        </select>

        <select id="categorySelect"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{$class}}"
                name="category_id"
                v-model="selected_category_id"
                v-if="categories.length"
        >

            <option disabled value="">孫カテゴリを選択</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
            </option>
        </select>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, computed } from 'vue';
import draggable from 'vuedraggable';

export default {
    setup() {
        const primary_categories = ref([]);
        const secondary_categories = ref([]);
        const categories = ref([]);
        const selected_primary_id = ref('');
        const selected_secondary_id = ref('');
        const selected_category_id = ref('');

        const fetchPrimaryCategories = async () => {
            try {
                const response = await axios.get('/api/category/get_primaries/');
                primary_categories.value = response.data;
            } catch (error) {
                console.error(error);
            }
        };
        const fetchSecondaryCategories = async () => {
            secondary_categories.value = [];
            selected_secondary_id.value = '';
            categories.value = [];
            selected_category_id.value = '';

            if (selected_primary_id.value) {
                try {
                    const response = await axios.get(`/api/category/get_secondaries/${selected_primary_id.value}`);
                    secondary_categories.value = response.data;
                } catch (error) {
                    console.error(error);
                }
            }
        };

        const fetchCategories = async () => {
            categories.value = [];
            selected_category_id.value = '';

            if (selected_secondary_id.value) {
                try {
                    const response = await axios.get(`/api/category/get_children/${selected_secondary_id.value}`);
                    categories.value = response.data;
                } catch (error) {
                    console.error(error);
                }
            }
        };

        fetchPrimaryCategories();

        return {
            primary_categories,
            selected_primary_id,
            selected_secondary_id,
            selected_category_id,
            secondary_categories,
            categories,
            fetchSecondaryCategories,
            fetchCategories,
        };
    },
};
</script>
