<template>
  
  <v-container>
    <v-row >
      <v-col
        cols="12"
        sm="6"
        md="8"
        >
        <v-layout justify-center>
          <v-card
            class="mt-12 mx-auto"
            >
            <v-sheet
              class="v-sheet--offset mx-auto"
              color="green"
              elevation="5"
              height="auto"
              max-width="calc(100% - 32px)">
              <p class="text-center display-1">Online Users</p>
              
            </v-sheet>

            <v-card-text class="pt-0">
              <v-data-table
                :headers="headers"

                :items="cu"
              >
                <template v-slot:item.action="{ item }">
                  <v-icon small @click="chatWith(item)">mdi-chat</v-icon>
                </template>
              
                
              </v-data-table>
            </v-card-text>
          </v-card>
        </v-layout>
      </v-col>
    
    
      <v-col
        cols="6"
        md="4"        
        >
        <v-layout justify-center>
          <v-card
            
            v-if="chat"
        
            class="mt-12"
            >
            <v-card-title>Chat</v-card-title>
            <v-card-subtitle v-html="item.name"></v-card-subtitle>
              
            <v-card-text>
              <v-sheet id="sheet" style="border:solid 1px; min-height:150px; max-height:400px" v-chat-scroll>
                <div :class="'notification-'+(item.id)"
                  align="left"
                  style="height:100%; width:100%; overflow: auto; padding: 20px; margin:0;display:none">
                </div>
              </v-sheet>
            </v-card-text>

            <v-card-actions>
                
              <v-text-field dense style="margin:0;"
                outlined
                v-model="text" 
                append-icon="mdi-send"
                @keydown.enter="send" @click:append="send"
                label="Type your message">
              </v-text-field>

            </v-card-actions>

          </v-card>
        </v-layout>
      </v-col>
    
    </v-row>
  </v-container>
 
</template>

<script>
export default {

  props:['onlineUsers'],

  data:function(){
    return{

      chat:false,
      item:Object,
      flag:false,
      prev:Object,
      activeUsers:[],
      cu:[],
      headers: [
          {
            text: 'User',
            align: 'left',
            sortable: false,
            value: 'id',
          },
          { text: 'Name', value: 'name' },
          { text: 'Email Id', value: 'email' },
          { text: 'Actions', value: 'action', sortable: false },
      ],
      text:"",
    }
  },

  mounted(){
    this.loadData()
  }, 

  methods:{

    chatWith(item){
      
      
      try {
        if(this.prev==item){
          return 
        }
        else{
          document.getElementsByClassName('notification-'+this.prev.id)[0].innerHTML=""

        }
          

      } 
      catch (error) {
        
      }

      this.chat=false,
      this.item = item
      this.chat=true
      this.prev=item
      let component = 'notification-'+this.item.id

      Echo.private('admin.'+(this.item.id))
        .listen('.AdminEvent', (data) => {
          document.getElementsByClassName(component)[0].innerHTML+=('<div class="'+component+'"align="right"><div class="'+component+'" style="display:inline-block; background-color:orange;padding:5px;margin:2px;border-radius:2px">'+data.title+'</div></div>');
          document.getElementsByClassName(component)[0].style.display='block';
      
      })
      Echo.private('user.'+this.item.id)
        .listen('.UserEvent', (data) => {
        document.getElementsByClassName('notification-'+this.item.id)[0].innerHTML+=('<div class="'+component+'"><div  class="'+component+'"style="display:inline-block; background-color:lightgreen;padding:5px;margin:2px;border-radius:2px">'+data.title+'</div></div>');
      }) 
        
    },

    loadData(){  
      Echo.join('online')
      .here(users => {
      users.forEach(user => {
        if(user.isAdmin!=1){
          this.activeUsers.push(user)
        }
      })
      this.cu=this.activeUsers

      })
      .joining((user)=>{
        this.activeUsers.push(user)
      })
      .leaving((user)=>{
        this.activeUsers.pop(user)
      })
      if(this.activeUsers.lenght>0){
        this.flag=true
      }    
    },

    send(){
      
      if(this.text!=''){
        axios.get('t/admin/'+this.item.id+'/'+this.text)
          .then(res=>{
            this.text=''
          })
          .catch(err=>{
            console.log(err)
          })

      }
    },

  }

}
</script>

<style>
  #sheet::-webkit-scrollbar {display:none;}

  #sheet{
    overflow:scroll;
  }
</style>