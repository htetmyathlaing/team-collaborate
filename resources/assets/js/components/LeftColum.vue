<template>
    <div class="col-2 border-right left-col">
        <content-placeholders :rounded="true" v-show="isDataStillFetching">
            <content-placeholders-text :lines="3" class="mt-3" />
            <content-placeholders-text :lines="3" class="mt-4" />
            <content-placeholders-text :lines="3" class="mt-4" />
        </content-placeholders>

        <div v-show="!isDataStillFetching">
            <div class="channels mt-3">
                <div class="channel-header">
                    <a href="#">Channels</a>
                    <span class="fas fa-plus-circle float-right m-1"  
                            data-toggle="modal" 
                            data-target="#createChannelModal"
                            data-placement="top" 
                            title="Create Group"></span>
                </div>
                <div v-for="(channel,index) in channels" 
                        :key="channel.id" 
                        class="channel-list">

                    <router-link to="/" v-if="index==0">
                        <a class="list-item active" 
                            :id="channel.id" 
                            :data-id="'channel'+channel.id" 
                            :data-index="index"
                            @click="changeChannel">{{ channel.name }}</a>
                    </router-link>

                    <router-link to="/" v-else>
                        <a class="list-item"
                            :id="channel.id" 
                            :data-id="'channel'+channel.id" 
                            :data-index="index"
                            @click="changeChannel">{{ channel.name }}</a>
                    </router-link>
                </div>
            </div>
            <hr>
            <div class="direct-message mt-3">

                <div class="channel-header">
                    <a href="#" class="">Direct Messages</a>
                </div>

                <router-link to="/" v-for="user in users"
                    :key="user.id">
                    <a class="list-item" 
                        v-if="user.id!=currentUser.id"
                        :id="user.id" 
                        :data-id="'user'+user.id" 
                        @click="changeChannel">{{ user.name }}</a>
                </router-link>
            </div>

            <hr>
            <div class="add-member mt-3">
                <a class="list-item">Add Member
                    <span class="fas fa-plus-circle ml-3 mt-2"
                            data-toggle="modal" 
                            data-target="#addMemberModal"
                            data-placement="top" 
                            title="Add Member"></span>
                </a>
            </div>
            <hr>
            <div class="announcement mt-3">
                <router-link to="/resource-center">
                    <a class="list-item"
                        @click="changeChannel">Resource Center</a>
                </router-link>
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
        methods:{
            changeChannel: function(event){
                /**
                * IF currentChannel and new requested channel are the same,
                * do nothing.
                */
                // if(this.$store.state.currentChannel != event.target.id){
                    this.$store.commit('updateTitle', event.target.innerText)
                    this.$store.commit('updateCurrentChannel', event.target.id)
                    if($(event.target).data('id')){
                        if($(event.target).data('id')[0] === 'c')
                            this.$store.commit('updateChannelDescription', 
                                this.$store.state.currentGroup.channels[$(event.target).data('index')].description)
                        else if($(event.target).data('id')[0] === 'u')
                            this.$store.commit('updateChannelDescription', "This is private chat.")

                        axios.get('/getmessages/'+$(event.target).data('id')).then(response => {
                            this.$store.commit('assignMessages', response.data.messages)
                        })
                    }
                // }

                for(let channel of this.channels){
                    $('.list-item').attr("class","list-item")
                }
                $(event.target).toggleClass("active")
            }
        }
    }

    $(function () {
      $('[data-toggle="modal"]').tooltip()
    })
</script>
<style scoped>
    .left-col{
        height: 100vh;
        /*background: #4A3A4A;*/
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
        width: 115%;
        display: flex;
        line-height: 2em;
        padding: 0px 0px 0px 30px;
        transform: translate(-15px, 0px);
    }
    a{
        text-decoration: none;
        color: #4A3A4A !important;
    }
    a:hover{
        color: #000 !important;
    }
    .channel-header a{
        font-size: 1.2em;
    }
    .fa-plus-circle, .add-member > a{
        color: #4A3A4A;
    }
    .fa-plus-circle:hover{
        color: #28a745;
        cursor: pointer;
    }
</style>