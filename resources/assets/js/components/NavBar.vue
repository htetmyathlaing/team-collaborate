<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">Team Collaborate</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">
                            <span class="fas fa-lg fa-home"></span>
                        </a>
                    </li>
                </ul>

                <div class="ml-auto notification-corner">
                    <ul class="navbar-nav">
                        <announcement></announcement>
                        <notifications></notifications>
                        
                        <li class="nav-item dropdown" v-show="!isDataStillFetching"> 
                            <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                {{ currentGroup.name }}                                
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu justify-content-center">
                                <a class="dropdown-item">{{ currentUser.email }}</a>
                                <div class="dropdown-divider"></div>
                                <h6 class="dropdown-header">အဖွဲ့များ</h6>
                                <a v-for="group in currentUser.involved_groups" 
                                    :id="group.id"
                                    class="dropdown-item"
                                    href="#"  
                                    @click="changeGroup">{{ group.name }}</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item"
                                            data-toggle="modal" 
                                            data-target="#createGroupModal">အဖွဲ့သစ် ဖန်တီးမည်</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout"
                                                                     onclick="event.preventDefault();
                                                                                   document.getElementById('logout-form').submit();">
                                          ထွက်ရန်
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        computed:{
            currentGroup(){
                return this.$store.state.currentGroup
            },
            currentUser(){
                return this.$store.state.currentUser
            },
            isDataStillFetching(){
                return this.$store.state.isDataStillFetching
            }
        },
        methods: {
            changeGroup: function(event){
                this.$store.commit('toggleIsDataStillFetching')
                this.$store.commit('assignMessages', '')
                console.log(this.$store.state.messages)
                axios.get('/init/'+ event.target.id).then(response => {
                    this.$store.commit('assignMessages', response.data.messages)
                    this.$store.commit('updateCurrentUser', response.data.user)
                    // this.$store.commit('updateUsers', response.data.group.users)
                    // this.$store.commit('updateChannels', response.data.group.channels)
                    this.$store.commit('updateCurrentGroup', response.data.group)
                    this.$store.commit('updateCurrentChannel', response.data.group.channels[0].id)
                    this.$store.commit('updateTitle', response.data.group.channels[0].name)

                    this.$store.commit('toggleIsDataStillFetching')
                })
            }
        },
    }
</script>
<style scoped>
  .notification-corner > a{
      color: rgb(255,255,255,0.5) !important
  }
  .notification-corner > a:hover{
      color: rgb(255,255,255) !important
  }
  a:hover{
    cursor: pointer;
  }
</style>
