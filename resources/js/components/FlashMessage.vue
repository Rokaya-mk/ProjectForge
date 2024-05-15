<template lang="">
  <div v-if="message"
       :class="['alert', messageType]">
    {{ message }}
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: '',
      messageType: ''
    };
  },
  methods: {
    showMessage(text, type = 'alert-info') {
      this.message = text;
      this.messageType = type;
      setTimeout(() => {
        this.clearMessage();
      }, 9000);
    },
    clearMessage() {
      this.message = '';
      this.messageType = '';
    }
  }
  
}
</script>
<style lang="">
    
</style>