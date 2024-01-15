<template>
    <div>
        <button type="button" @click="toggleVisibility">表示/非表示</button>
        <div v-if="isVisible">
            <input name="password" type="text" v-model="inputValue" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isVisible: false,
            inputValue: ''
        };
    },
    methods: {
        toggleVisibility() {
            this.isVisible = !this.isVisible;
        },
    }
}
</script>
