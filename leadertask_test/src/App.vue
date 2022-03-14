<template>
  <div id="app">
    <div class="container">
      <submit />
    </div>
  </div>
</template>

<script>
import Submit from './components/Submit.vue'

export default {
  name: 'App',
  components: {
    Submit
  }
}
</script>

<style lang="scss">
#submit {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
