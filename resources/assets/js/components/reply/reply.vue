<template>
    <div class="mt-3">
        <v-card>
            <v-card-title>
                <div class="headline">{{data.user}}</div>
                <div class="ml-2">Said {{data.created_at}}</div>
            </v-card-title>
            <v-divider></v-divider>
             <edit-reply v-if="editing" :reply="data"></edit-reply>
            <v-card-text v-html="reply" v-else></v-card-text>

           
            <v-divider></v-divider>
            <div v-if="!editing">
                <v-card-actions v-if="own">
                <v-btn icon small>
                    <v-icon color="orange" @click="edit">
                        edit
                    </v-icon>
                </v-btn>
                 <v-btn icon small>
                    <v-icon color="red" @click="destroy">
                        delete
                    </v-icon>
                </v-btn>
            </v-card-actions>
          
            </div>
        </v-card>
    </div>
</template>

<script>

import EditReply from './EditReply';

export default {
    components : {EditReply},
    props : ['data' , 'index'],

    data(){
        return {
            own : User.own(this.data.user_id),
            editing : false
        }
    },

    created(){
        this.listen();
    },

    methods : {
        destroy(){
            EventBus.$emit('deleteReply' , this.index);
        },

        edit(){
            this.editing = true;
        },

        listen(){
            EventBus.$on('cancel' , () => {
                this.editing = false;
            });
        }
    },
    computed : {
        reply(){
            return md.parse(this.data.reply);
        }
    }
}
</script>

<style>

</style>
