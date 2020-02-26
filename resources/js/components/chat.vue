<template>
<v-container>

  <template>
    <v-btn
        color="primary"
        bottom
        right
        absolute
        @click="dialog = !dialog"
    >
      <v-icon>mdi-chat</v-icon>
    </v-btn>
  </template>

  <v-dialog v-model="dialog"  persistent max-width="600px">
     <v-card
    max-width="500"
    class="mx-auto"
  >
    <v-toolbar
      color="deep-purple accent-4"
      dark
    >
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>New Chat</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>
    </v-toolbar>

    <v-list subheader>
      <v-subheader>Recent chat</v-subheader>

      <v-list-item
        v-for="item in items"
        :key="item.title"
        
      >
        <v-list-item-avatar>
          <v-img :src="item.avatar"></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title v-text="item.title"></v-list-item-title>
        </v-list-item-content>

        <v-list-item-icon>
          <v-icon :color="item.active ? 'deep-purple accent-4' : 'grey'">mdi-chat_bubble</v-icon>
        </v-list-item-icon>
      </v-list-item>
    </v-list>

    <v-divider></v-divider>

    <v-list subheader>
      <v-subheader>Previous chats</v-subheader>
      
      <v-list-item
        v-for="item in items2"
        :key="item.title"
      >
        <v-list-item-avatar>
          <v-img :src="item.avatar"></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title v-text="item.title"></v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
  </v-dialog>

</v-container>
    
</template>

<script>
  export default {
    data:function(){
      return{
        valid:true,
        dialog: false,
        menu2:false,
        formData:{
        name:"",
        text:"",
        choice:null,
        date:"",
        },

        items: [
        { active: true, title: 'Jason Oner', avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg' },
        { active: true, title: 'Ranee Carlson', avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg' },
        { title: 'Cindy Baker', avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg' },
        { title: 'Ali Connors', avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg' },
        ],
        items2: [
          { title: 'Travis Howard', avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg' },
        ],
      }
    },
    
    computed: {
        computedItems() {
          return this.items.map(item => {
            return {
              text : item.text,
              value: item.value, 
              disabled:this.disabledItems.includes(item.value)
            }
          })
        },

        
    },
    mounted(){
      this.loadData();
    },
    methods:{
      allowedDates: val => {
        // console.log(val)
        return parseInt(val.split('-')[2], 10) % 2 === 0
        },
      
      create(){
          axios.post('api/events',this.formData)
          .then(function (response) {
            window.location.reload()})
          .catch(err => (console.log(err.response)));
          this.dialog=false;
      },

      datepick(){
        // this.allowedDates()
        // console.log(this.formData.date)
        this.disabledItems=[];
        this.events.forEach(event => {
          if(event.date==this.formData.date){
            this.disabledItems.push(Number(event.slot));
          }
        });

        console.log(this.disabledItems);
      },
      loadData(){
        
        axios.get('api/events')
        .then(res=>{          
          if(res.status==200){
            this.events=res.data.data;                      
          }})
        .catch(err=>{
            console.log(err);
        });
      },
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
          this.create();
        }
      },
    }
  }
</script>