<template>

  <v-container>
    
    <v-dialog v-model="dvalue"  persistent max-width="600px">
      <v-form
        ref="form"
        v-model="valid"
        lazy-validation
        >
        <v-card>
          <v-card-title>
            <span class="headline">Edit Event</span>
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
                    label="Choose a New Slot"
                    required
                    v-model="formData.choice"
                  ></v-select>
              </v-row>
                
            </v-container>
            
            <small>*indicates required field</small>
          
          </v-card-text>
          
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="error" class="mr-4" @click="closed">Close</v-btn>
            <v-btn 
              :disabled="!valid"
              color="success"
              @click="validate(formData)"
              class="mr-4"
              >Save</v-btn>
          </v-card-actions>
        </v-card>
      
      </v-form>
    </v-dialog>

    <v-snackbar
      v-model="alert"
      >
      No Changes Done
      <v-btn
        color="pink"
        :right="true"
        @click="alert = false"
      >
        Close
      </v-btn>
    </v-snackbar>


  </v-container>
    
</template>

<script>
  export default {
    data:()=>({
        valid:true,
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
        
        bookings:[],

        alert: false,

    }),
    
    props:['dvalue','selEvent'],
    
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

      // allowedDates: val => {
      //   // console.log(val)
      //   return parseInt(val.split('-')[2], 10) % 2 === 0
      // },

      create(form_data){
          axios.put('api/events/'+String(this.selEvent.id),form_data)
          .then(res=>{
              window.location.reload();
          })
          .catch(err=>{
              console.log(err);    
          });   
      },

      datepick(){

        // this.allowedDates()
        console.log(this.bookings)
        this.disabledItems=[];
        this.bookings.forEach(event => {
          console.log(event)          
          if(event.date==this.formData.date){
            this.disabledItems.push(Number(event.slot));
          }
        });

      },

      loadData(){
        this.events=[]
        // this.disabledItems=[]
        axios.get('api/user/events')
          .then(res=>{
            this.bookings=res.data.data
            
            this.bookings.forEach(event => {
                // console.log(this.disabledItems)

              if(String(event.date)==String(this.formData.date)){
                console.log(event.date,this.formData.date)
                this.disabledItems.push(Number(event.slot))
                // console.log(this.disabledItems)
              }

            });
          })
          .catch(err=>{
            console.log(err)
          })
          // console.log(this.disabledItems)
        
          let se ={
          name: this.selEvent.event_name,
          text: this.selEvent.event_description,
          choice: this.selEvent.slot,
          date: this.selEvent.date
          }

          this.formData=se
        
      },

      validate (form_data) {
        let se ={
          name: this.selEvent.event_name,
          text: this.selEvent.event_description,
          choice: this.selEvent.slot,
          date: this.selEvent.date
        }
        if (this.$refs.form.validate(form_data)) {
          this.snackbar = true
          if(JSON.stringify(form_data)==JSON.stringify(se)){
            this.alert=true
          }
          
          else{
            this.create(form_data)
          };
        }
      },

      closed(){
        this.dvalue=!this.dvalue
        this.$emit('update:dvalue', this.dvalue)
      },
    }
  }
</script>