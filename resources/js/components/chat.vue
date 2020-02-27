<template>
  <v-expansion-panels>
     <v-expansion-panel>
      <v-expansion-panel-header>
        <v-btn
          color="green"
          fab
          right
          absolute
          @click="expand = !expand"
          class="v-btn">
          <v-icon>mdi-chat</v-icon>
        </v-btn>
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <v-expand-transition>
        <v-col class="shrink">
          <v-card  v-show="expand"
            max-width="30%"
            color="green"
            >
            <v-card-title>Chat</v-card-title>
              
            <v-card-text>
              <v-sheet>
                <div id="notification" style="min-height:150px;max-height:400px; border"></div>
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
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
   
    
</template>
<script>
  export default {
    data: () => ({
      expand: false,
      expand2: false,
    }),
  }
</script>