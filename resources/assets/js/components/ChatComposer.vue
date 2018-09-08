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
    
    export default {
        data(){
            return {
                message: ''
            }
        },
        computed:{
            currentChannel(){
                return this.$store.state.currentChannel
            }
        },
        methods: {
            sendMessage(){
                if(this.message)
                    this.$store.commit('toggleIsMessageSending')
                    axios.post('/messages', {
                        message: this.message,
                        currentChannel: this.$store.state.currentChannel,
                        currentGroup: this.$store.state.currentGroup.id
                    }).then(response => {
                        // this.$store.commit('updateMessages', response.data)
                        this.$store.commit('toggleIsMessageSending')
                    }) 
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
