 <template>
    <div class="col-10">
        <div class="container">
            <div class="row right-top border-bottom">
                <content-placeholders :rounded="true" class="col-10" v-show="isDataStillFetching">
                        <content-placeholders-text :lines="2"></content-placeholders-text>
                </content-placeholders>

               <div class="col-10" v-show="!isDataStillFetching">
                    <a href="#">{{ title }}</a>
                    <p>{{ channelDescription }}</p>
               </div>
               <div class="ml-auto py-2 mr-3">
                    <div class="align-middle" style="height: 100%">
                         <a class="text-muted" 
                            data-toggle="modal" 
                            data-target="#voiceCallModal"
                            @click="voiceCall">
                            <span class="fas fa-lg fa-phone m-2"></span>
                        </a>
                         <a class="text-muted" 
                            data-toggle="modal" 
                            data-target="#videoCallModal">
                            <span class="fas fa-lg fa-video m-2"></span>
                        </a>
                        <a class="text-info" @click="toggleDetails">
                            <span class="fas fa-lg fa-info-circle m-2"></span>
                        </a>
                        
                        <a class="dropdown ml-3">
                            <a role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fas fa-xs fa-ellipsis-v"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mt-3 mm-text">
                                <h6 class="dropdown-header">ချန်နယ်ကိုဖျက်မည်</h6>
                                <div class="dropdown-item border-top text-danger"
                                    data-toggle="modal" 
                                    data-target="#deleteChannelModal">
                                    <p>ဖျက်မည် </p>
                                </div>
                            </div>
                        </a>
                    </div>
               </div>
            </div>
               
            <div class="row">
                <div class="col">
                    <content-placeholders 
                            :rounded="true" 
                            class="mt-3" 
                            style="height:78vh" 
                            v-show="isDataStillFetching">
                        <content-placeholders-heading :img="true" />
                        <content-placeholders-text :lines="3" />
                        <content-placeholders-heading :img="true" />
                        <content-placeholders-text :lines="3" />
                        <content-placeholders-heading :img="true" />
                        <content-placeholders-text :lines="3" />
                    </content-placeholders>

                    <chat-log v-show="!isDataStillFetching"></chat-log>
                    <chat-composer></chat-composer>
                </div>
                <chatroom-details v-show="isChatroomDetailsShowed"></chatroom-details>
            </div>                          
        </div>                                                                                          
    </div>
</template>

<script>
    
    export default {
        data(){
            return {
                isChatroomDetailsShowed: false
            }
        },
        methods:{
            toggleDetails(){
                this.isAnnouncementShowed = false
                this.isChatroomDetailsShowed = !this.isChatroomDetailsShowed
            },
            voiceCall(){
                console.log('calling')
            }
	    },
        computed:{
            isDataStillFetching(){
                return this.$store.state.isDataStillFetching
            },
            title(){
                return this.$store.state.title
            },
            channelDescription(){
                return this.$store.state.channelDescription
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
    .fas:hover{
        cursor: pointer;
    }
</style>