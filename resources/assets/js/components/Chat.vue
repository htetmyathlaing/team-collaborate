 <template>
    <div class="col-10 bg-white">
        <div class="container">
            <div class="row right-top border-bottom">
                <content-placeholders :rounded="true" class="col-6" v-show="isDataStillFetching">
                        <content-placeholders-text :lines="2" />
                </content-placeholders>

               <div class="col-6" v-show="!isDataStillFetching">
                    <a href="#">{{ title }}</a>
                    <p>{{ channelDescription }}</p>
               </div>
               <div class="col">
                    <div class="d-flex align-items-center justify-content-end" style="height: 100%">
                        <a class="text-info" @click="toggleDetails">
                            <span class="fas fa-info-circle m-2"></span>
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
</style>