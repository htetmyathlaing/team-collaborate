<template>
    <div class="col-2 bg-info left-col">
    	<div class="dropdown ml-1">
        	<a class="text-white" role="button" data-toggle="dropdown">
                <span class="dropdown-toggle group-name">CS Group</span>
                <span id="userEmail">{{ currentUser.email }}</span>
        	</a>
        	<div class="dropdown-menu justify-content-center">
                <h6 class="dropdown-header">Groups</h6>
                <a href="#" class="dropdown-item" v-for="group in currentUser.involved_groups">{{ group.name }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </div>
    	</div>
    	<hr/>
        <div class="channels mt-3">
            <h5><a href="#" class="text-white">Channels</a></h5>
            <div v-for="(channel,index) in channels" :key="channel.id" class="channel-list">
                <a href="#" v-if="index==0" class="text-white list-item active" :id="channel.id" :data-id="'channel'+channel.id" @click="linkClicked">{{ channel.name }}<br></a>
                <a href="#" v-else class="text-white list-item channel" :id="channel.id" @click="linkClicked">{{ channel.name }}<br></a>
            </div>
        </div>
        <hr>
        <div class="direct-message mt-3">
            <h5><a href="#" class="text-white">Direct Messages</a></h5>
            <a v-for="user in users" v-if="user.id!=currentUser.id" href="#" class="text-white list-item" :id="user.id" :data-id="'user'+user.id" @click="linkClicked">{{ user.name }}</a>
        </div>

        <div class="announcement mt-3">
            <h5><a href="#" class="text-white">Announcement</a></h5>
            
        </div>

        <div class="resource-center mt-3">
            <h5><a href="#" class="text-white">Resource Center</a></h5>
        </div>
    </div>	
</template>

<script>
    import { EventBus } from './../event-bus.js';

    export default {
        props: [],
        data(){
            return {
                
            }
        },
        computed:{
            currentUser(){
                return EventBus.currentUser
            },
            users(){
                return EventBus.users
            },
            channels(){
                return EventBus.channels
            }
        },
        methods: {
            linkClicked: function(event){
                EventBus.$emit('channel-change' , {
                    title: event.target.innerText,
                    id: event.target.id,
                    data_id: $(event.target).data('id')
                })
                for(let channel of this.channels){
                    $('.list-item').attr("class","text-white list-item")
                }
                $(event.target).toggleClass("active")
            }
        },
        updated(){
        }
    }
</script>
<style scoped>
    .left-col{
        height: 100vh;
        color: rgb(202,196,201);
        background: #4A3A4A;
    }
	.group-name{
        font-size: 1.5em;
        font-family: sans-serif;
    }
    .active{
        background: rgb(0,100,0,0.5);
    }
    .list-item{
        width: 120%;
        display: flex;
        line-height: 2em;
        padding: 0px 0px 0px 30px;
        transform: translate(-15px, 0px);
    }
    a{
        text-decoration: none;
    }
    .channel-list > a:hover, .direct-message > a:hover{
        color: #4A3A4A !important;
    }
</style>