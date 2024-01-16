<template>
    <div>
        <span v-for="level in maxLevel" :key="level">
            <input type="checkbox" :id="'level-' + level" v-model="selectedLevels[level]">
            <label :for="'level-' + level">レベル {{ level }}</label>&nbsp;&nbsp;
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
            selectedLevels: {}
        };
    },
};
</script>
