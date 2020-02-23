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
      ></v-data-table>
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


          ],
          // timeSlot:'',
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
        axios.get('api/events')
        .then(res=>{
            
            if(res.status==200){
            this.events=res.data.data;
            // console.log(this.users);
            }
        }).catch(err=>{
            console.log(err);
        });
      },
    }
  }

</script>