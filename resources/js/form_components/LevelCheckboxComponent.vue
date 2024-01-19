<template>
    <div>
        <span v-for="level in maxLevel" :key="level">
            <input type="checkbox" :id="'level-' + level" v-model="checkedLevels[level]" @change="onLevelChange(level)" >
            <label :for="'level-' + level">レベル {{ level }}</label>
        </span>
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
