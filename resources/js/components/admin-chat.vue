<template>
  <v-card 
    max-width="30%"
    shaped
    class="mt-12 mx-auto"
    
    >
    <v-card-title>Chat</v-card-title>
      
    <v-card-text>
      <v-sheet id="sheet" style="border:solid 1px; min-height:150px; max-height:400px">
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
</template>

<script>
export default {

  data:function(){
    return{
      text:"",
    }
  },

  mounted(){

  },

  methods:{
    send(){
      if(this.text!=''){
        axios.get('t/admin/'+this.text)
      .then(res=>{
        // console.log(res);
        this.text=''
      })
      .catch(err=>{
        console.log(err)
      })
      }      
      
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