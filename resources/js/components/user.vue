<template>
  <v-app id="inspire">
    <v-navigation-drawer
      app
      fixed
      expand-on-hover
      clipped
      :mini-variant.sync="mini"
      permanent
      
      > 
      <v-list dense>
        <v-list-item class="px-2">
          <v-list-item-avatar @click.stop="mini = !mini">
            <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
          </v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title  v-html="currentUser"></v-list-item-title>
        </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>      


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
      <v-toolbar dense>
        <v-toolbar-title>Dashboard</v-toolbar-title>
        
          <v-spacer></v-spacer>
          <theme></theme>
          <v-btn icon>
            <v-icon @click="logout">mdi-logout-variant</v-icon>
          </v-btn>
      </v-toolbar>
      
      <component v-bind:is="componentName" ></component>
      
      <event-form></event-form>
    </v-content>

  </v-app>
  
    
</template>

<script>
export default {
  props: [
    'currentUser',
    'source: String',
  ],
  data: () => ({
    drawer: null,
    mini:true,
    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    componentName:'',
  }),
  created () {
    this.$vuetify.theme.dark = true;
    this.componentName="u-events"
    // console.log(this.currentUser)
  },
  
  

  
  methods:{

    Reservations(){
      this.componentName="calendar"
    },

    
    logout(){
      axios.post('logout').then(response => {
          console.log(response.status);
          window.location='login';
        }).catch(error => {

      });
    },
    dashboard(){
      this.componentName="u-events"
    },
  }

  

  }
</script>

<style>

</style>