<template>
    <div>
        <markdown-editor v-model="reply.reply"></markdown-editor>
        <v-btn icon small>
                    <v-icon color="green" @click="update">
                        save
                    </v-icon>
                </v-btn>
                 <v-btn icon small>
                    <v-icon @click="cancel">
                        cancel
                    </v-icon>
                </v-btn>
    </div>
</template>

<script>
export default {

    props : ['reply'],
    

    methods : {
        cancel(){

            EventBus.$emit('cancel');
        },
        update(){
            
            axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}` , {body : this.reply.reply})
            .then(res => {
                this.cancel();
            })
            .catch(err => console.log(err.response.data));
        }
    },

    computed : {
       content(){
            return md.parse(this.reply);
        }
    }

    

}
</script>

<style>

</style>
