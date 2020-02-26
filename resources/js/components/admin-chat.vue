<template>
  <v-card class="mt-12 mx-auto"
      max-width="30%" color="grey">
      <v-card-title>Chat</v-card-title>
      <v-container>
            <v-col>
              <v-row>
                <v-sheet id="sheet" min-height="150px" max-height="400px" width="80%"  >
                  <div id="notification"></div>
                </v-sheet>
              </v-row>

              <v-row>
                    <v-text-field v-model="text" append-outer-icon="mdi-send" @keydown.enter="send" @click:append-outer="send">

                    </v-text-field>
    
              </v-row>

            </v-col>
      </v-container>
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
      console.log(this.text)
      
      axios.get('t/admin/'+this.text)
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
 }
</style>