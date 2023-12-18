<template>
    <draggable  v-model="items" @end="onDragEnd">
        <template v-slot:item="{ element }">
            <div :key="element.id">
                {{ element.name }}
            </div>
        </template>
    </draggable>
</template>

<script>
import { ref } from 'vue';
import draggable from 'vuedraggable';

export default {
    name: 'ExampleComponent',
    components: {
        draggable
    },
    setup() {
        const items = ref([
            { id: 1, name: 'Banana' },
            { id: 2, name: 'Apple' },
            { id: 3, name: 'Orange' },
        ]);

        const onDragEnd = () => {
            // Drag end logic
        };

        return {
            items,
            onDragEnd
        };
    }
};
</script>
