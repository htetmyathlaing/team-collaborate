<template>
    <div class="col-2 border-right left-col">
        <content-placeholders :rounded="true" v-show="isDataStillFetching">
            <content-placeholders-text :lines="3" class="mt-3" />
            <content-placeholders-text :lines="3" class="mt-4" />
            <content-placeholders-text :lines="3" class="mt-4" />
        </content-placeholders>

        <div v-show="!isDataStillFetching" class="mm-text">
            <div class="announcement mt-3">
                <router-link to="/announcement">
                    <span class="channel-header">
                        <a class="list-item"
                        id="resource-center"
                        @click="changeChannel">အသိပေးချက်များ</a>
                    </span>
                </router-link>
            </div>

            <div class="resource-center">
                <router-link to="/resource-center/notes">
                    <span class="channel-header">
                        <a class="list-item"
                        id="resource-center"
                        @click="changeChannel">Resource Center</a>
                    </span>
                </router-link>
            </div>

            <div class="channels mt-3">
                <div class="channel-header">
                    <a href="#">ခေါင်းစဉ်ခွဲများ</a>
                    <span class="fas fa-plus-circle float-right m-1"  
                            data-toggle="modal" 
                            data-target="#createChannelModal"
                            data-placement="top" 
                            title="ခေါင်းစဉ်ခွဲအသစ်တစ်ခု ဖန်တီးမည်"></span>
                </div>
                <hr>
                <div class="scroll-view">
                    <div v-for="(channel,index) in channels" 
                        :key="channel.id" 
                        class="channel-list">

                        <router-link to="/">
                            <a class="list-item"
                                :id="'channel'+channel.id" 
                                :data-index="index"
                                @click="changeChannel">{{ channel.name }}</a>
                        </router-link>
                    </div>
                </div>
            </div>
            <!-- <hr> -->
            <div class="direct-message mt-3">
                <div class="channel-header">
                    <a href="#" class="">တိုက်ရိုက်စာတိုများ</a>
                    <span class="fas fa-plus-circle float-right m-1"
                            data-toggle="modal" 
                            data-target="#addMemberModal"
                            data-placement="top" 
                            title="အဖွဲ့ဝင်အသစ် ပေါင်းထည့်ရန်"></span>
                </div>
                <hr>
                
                <div class="scroll-view">
                    <router-link to="/" v-for="user in users"
                        :key="user.id"
                        class="channel-list">
                        <a class="list-item" 
                            v-if="user.id!=currentUser.id"
                            :id="'user'+user.id"
                            @click="changeChannel">{{ user.name }}</a>
                    </router-link>
                </div>
            </div>
        </div>
    </div>	
</template>

<script>
    export default {
        props: [],
        data(){
            return {
                
            }
        },
        computed:{
            currentUser(){
                return this.$store.state.currentUser
            },
            users(){
                return this.$store.state.currentGroup.users
            },
            channels(){
                return this.$store.state.currentGroup.channels
            },
            isDataStillFetching(){
                return this.$store.state.isDataStillFetching
            }
        },
        updated(){
            $('#'+this.$store.state.currentChannel).addClass("active")
        },
        methods:{
            changeChannel: function(event){
                /**
                * IF currentChannel and new requested channel are the same,
                * do nothing.
                */
                // if(this.$store.state.currentChannel != event.target.id){
                    this.$store.commit('updateTitle', event.target.innerText)
                    this.$store.commit('updateCurrentChannel', event.target.id)
                    if(event.target.id){
                        if(event.target.id[0] === 'c')
                            this.$store.commit('updateChannelDescription', 
                                this.$store.state.currentGroup.channels[$(event.target).data('index')].description)
                        else
                            this.$store.commit('updateChannelDescription', "This is private chat.")

                        axios.get('/getmessages/'+event.target.id).then(response => {
                            this.$store.commit('assignMessages', response.data.messages)
                        })
                    }
                // }

                $('.list-item').attr("class","list-item")
                $(event.target).toggleClass("active")
            }
        }
    }

    $(function () {
      $('[data-toggle="modal"]').tooltip()
    })
</script>
<style scoped>
    hr {
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        border: 0;
        border-top: 1px solid #C8BEDF;
    }
    .scroll-view{
        overflow-y: scroll;
        height: 30vh;
    }
    .left-col{
        height: 94vh;
        /*background: #4A3A4A;*/
        background: #514078;
    }
	.group-name{
        font-size: 1.5em;
        font-family: sans-serif;
    }
    .active{
        background: #28a745;
        color: white !important;
    }
    .list-item{
        width: 114.5%;
        display: flex;
        line-height: 2em;
        padding: 0px 0px 0px 30px;
        transform: translateX(-15px);
    }
    .channel-list .list-item:hover{
        transform: scale(1.05, 1.05);
        transition: transform .1s;
        transform: translateX(-10px);
    }
    a{
        text-decoration: none;
        /*color: #4A3A4A !important;*/
        color: #C8BEDF !important;
    }
    a:hover{
        color: #fff !important;
    }
    .channel-header{
        font-size: 1.2em;
    }
    .fa-plus-circle{
        color: #C8BEDF;
    }
    .fa-plus-circle:hover{
        /*color: #28a745;*/
        color: #fff !important;
        cursor: pointer;
    }
</style>