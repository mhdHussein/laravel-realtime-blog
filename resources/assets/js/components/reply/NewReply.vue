<template>
    <div class="mt-4">
        <markdown-editor v-model="body"></markdown-editor>
        <v-btn color="green" dark @click="submit">
            Reply
        </v-btn>
    </div>
</template>

<script>
export default {
    props : ['QuestionSlug'],
    data(){
        return {
            body : null
        }
    },
    methods : {
        submit(){
            axios.post(`/api/question/${this.QuestionSlug}/reply` , {body : this.body})
            .then(res => {
                this.body = '';
                EventBus.$emit('newReply' , res.data.reply);
                window.scrollTo(0,0);
            })
            .catch(err => console.log(err.response.data));
        }
    }
}
</script>

<style>

</style>
