<template>
  <v-toolbar>
    <!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
    <v-toolbar-title>Md Questions</v-toolbar-title>
    <v-spacer></v-spacer>
    <app-notifications></app-notifications>
    <div class="hidden-sm-and-down">
      
      <router-link 
      v-for="item in items"
      :key="item.title"
      :to="item.to"
      v-if="item.show"
      >
        <v-btn flat >{{item.title}}</v-btn>
      </router-link>
    </div>
  </v-toolbar>
</template>
<script>
import AppNotifications from './AppNotifications';
export default {
  components : {AppNotifications},
  data() {
    return {
      items : [
        {title : 'Forum' , to : '/forum' , show : true},
        {title : 'Ask Question' , to : '/ask' , show : User.loggedIn()},
        {title : 'Catgories' , to : '/category' , show : User.loggedIn()},
        {title : 'Login' , to : '/login' , show : !User.loggedIn()},
        {title : 'Logout' , to : '/logout' , show : User.loggedIn()},
      ]
    };
  },
  created() {
    EventBus.$on('logout' , () => {
      User.logout();
    });
  }

}
</script>

<style>

</style>
