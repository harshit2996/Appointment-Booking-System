<template>
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
</template>

<script>
    export default {
        data(){
            return{
            headers:[{
                text: 'Event',
                align: 'left',
                sortable: false,
                value: 'id',
            },
            { text: 'Name', value: 'event_name' },
            { text: 'Date', value: 'date' },
            { text: 'Slot', value: 'slot', sortable: false },
            { text: 'Actions', value: 'action', sortable: false },

            ],
            events:[],
            }
        },

        mounted(){
            this.loadData();
        },

        methods:{
            
            loadData:function(){
                axios.post('')
                .then(res=>{
                    if(res.status==200){
                    this.events=res.data;
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
                axios.delete('../../api/events/'+String(item.id))
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