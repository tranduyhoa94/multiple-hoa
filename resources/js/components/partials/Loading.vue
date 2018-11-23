<template>
    <div id="loading" v-show="isLoading">
        <clip-loader :color="color" :size="size"></clip-loader>
        <div>Loading...</div>
    </div>
</template>

<script>
import ClipLoader from 'vue-spinner/src/ClipLoader.vue'

export default {
    name: 'Loading',

    props: {
        isLoading: {
          type: Boolean,
          default: false
        }
    },

    data () {
        return {
            color: '#3AB982',
            size: '60px'
        }
    },

    components: {
        ClipLoader
    }
}
</script>

<style lang="css" scoped>
#loading{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: rgba(241, 242, 242, 0.89);
    z-index: 111111111;
}
</style>