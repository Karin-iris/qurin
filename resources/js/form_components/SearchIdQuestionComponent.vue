<template>
    <div>
        <input type="text" v-model="searchQuery" placeholder="IDを入力" @input="fetchSuggestions">
        <input type="text" v-model="searchTextQuery" placeholder="問題文の一部を入力" @input="fetchSuggestions">
        <ul v-if="suggestions.length">
            <li v-for="suggestion in suggestions" :key="suggestion.id">[{{ suggestion.id }}]{{ suggestion.text }}</li>
        </ul>
    </div>
</template>


<script>
export default {
    data() {
        return {
            searchQuery: '',
            searchTextQuery: '',
            suggestions: []
        };
    },
    methods: {
        async fetchSuggestions() {
            if (!this.searchQuery && !this.searchTextQuery) {
                this.suggestions = [];
                return;
            }

            try {
                const response = await axios.get('/api/question/get_searched_data_by_id', {
                    params: {
                        q_text: this.searchTextQuery,
                        q_id: this.searchQuery // このパラメータはAPIの仕様によります
                    }
                });
                this.suggestions = response.data; // 応答データの形式に応じて調整してください
            } catch (error) {
                console.error('Error fetching suggestions:', error);
                this.suggestions = [];
            }
        }

        /*fetchSuggestions() {
            // 検索クエリに基づいて候補をフェッチするロジックを実装
            // 以下はダミーデータの例です
            if (this.searchQuery) {
                this.suggestions = [
                    { id: 1, text: '候補1' },
                    { id: 2, text: '候補2' },
                    // 検索クエリにマッチする候補を追加
                ];
            } else {
                this.suggestions = []; // クエリが空の場合は候補をクリア
            }
        }*/
    }
}
</script>

