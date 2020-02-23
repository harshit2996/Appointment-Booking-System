<template>
    <v-card
    class="mt-12 mx-auto"
    max-width="80%"
    
  >
    <v-sheet
      class="v-sheet--offset mx-auto"
      color="green"
      elevation="5"
      height="auto"
      max-width="calc(100% - 32px)" 
    >
      <p class="text-center display-1">Your Appointments</p>
      
    </v-sheet>

    <v-card-text class="pt-0">
      <v-data-table
        :headers="headers"
        :items="events"
      >
      <template v-slot:item.action="{ item }">
        <v-icon small class="mr-2" @click="showEvent(item)">mdi-eye</v-icon>
        <v-icon small class="mr-2" @click="editEvent(item)">mdi-pencil</v-icon>
        <v-icon small class="mr-2" @click="deleteEvent(item)">mdi-delete</v-icon>
      </template>
    </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
  export default {
      data:function(){
        return {
          headers:[{
              text: 'Name',
              align: 'left',
              sortable: false,
              value: 'event_name',
            },
            { text: 'Date', value: 'date' },
            { text: 'Description', value: 'event_description'},
            { text: 'Slot', value: 'slot'},
            { text: 'Actions', value: 'action'},
          ],
          events:[],
          slots: [
            {text:'10 am - 11 am',value:1},
            {text:'11 am - 12 am',value:2},
            {text:'12 nn - 01 pm',value:3},
            {text:'01 pm - 02 pm',value:4},
            {text:'02 pm - 03 pm',value:5},
            {text:'03 pm - 04 pm',value:6},
            {text:'04 pm - 05 pm',value:7},
            {text:'05 pm - 06 pm',value:8},
          ],

        }
      },

    mounted(){
        this.loadData();
    },
    methods:{
        loadData:function(){
        this.events=[]
        axios.get('api/events')
        .then(res=>{
            
          if(res.status==200){
            let Events=res.data.data;

            Events.forEach(event => {
              this.slots.forEach(slot => {
                if(Number(event.slot)==(slot.value)){
                  event.slot = slot.text
                  this.events.push(event)
                }
              });            
            });
          }

        }).catch(err=>{
            console.log(err);
        });
      },

      showEvent(item){
          console.log(item);
                          
      },
      
      editEvent(item){
          console.log(item); 
            
      },

      deleteEvent(item){
          
      console.log(item);
      axios.delete('api/events/'+String(item.id))
        .then(res=>{
            window.location.reload();
        })
        .catch(err=>{
            console.log(err);    
        });  
      },
    }
  }

</script>