
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

import Vuex from 'vuex'
import VueRouter from 'vue-router'
import VueContentPlaceholders from 'vue-content-placeholders'

Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(VueContentPlaceholders)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('chat-message', require('./components/ChatMessage.vue'))
Vue.component('chat-log', require('./components/ChatLog.vue'))
Vue.component('chat-composer', require('./components/ChatComposer.vue'))
Vue.component('left-colum', require('./components/LeftColum.vue'))
// Vue.component('right-colum', require('./components/RightColum.vue'))
Vue.component('chatroom-details', require('./components/ChatRoomDetails.vue'))
Vue.component('announcement', require('./components/Announcement.vue'))
Vue.component('nav-bar', require('./components/Navbar.vue'))
Vue.component('notifications', require('./components/Notifications.vue'))
Vue.component('create-channel-modal', require('./components/CreateChannelModal.vue'))
Vue.component('create-group-modal', require('./components/CreateGroupModal.vue'))
Vue.component('add-member-modal', require('./components/AddMemberModal.vue'))
// Vue.component('notes', require('./components/Notes.vue'))

import Chat from './components/Chat.vue'
import ResourceCenter from './components/ResourceCenter.vue'
import Notes from './components/Notes.vue'
import Videos from './components/Videos.vue'
import Files from './components/Files.vue'
import Extras from './components/Extras.vue'

const routes = [
    {path: '/', component: Chat },
    {
        path: '/resource-center', 
        component: ResourceCenter,
        children: [
            {path: 'notes', component: Notes },
            {path: 'videos', component: Videos },
            {path: 'files', component: Files },
            {path: 'extras', component: Extras }
        ] 
    },
]

const router = new VueRouter({
    routes
})

const store = new Vuex.Store({
  state: {
    messages:'',
    activeUsers:[],
    currentUser: '',
    // users:[],
    // channels: [],
    currentGroup: '',
    currentChannel: '',
    channelDescription: '',
    title: '',
    isMessageSending: false,
    isDataStillFetching: true
  },
  // getters: {
  //   channelDescription(state){
  //      return state.currentGroup.channels[state.currentChannel].description
  //   }
  // },
  mutations: {
    assignMessages (state, messages) {
      state.messages = messages
    },
    updateMessages (state, message) {
      state.messages.push(message)
    },
    assignActiveUsers (state, activeUsers) {
      state.activeUsers = activeUsers
    },
    addToActiveUsers(state, user){
        state.activeUsers.push(user)
    },
    removeFromActiveUsers(state, user){
        state.activeUsers.filter(u => u != user)
    },
    updateCurrentUser (state, currentUser) {
      state.currentUser = currentUser
    },
    // updateUsers (state, users) {
    //   state.users = users
    // },
    // updateChannels (state, channels) {
    //   state.channels = channels
    // },
    updateCurrentGroup (state, currentGroup) {
      state.currentGroup = currentGroup
    },
    updateCurrentChannel (state, currentChannel) {
      state.currentChannel = currentChannel
    },
    updateChannelDescription(state, description){
        state.channelDescription = description
    },
    updateTitle (state, title) {
      state.title = title
    },
    toggleIsMessageSending (state) {
      state.isMessageSending = !state.isMessageSending
    },
    toggleIsDataStillFetching(state){
        state.isDataStillFetching = ! state.isDataStillFetching
    }
  }
})



const app = new Vue({
    el: '#app',
    store,
    router,
    data:{
    },
    created: function(){
        Echo.join('chatroom')
            .here((users) => {
                store.commit('assignActiveUsers', users)
            }).
            joining((user) => {
                store.commit('addToActiveUsers', user)
                console.log(user.name + " join the chat.")
            }).
            leaving((user) => {
                store.commit('removeFromActiveUsers', user)
            })
            .listen('MessagePosted', (e) => {
                store.commit('updateMessages', e.message)
            })
    },
    mounted(){
        axios.get('/init/' + groupId).then(response => {
            store.commit('assignMessages', response.data.messages)
            store.commit('updateCurrentUser', response.data.user[0])
            store.commit('updateCurrentGroup', response.data.group)
            if(response.data.group.channels.length){
                store.commit('updateCurrentChannel', response.data.group.channels[0].id)
                store.commit('updateChannelDescription', response.data.group.channels[0].description)
                store.commit('updateTitle', response.data.group.channels[0].name)
            }
            store.commit('toggleIsDataStillFetching')
        })
    }
})

