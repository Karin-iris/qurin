<template>
    <div>
        <select id="sectionSelect"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{$class}}"
                name="secction_id"
                v-model="selected_section_id"
                @change="onSectionChange(selected_section_id)">
            <option value="">セクションを選択</option>
            <option v-for="section in sections" :key="section.id" :value="section.id">
                [{{ section.id }}]{{ section.topic }}
            </option>
        </select>
    </div>
</template>

<script>
import axios from 'axios';
import {ref} from "vue";

export default {
    setup() {
        const sections = ref([]);
        const selected_section_id = ref('');
        // Fetch sections data
        axios.get('/api/section/get_data')
            .then(response => {
                // Ensure the response is in the expected format
                if (Array.isArray(response.data)) {
                    sections.value = response.data;
                } else {
                    console.error('Unexpected response structure:', response);
                }
            })
            .catch(error => {
                console.error('Error fetching the sections:', error);
            });

        return {
            selected_section_id,
            sections
        };
    },
    props: {
        name: {
            type: String,
            required: true
        }
    },
    methods: {
        onSectionChange(selectedId) {
            this.$emit('section-selected', selectedId);
        },
    }
};
</script>
