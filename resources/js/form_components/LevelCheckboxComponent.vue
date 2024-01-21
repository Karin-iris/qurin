<template>
    <div class="flex">
        <div v-for="level in maxLevel" :key="level" class="flex items-center me-4">
            <input type="checkbox" :id="'level-' + level" v-model="checkedLevels[level]" @change="onLevelChange(level)" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label :for="'level-' + level" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">レベル {{ level }}</label>
        </div>
    </div>


</template>

<script>
export default {
    props: {
        maxLevel: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            checkedLevels: {}
        };
    },
    methods: {
        onLevelChange(level) {
            // Emitting 'level-change' event with level and its new state
            this.$emit('level-checked', { level: level, isChecked: this.checkedLevels[level] });
        }
    }
};
</script>
