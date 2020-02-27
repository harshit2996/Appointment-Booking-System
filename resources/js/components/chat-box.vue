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
        <v-icon>mdi-chat</v-icon>
      </v-btn>
    </v-col>
      
    <v-col>
      <v-expand-transition>
        <v-col class="shrink">
          <v-card  v-show="expand"
            max-width="30%"
            shaped
            
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
        </v-col>
        
      </v-expand-transition>
    </v-col>
      
  </div>
    <!-- <div class="mx-4 hidden-sm-and-down"></div> -->

</template>

<script>
export default {

  data:function(){
    return{
      text:"",
      expand:true,
    }
  },

  mounted(){

  },

  methods:{
    send(){
      console.log(this.text)
      
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
    overflow: auto;
    padding: 5px;
 }
</style>