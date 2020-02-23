<template>
<v-card
    color="green"
    title="Events Table"
    text="Here is a subtitle for this table"
  >
  <v-data-table
    :headers="headers"
    :items="users"
  >
    <template v-slot:item.action="{ item }">
      <v-icon small @click="showEvents(item)">mdi-eye</v-icon>
    </template>
    
      
  </v-data-table>
</v-card>
</template>


<script>
export default {
  data(){
    return{
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

      users:[],
    }
  },
  mounted(){
     this.loadData();
  },
  methods:{
    loadData:function(){
      axios.get('api/admin')
      .then(res=>{
        
        if(res.status==200){
          this.users=res.data.data;
          // console.log(this.users);
        }
      }).catch(err=>{
          console.log(err);
      });
    },
    showEvents(item) {
      // console.log(item.id);
      
      
      window.location.href=('admin/events/'+String(item.id));
    },
  }
}
</script>

<style>

</style>