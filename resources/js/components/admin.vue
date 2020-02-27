<template>
  <v-app>
    <v-navigation-drawer
      app
      fixed
      expand-on-hover
      clipped
      :mini-variant.sync="mini"
      permanent
      
      > 
      <!-- <v-divider></v-divider>       -->
      <v-list-item class="px-2">
        <v-list-item-avatar @click.stop="mini = !mini">
          <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
        </v-list-item-avatar>
        <v-list-item-title>John Leider</v-list-item-title>
      </v-list-item>
      
      <!-- <v-divider></v-divider> -->
      
      <v-list dense>
        <v-list-item link @click="dashboard">
          <v-list-item-action>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link @click="Reservations">
          <v-list-item-action>
            <v-icon>mdi-calendar</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title >Reservations</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link @click="Users">
          <v-list-item-action>
            <v-icon>mdi-account-group</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title >Users</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link @click="chat">
          <v-list-item-action>
            <v-icon>mdi-chat</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Live Chat</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link @click="logout">
          <v-list-item-action>
            <v-icon>mdi-logout-variant</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-content>
      <v-toolbar>
        <v-toolbar-title>Dashboard</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon>
          <v-icon @click="logout">mdi-logout-variant</v-icon>
        </v-btn>
        <theme></theme>
      </v-toolbar>
      <component v-bind:is="componentName" ></component>
    </v-content>

  </v-app>
  
    
</template>

<script>
export default {
  props: {
    source: String,
  },
  data: () => ({
    drawer: null,
    mini:true,
    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    componentName:'',
  }),
  created () {
    this.$vuetify.theme.dark = true;
    this.componentName="admin-chat"

  },
  
  // mounted(){
  //   this.loadData();
  // },

  
  methods:{

    Reservations(){
      this.componentName="calendar"
    },

    Users(){
      this.componentName="user-table"
    },
    logout(){
      axios.post('logout').then(response => {
          console.log(response.status);
          window.location='login';
        }).catch(error => {

      });
    },
    dashboard(){
      this.componentName="events-table"
    },
    loadData(){

    },
    chat(){
      console.log('admin-chat')
      this.componentName="admin-chat"
    }, 
  }
}
</script>

<style>

</style>