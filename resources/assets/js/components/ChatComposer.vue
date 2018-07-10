 <template>
    <div class="bottom">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="" v-model="message" @keydown.enter="sendMessage" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="send-msg" @click="sendMessage">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import { EventBus } from './../event-bus.js'
    
    export default {
        data(){
            return {
                message: ''
            }
        },
        computed:{
            currentChannel(){
                return EventBus.currentChannel
            }
        },
        methods: {
            sendMessage(){
                if(this.message)
                    EventBus.$emit('messagesent', {
                        message: this.message,
                        currentChannel: this.currentChannel
                    })
                else console.log(this.currentChannel)
                this.message = ''
            }
        }
    }
</script>
<style scoped>
	.bottom{
            /*bottom: 0;*/
            width: 100%;
            padding-right: 1em;
        }
</style>
