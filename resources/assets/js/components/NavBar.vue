<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="dropdown  nav-item mr-auto" v-show="!isDataStillFetching">
            <a class="text-white" role="button" data-toggle="dropdown">
                <span class="dropdown-toggle group-name">{{ currentGroup.name }}</span>
            </a>
            <div class="dropdown-menu justify-content-center">
                <a class="dropdown-item">{{ currentUser.email }}</a>
                <h6 class="dropdown-header">Groups</h6>
                <a href="#" class="dropdown-item" v-for="group in currentUser.involved_groups" :id="group.id" @click="changeGroup">{{ group.name }}</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item"
                            data-toggle="modal" 
                            data-target="#createGroupModal">Create Group</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout"
                                                     onclick="event.preventDefault();
                                                                   document.getElementById('logout-form').submit();">
                          Logout
                </a>
            </div>
        </a>
        <a class="navbar-brand mx-auto" href="/home">Team Collaborate</a>

        <div class="ml-auto mr-5 notification-corner">
            <announcement></announcement>
            <notifications></notifications>
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
                    this.$store.commit('updateCurrentUser', response.data.user[0])
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
