<template>
      <v-switch
        v-model="$vuetify.theme.dark"
        hide-details
        inset
        class="mx-auto"
      ></v-switch>
    
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