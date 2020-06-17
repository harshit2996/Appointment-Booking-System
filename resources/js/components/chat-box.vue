<template>
 
  <div align="right">
    <v-col>
      <v-btn
        color="primary"
        fab
        right
        absolute
        @click="expand = !expand"
        class="v-btn"
      >
        <v-icon v-if="expand">mdi-close</v-icon>
        <v-icon v-else>mdi-chat</v-icon>
      </v-btn>
    </v-col>
    
    <v-col>
    <v-dialog v-model="expand"  max-width="20%" max-height="auto">  
      <v-card  v-show="expand"
        style="z-index:20"

        >
        <v-card-title>Chat</v-card-title>
          
        <v-card-text>
          <v-sheet id="sheet" style="border:solid 1px; min-height:150px; max-height:400px" v-chat-scroll>
            <div id="notification" align="left"></div>
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
    </v-dialog>  
    </v-col>

    
    
    
  
      
  </div>

</template>

<script>
export default {

  data:function(){
    return{
      text:"",
      expand:false,
    }
  },

  mounted(){

  },

  methods:{
    send(){
      // console.log(this.text)
      
      axios.get('t/'+this.text)
      .then(res=>{
        // console.log(res);
        this.text=''
      })
      .catch(err=>{
        console.log(err)
      })
      // event(new SendMessage(this.text));
    
    }
  }

}
</script>

<style>
  #sheet::-webkit-scrollbar {display:none;}

  #sheet{
    overflow:scroll;
  }

 #notification{
    height: 100%;
    width:100%;
    overflow: auto;
    padding: 20px;
    margin:0;
 }
</style>