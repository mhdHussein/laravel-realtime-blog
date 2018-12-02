<template>
   <div v-if="question">
       <edit-question v-if="editing" :data=question></edit-question>
       <show-question v-else :data="question" ></show-question>
       <v-container>
           <replies :replies="question.replies" :slug="question.slug"></replies>
           <new-reply :QuestionSlug="question.slug"></new-reply>
       </v-container>
   </div>
 
   
</template>
 
<script>
import ShowQuestion from './ShowQuestion';
import EditQuestion from './EditQuestion';
import Replies from '../reply/replies';
import NewReply from '../reply/NewReply';
export default {
    components : {ShowQuestion , EditQuestion , Replies , NewReply},
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

            EventBus.$on('newReply' , (reply) => {
                this.question.replies.unshift(reply);
            })
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
