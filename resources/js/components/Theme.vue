<template>
  <!-- <v-card dark> -->
    <!-- <v-toolbar
      color="primary"
      flat
    > -->
      <v-switch
        v-model="$vuetify.theme.dark"
        hide-details
        inset
        label="Theme Dark"
      ></v-switch>
    <!-- </v-toolbar>       -->
  <!-- </v-card> -->
</template>

<script>
  export default {
    props: {
      attrs: {
        type: Object,
        default: () => ({}),
      },
    },

    data: vm => ({
      initialDark: vm.$vuetify
        ? vm.$vuetify.theme.dark
        : false,
    }),

    beforeDestroy () {
      if (!this.$vuetify) return

      this.$vuetify.theme.dark = this.initialDark
    },
  }
</script>