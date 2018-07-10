<template>
    <div class="scroll-view" auto-scroll>
        <transition-group name="list">
            <chat-message v-for="message in messages" :key="message.id" :message="message"  class="list-complete-item"></chat-message>
        </transition-group>
        <div v-show="is_message_sending" class='container'>
            <div class='loader'>
                <div class='loader-text'></div>
            </div>
        </div>
    </div>
</template>

<script>
    import { EventBus } from './../event-bus.js'

    export default {
        computed:{
            messages(){
              return EventBus.messages
            },
            is_message_sending(){
              return EventBus.is_message_sending
            }
        },
        updated(){
          this.$el.scrollTop = this.$el.scrollHeight;
        }
    }

</script>
<style scoped>
	.scroll-view{
        overflow-y: scroll;
        height: 85vh;
        font-family: 'Raleway';
    }
    .container {
        font-family: Helvetica;
        padding: 1px;
        margin-bottom: 5px;
    }

  .loader-text:after {
    content: "Loading";
    font-weight: bold;
    animation-name: loading-text;
    animation-duration: 1s;
    animation-iteration-count: infinite;
  }

  @keyframes loading-text {
    0% {
      content: "Sending";
    }
    20% {
      content: "Sending .";
    }
    40% {
      content: "Sending . .";
    }
    60% {
      content: "Sending . . . ";
    }
    80% {
      content: "Sending . . . .";
    }
    100% {
      content: "Sending . . . . .";
    }
  }
  .list-complete-item {
    transition: all 1s;
  }
  .list-enter-active, .list-leave-active {
    transition: all 1s;
  }
  .list-enter, .list-leave-to{
    opacity: 0;
    transform: translateX(50px);
  }
</style>