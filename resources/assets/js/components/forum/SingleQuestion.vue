<template>
   <div v-if="question">
       <edit-question v-if="editing" :data=question></edit-question>
       <show-question v-else :data="question" ></show-question>
   </div>
</template>
 
<script>
import ShowQuestion from './ShowQuestion';
import EditQuestion from './EditQuestion';
export default {
    components : {ShowQuestion , EditQuestion},
    data(){
        return {
            question : null,
            editing : false
        }
    },
    created(){
        this.listen();
        this.loadQuestion();
    },

    methods : {

        listen(){
            EventBus.$on('startEdit' , () => {
                this.editing = true;
            });

            EventBus.$on('cancelEdit' , () => {
                this.editing = false;
            });
        },

        loadQuestion(){
            axios.get(`/api/question/${this.$route.params.slug}`)
            .then(res => this.question = res.data.data)
            .catch(err => console.log(err.response.data));
        }

    }
}
</script>

<style>

</style>
