<template>
<v-container>

  <template>
    <v-btn
        color="primary"
        bottom
        right
        absolute
        @click="dialog = !dialog"
    >
      <v-icon>mdi-plus</v-icon>
    </v-btn>
  </template>

  <v-dialog v-model="dialog"  persistent max-width="600px">
      <v-form
        ref="form"
        v-model="valid"
        lazy-validation
        >
        <v-card>
        <v-card-title>
          <span class="headline">Create Event</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-menu
                v-model="menu2"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                min-width="290px"
                required
              >
                <template v-slot:activator="{ on }">
                  <v-text-field
                    v-model="formData.date"
                    label="Picker without buttons"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-on="on"
                    :rules="[v => !!v || 'Item is required']"
                    required
                  ></v-text-field>
                </template>
                    
                <v-date-picker v-model="formData.date" @change="datepick" @input="menu2 = false" reuired></v-date-picker>
              </v-menu>
          <!-- <v-date-picker 
           v-model="formData.date"
           :allowed-dates="allowedDates"
           @change="datepick">
          </v-date-picker> -->

            <v-row>
              <v-text-field 
              label="Subject *"
              required
              v-model="formData.name"
              :rules="[v => !!v || 'Item is required']"
              ></v-text-field>
            </v-row>

            <v-row>
              <v-container>
                <v-textarea
                  filled
                  :rules="[v => !!v || 'Item is required']"
                  label="Description"
                  auto-grow
                  v-model="formData.text"
                  required
                ></v-textarea>
              </v-container>
            </v-row>
             
            <v-row>
                <v-select
                  :items="computedItems"
                  :rules="[v => !!v || 'Item is required']"
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
          <v-btn color="error" class="mr-4" @click="dialog = false">Close</v-btn>
          <v-btn 
            :disabled="!valid"
            color="success"
            @click="validate"
            class="mr-4"
            >Save</v-btn>
        </v-card-actions>
        </v-card>
    </v-form>
    </v-dialog>
</v-container>
    
</template>

<script>
  export default {
    data:function(){
      return{
        valid:true,
        dialog: false,
        menu2:false,
        formData:{
        name:"",
        text:"",
        choice:null,
        date:"",
        },

        items: [
          {text:'10 am - 11 am',value:1},
          {text:'11 am - 12 am',value:2},
          {text:'12 nn - 01 pm',value:3},
          {text:'01 pm - 02 pm',value:4},
          {text:'02 pm - 03 pm',value:5},
          {text:'03 pm - 04 pm',value:6},
          {text:'04 pm - 05 pm',value:7},
          {text:'05 pm - 06 pm',value:8},
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
        },

        
    },
    mounted(){
      this.loadData();
    },
    methods:{
      allowedDates: val => {
        // console.log(val)
        return parseInt(val.split('-')[2], 10) % 2 === 0
        },
      
      create(){
          axios.post('api/events',this.formData)
          .then(function (response) {
            window.location.reload()})
          .catch(err => (console.log(err.response)));
          this.dialog=false;
      },

      datepick(){
        // this.allowedDates()
        // console.log(this.formData.date)
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
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
          this.create();
        }
      },
    }
  }
</script>