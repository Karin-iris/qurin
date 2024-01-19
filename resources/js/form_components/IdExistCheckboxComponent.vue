<template>
    <div>
        <span>
            <input type="checkbox" name="is_exist" @change="onExistChange" v-model="isExist">
            <label for="is_exist">ID有り</label>
        </span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isExist: false
        };
    },
    methods: {
        onExistChange() {
                // チェックボックスがチェックされた場合、クエリを送信します。
                this.$emit('id-exist', Number(this.isExist));
        },
    }
}
</script>
