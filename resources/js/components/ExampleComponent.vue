<template>
    <draggable v-model="items" @end="onDragEnd">
        <div v-for="item in items" :key="item.id">
            {{ item.name }}
        </div>
    </draggable>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    components: {
        draggable
    },
    data() {
        return {
            items: [
                { id: 1, name: 'Banana' },
                { id: 2, name: 'Apple' },
                { id: 3, name: 'Orange' },
            ]
        };
    },
    methods: {
        onDragEnd() {
            axios.post('/api/items/order', {
                items: this.items
            })
                .then(response => {
                    // 成功時の処理
                })
                .catch(error => {
                    // エラー時の処理
                });
        }
    }
};
</script>
