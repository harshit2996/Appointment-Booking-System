<template>

  <v-card 
    max-width="30%"
    shaped
    class="mt-12 mx-auto"
    >
    <v-card-title>Chat</v-card-title>
    <v-card-subtitle v-html="item.name"></v-card-subtitle>
      
    <v-card-text>
      <v-sheet id="sheet" style="border:solid 1px; min-height:150px; max-height:400px">
        <div :id="'notification-'+(item.id)"
          align="left"
          style="height:100%; width:100%; overflow: auto; padding: 20px; margin:0; display:none">
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

</template>


<script>

  export default {

    props:['item'],

    data:function(){
      return{
        text:"",
      }
    },

    mounted(){
        
      Echo.private('admin.'+(this.item.id))
        .listen('.AdminEvent', (data) => {
        $("#notification-"+this.item.id).append('<div align="right"><div style="display:inline-block; background-color:orange;padding:5px;margin:2px;border-radius:2px">'+data.title+'</div></div>');

        })
      Echo.private('user.'+this.item.id)
        .listen('.UserEvent', (data) => {
        $("#notification-"+this.item.id).append('<div><div style="display:inline-block; background-color:lightgreen;padding:5px;margin:2px;border-radius:2px">'+data.title+'</div></div>');

      })

    }, 

    methods:{
      send(){
        document.getElementById('notification-'+this.item.id).style.display='block' 

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