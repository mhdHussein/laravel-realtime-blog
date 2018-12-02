<template>
    <div>
        <reply v-for="(reply,index) in content" :data=reply :index=index  :key="reply.id"></reply>
    </div>
</template>

<script>
import Reply from './reply';
export default {
    
    components : {Reply},

    props : ['replies' , 'slug'],

    created(){
        this.listen();
    },
    data(){
        return {
            content : this.replies
        }
    },
    methods : {
        listen(){
            EventBus.$on('deleteReply' , (index) => {
                
                console.log(index);
                axios.delete(`/api/question/${this.slug}/reply/${this.content[index].id}`)
                .then(res => {
                    this.content.splice(index , 1);
                })
                .catch(err => console.log(err.response.data));
            })
        }
    }
}
</script>

<style>

</style>
