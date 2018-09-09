<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-info sticky-top">
            <div class="container">
                <a class="navbar-brand" href="/">TeamCollaborate</a>
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
                            <notifications></notifications>
                            
                            <li class="nav-item dropdown" v-show="!isDataStillFetching"> 
                                <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                    {{ currentGroup.name }}                                
                                    <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right justify-content-center text-center">
                                    <a class="dropdown-item">{{ currentUser.email }}</a>
                                    <div class="dropdown-divider"></div>
                                    <h6 class="dropdown-header mm-text">အသေးစိတ်အချက်အလက်များ</h6>
                                    <!-- <a v-for="group in currentUser.involved_groups" 
                                        :id="group.id"
                                        class="dropdown-item"
                                        href="#"  
                                        @click="changeGroup">{{ group.name }}</a> -->
                                    <span :id="currentGroup.id"
                                        class="text-info">{{ currentGroup.description }}</span>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item mm-text"
                                                data-toggle="modal" 
                                                data-target="#deleteGroupModal">အဖွဲ့ကိုဖျက်ရန်</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item mm-text" href="/logout"
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
        <!-- Delete Group -->
        <div class="modal fade mt-5 mm-text" id="deleteGroupModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mx-auto">ဖျက်မှာသေချာပြီလား?</h5>
                    </div>
                    <div class="modal-body">
                        ဤအဖွဲ့ကို ဖျက်ပါလိမ့်မည်။
                            
                        <div v-show="deleting" class='deleting-text'></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="deleting">
                            မလုပ်တော့ပါ
                        </button>
                        <button type="button" class="btn btn-danger" @click="deleteGroup" :disabled="deleting">
                            ဖျက်မည်
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                deleting: false
            }
        },
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
            // changeGroup: function(event){
            //     this.$store.commit('toggleIsDataStillFetching')
            //     this.$store.commit('assignMessages', '')
            //     console.log(this.$store.state.messages)
            //     axios.get('/init/'+ event.target.id).then(response => {
            //         this.$store.commit('assignMessages', response.data.messages)
            //         this.$store.commit('updateCurrentUser', response.data.user)
            //         // this.$store.commit('updateUsers', response.data.group.users)
            //         // this.$store.commit('updateChannels', response.data.group.channels)
            //         this.$store.commit('updateCurrentGroup', response.data.group)
            //         this.$store.commit('updateCurrentChannel', response.data.group.channels[0].id)
            //         this.$store.commit('updateTitle', response.data.group.channels[0].name)

            //         this.$store.commit('toggleIsDataStillFetching')
            //     })
            // },
            deleteGroup: function(event){
                this.deleting = true
                axios.delete('/groups/'+this.currentGroup.id).then(response => {
                    console.log(response.data)
                    this.deleting = false
                    $('#deleteGroupModal').hide()
                    location.href='/home'
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
  }အဖွဲ့ကို
    .deleting-text:after {
        content: "အဖွဲ့ကို ဖျက်နေသည်";
        font-weight: bold;
        font-style: italic;
        color: red;
        animation-name: deleting-text;
        animation-duration: 1s;
        animation-iteration-count: infinite;
    }

     @keyframes deleting-text {
        0% {
          content: "အဖွဲ့ကို ဖျက်နေသည်";
        }
        10% {
          content: "အဖွဲ့ကို ဖျက်နေသည် .";
        }
        20% {
          content: "အဖွဲ့ကို ဖျက်နေသည် . .";
        }
        30% {
          content: "အဖွဲ့ကို ဖျက်နေသည် . . . ";
        }
        40% {
          content: "အဖွဲ့ကို ဖျက်နေသည် . . . .";
        }
        50% {
          content: "အဖွဲ့ကို ဖျက်နေသည် . . . . .";
        }
        60% {
          content: "အဖွဲ့ကို ဖျက်နေသည် . . . . . .";
        }
        70% {
          content: "အဖွဲ့ကို ဖျက်နေသည် . . . . . . .";
        }
        80% {
          content: "အဖွဲ့ကို ဖျက်နေသည် . . . . . . . .";
        }
        90% {
          content: "အဖွဲ့ကို ဖျက်နေသည် . . . . . . . . .";
        }
        100% {
          content: "အဖွဲ့ကို ဖျက်နေသည် . . . . . . . . . .";
        }
    }
</style>
