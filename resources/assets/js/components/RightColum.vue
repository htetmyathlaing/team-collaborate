 <template>
    <div class="col-10 bg-white right-col">
        <div class="container">
            <div class="row right-top border-bottom">
               <div class="col-6">
                    <a href="#">{{ title }}</a>
                    <p>This is channel is for general purpose matter.</p>
               </div>
               <div class="col">
                    <div class="d-flex align-items-center justify-content-end" style="height: 100%">
                        <a class="text-info" @click="toggleDetails">
                            <span class="fas fa-info-circle m-2"></span>
                        </a>
                        <a class="text-info">
                            <span class="fas fa-bullhorn ml-3" @click="toggleAnnouncement"></span>
                        </a>
                        <notification class="ml-3"></notification>
                        
                    </div>
               </div>
            </div>
            <div class="row">
                <div class="col">
                    <chat-log></chat-log>
                    <chat-composer></chat-composer>
                </div>
                <chatroom-details v-show="isChatroomDetailsShowed"></chatroom-details>
                <announcement v-show="isAnnouncementShowed"></announcement>
            </div>                          
        </div>                                                                                          
    </div>
</template>

<script>
    import { EventBus } from './../event-bus.js'

    export default {
        data(){
            return {
                isChatroomDetailsShowed: false,
                isAnnouncementShowed: false
            }
        },
        computed:{
            title(){
                return EventBus.title
            }
        },
        methods:{
            toggleDetails(){
                this.isAnnouncementShowed = false
                this.isChatroomDetailsShowed = !this.isChatroomDetailsShowed
            },
            toggleAnnouncement(){
                this.isChatroomDetailsShowed = false
                this.isAnnouncementShowed = !this.isAnnouncementShowed
            }
	    }
    }
</script>
<style scoped>
    .right-top a{
        text-decoration: none;
    }
    .right-top{
        height: 4em !important;
    }
    .right-top  a{
        font-size: 1.2em;
    }
</style>