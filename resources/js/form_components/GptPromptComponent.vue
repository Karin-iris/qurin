<template>
    <div class="mr-3">
        GPTクエリ2 :
        <div class="relative mr-6 flex flex-wrap items-stretch">
            <input
                type="text"
                id="target"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                v-model="gpt_str2"/>
            <button
                class="z-[2] inline-block rounded-r bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:z-[3] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                type="button"
                @click="writeToClipboard()"
                id="button-addon2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-2 h-2">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                </svg>
                Copy
            </button>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import { ref, computed } from 'vue';
import draggable from 'vuedraggable';

export default {
    setup(props) {
        const selected_primary_id = ref('');
        const selected_secondary_id = ref('');
        const selected_category_id = ref('');
        const gpt_str = ref('');
        const gpt_str2 = ref('');

        if(props.default_selected_primary_id !== null){
            selected_primary_id.value = props.default_selected_primary_id;
        }
        if(props.default_selected_secondary_id !== null){
            selected_secondary_id.value = props.default_selected_secondary_id;
            fetchCategories();
        }
        if(props.default_selected_category_id !== null){
            selected_category_id.value = props.default_selected_category_id;
        }

        return {
            selected_primary_id,
            selected_secondary_id,
            selected_category_id,
            gpt_str,
            gpt_str2
        };
    },
    props: {
        default_selected_primary_id: {
            type:String,
            default: null
        },
        default_selected_secondary_id: {
            type:String,
            default: null
        },
        default_selected_category_id: {
            type:String,
            default: null
        }
    },

    methods: {
        async onCategoryChange() {
            try {
                const response = await axios.get(`/api/category/get_gpt/${this.selected_category_id}`);
                this.gpt_str = response.data;
                console.log(this.gpt_str );
                this.$emit('category-selected', this.selected_category_id);
            } catch (error) {
                console.error(error);
                this.gpt_str = ''; // Reset or handle error
            }
            try {
                const response = await axios.get(`/api/category/get_gpt2/${this.selected_category_id}`);
                this.gpt_str2 = response.data;
                console.log(this.gpt_str2 );
                this.$emit('category-selected', this.selected_category_id);
            } catch (error) {
                console.error(error);
                this.gpt_str2 = ''; // Reset or handle error
            }
        },
        handleSecondaryChange() {
            this.fetchCategories();
            this.onSecondaryChange();
        },
        onSecondaryChange(){
            this.$emit('secondary-category-selected', this.selected_secondary_id);
        },
        handlePrimaryChange() {
            this.fetchSecondaryCategories();
            this.onPrimaryChange();
        },
        onPrimaryChange(){
            this.$emit('primary-category-selected', this.selected_primary_id);
        },
        writeToClipboard(){
            const copyText = this.gpt_str
            navigator.clipboard
                .writeText(copyText)
                .then(() => {
                    console.log('text copy completed')
                })
                .catch(e => {
                    console.error(e)
                })
        }
    }
};
</script>

