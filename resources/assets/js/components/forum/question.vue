<template>
    <v-card class="mt-4">
       
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">
                <router-link :to="data.path">
                    {{data.title}}
                </router-link>
            </h3>
            <div class="grey--text">{{data.created_at}} by {{data.user}}</div>
          </div>
        </v-card-title>

        <v-card-text>
            {{data.body}}
        </v-card-text>
        
      </v-card>
</template>

<script>
export default {
    props : ['data'],

}
</script>

<style>

</style>
