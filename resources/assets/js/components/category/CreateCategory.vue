<template>
    <v-container>
         <v-form @submit.prevent="submit">
             <v-text-field
            v-model="form.name"
            type="text"
            label="Category"
            required
            ></v-text-field>

            <v-btn type="submit" color="teal" v-if="!updateSlug">
                Create
            </v-btn>
            <v-btn type="submit" color="pink" dark v-else>
                update
            </v-btn>
         </v-form>

         <v-card>
             <v-toolbar color="indigo" dark dense>
                 <v-toolbar-title>Categories</v-toolbar-title>
             </v-toolbar>

             <v-list>
                 <div  v-for="(category, index) in categories" :key="category.id" >
                    <v-list-tile>

                    <v-list-tile-action>
                        <v-btn icon small @click="edit(category.slug , index)">
                            <v-icon color="orange">edit</v-icon>
                        </v-btn>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>{{category.name}}</v-list-tile-title>
                    </v-list-tile-content>
                    
                    <v-list-tile-action>
                        <v-btn icon small @click="destroy(category.slug , index)">
                            <v-icon color="red">delete</v-icon>
                        </v-btn>
                    </v-list-tile-action>


                 </v-list-tile>
                 <v-divider></v-divider>
                 </div>
                 
             </v-list>

         </v-card>

    </v-container>
</template>

<script>
export default {

    data(){
        return {
            form : {
                name: null
            },

            categories : {},
            updateSlug : null
        }
    },
     created(){
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
        .catch(err => console.log(err.response.data));
    },

    methods : {

        submit(){
            this.updateSlug ? this.update() : this.create();
        },
        update(){
            axios.patch(`api/category/${this.updateSlug}` , this.form)
            .then(res => {
                this.categories.unshift(res.data);
                console.log(res);
                this.form.name = null;
                this.updateSlug = null;
            })
            .catch(err => console.log(err.response.data));
        },
        create() {

            axios.post('/api/category' , this.form)
            .then(res => {
                this.categories.unshift(res.data);
                console.log(res);
                this.form.name = null;
            })
            .catch(err => console.log(err.response.data));

        },
        edit(slug , index){
            this.updateSlug = slug;
            this.form.name = this.categories[index].name;
            this.categories.splice(index , 1);
        },
        destroy(slug , index){
         
            axios.delete(`/api/category/${slug}`)
            .then(res => {
                this.categories.splice(index , 1);
            })
            .catch(err => console.log(err.response.data));
        }
    }
}
</script>

<style>

</style>
