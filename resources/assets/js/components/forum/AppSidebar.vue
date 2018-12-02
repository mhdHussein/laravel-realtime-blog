<template>
    <v-card>
        <v-toolbar color="cyan" dark dense class="mt-4">
            <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>
        <v-list>
            <v-list-tile v-for="category in categories" :key="category.id">
                <v-list-tile-content>
                    <v-list-lile-title>{{category.name}}</v-list-lile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-card>
</template>

<script>
export default {

    data(){
        return {
            categories : {}
        }
    },

    created(){
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
        .catch(err => console.log(err.response.data));
    }
}
</script>

<style>

</style>
