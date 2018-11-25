<template>
    <v-container>
         <v-form @submit.prevent="ask">
    
            <v-text-field
            v-model="form.title"
            type="text"
            label="Title"
            required
            ></v-text-field>
            <v-autocomplete
                :items="categories"
                item-text="name"
                item-value="id"
                v-model="form.category_id"
                label="Category"
                
            ></v-autocomplete>

             <markdown-editor v-model="form.body"></markdown-editor>
            

            <v-btn color="green" type="submit">
                Ask
            </v-btn>
         
        </v-form>
    </v-container>
</template>

<script>
export default {

    data(){
        return {
            form : {
                title : null,
                category_id : null,
                body : null
            },
            categories : {},
            errors : {}
        }
    },

    created(){
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
        .catch(err => console.log(err.response.data));
    },

    methods : {
        ask(){

            axios.post('/api/question' , this.form)
            .then(res => this.$router.push(res.data.path))
            .catch(err => {
                this.errors = err.response.data.errors;
                console.log(err.response.data);
            })

        }
    }

}
</script>

<style>

</style>
