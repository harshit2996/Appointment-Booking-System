<template>
  <v-row justify="center">
    <v-dialog v-model="dialog"  persistent max-width="600px">
      <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on">Book a Slot</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">Create Event</span>
        </v-card-title>
        <v-card-text>
          <v-container>
          <v-date-picker v-model="formData.date" @change="datepick"></v-date-picker>

            <v-row>
              <v-text-field label="Subject *" required v-model="formData.name"></v-text-field>
            </v-row>
            <v-row>
              <v-container fluid>
                <v-textarea
                  name="input-7-1"
                  filled
                  label="Description"
                  auto-grow
                  v-model="formData.text"
                ></v-textarea>
              </v-container>
            </v-row>
             
            <v-row>
                <v-select
                  :items="computedItems"
                  label="Choose a Slot"
                  required
                  v-model="formData.choice"
                  
                ></v-select>
            </v-row>
              
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" text @click.prevent="create">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  export default {
    data:function(){
      return{
        dialog: false,
      
        formData:{
        name:"",
        text:"",
        choice:null,
        date:"",
        },

        items: [
          {text:'10 - 11 am',value:1},
          {text:'11 - 12 am',value:2},
          {text:'12 - 1 pm',value:3},
          {text:'1 - 2 pm',value:4},
          {text:'2 - 3 pm',value:5},
          {text:'3 - 4 pm',value:6},
          {text:'4 - 5 pm',value:7},
          {text:'5 - 6 pm',value:8},
        ],
        disabledItems: [],
        events:[],
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
        }
        
    },
    mounted(){
      this.loadData();
    },
    methods:{
      create(){
        axios.post('api/events',this.formData)
        .then(function (response) {
          window.location.reload()})
        .catch(err => (console.log(err.response)));
          
        this.dialog=false;

      },
      datepick(){
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
    }
      
    
  }
</script>