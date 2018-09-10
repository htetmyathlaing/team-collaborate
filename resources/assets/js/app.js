
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
import Editor from '@tinymce/tinymce-vue'

Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(VueContentPlaceholders)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('editor', Editor)
Vue.component('chat-message', require('./components/ChatMessage.vue'))
Vue.component('chat-log', require('./components/ChatLog.vue'))
Vue.component('chat-composer', require('./components/ChatComposer.vue'))
Vue.component('left-colum', require('./components/LeftColum.vue'))
// Vue.component('right-colum', require('./components/RightColum.vue'))
Vue.component('chatroom-details', require('./components/ChatRoomDetails.vue'))
// Vue.component('announcement', require('./components/Announcement.vue'))
Vue.component('nav-bar', require('./components/NavBar.vue'))
Vue.component('notifications', require('./components/Notifications.vue'))
Vue.component('create-channel-modal', require('./components/CreateChannelModal.vue'))
Vue.component('create-group-modal', require('./components/CreateGroupModal.vue'))
Vue.component('add-member-modal', require('./components/AddMemberModal.vue'))
Vue.component('delete-channel-modal', require('./components/DeleteChannelModal.vue'))
Vue.component('voice-call-modal', require('./components/VoiceCallModal.vue'))
Vue.component('video-call-modal', require('./components/VideoCallModal.vue'))

import Chat from './components/Chat.vue'
import Announcement from './components/Announcement.vue'
import ResourceCenter from './components/ResourceCenter.vue'
import Notes from './components/Notes.vue'
import Videos from './components/Videos.vue'
import Photos from './components/Photos.vue'
import Extras from './components/Extras.vue'

const routes = [
    {path: '/', component: Chat },
    {path: '/announcement', component: Announcement },
    {
        path: '/resource-center', 
        component: ResourceCenter,
        children: [
            {path: 'notes', component: Notes },
            {path: 'videos', component: Videos },
            {path: 'photos', component: Photos },
            {path: 'extras', component: Extras }
        ] 
    },
]

const router = new VueRouter({
    routes
})

const store = new Vuex.Store({
  state: {
    title: '',
    messages:'',
    activeUsers:[],
    currentUser: '',
    currentGroup: '',
    notifications: [],
    currentChannel: '',
    channelDescription: '',
    isMessageSending: false,
    isDataStillFetching: true
  },
  getters: {
    currentGroup(state){
       return state.currentGroup
    }
  },
  mutations: {
    assignMessages (state, messages) {
      state.messages = messages
    },
    assignNotifications (state, notifications) {
      state.notifications = notifications.filter(n => n.data.group == state.currentGroup.id)
    },
    updateMessages (state, message) {
      state.messages.push(message)
    },
    updateNotifications (state, notification){
        state.notifications.push(notification)
    },
    assignActiveUsers (state, activeUsers) {
      state.activeUsers = activeUsers
    },
    addToActiveUsers(state, user){
        state.activeUsers.push(user)
    },
    removeFromActiveUsers(state, user){
        state.activeUsers = state.activeUsers.filter(u => u != user)
    },
    updateCurrentUser (state, currentUser) {
      state.currentUser = currentUser
      Echo.private('App.User.' + currentUser.id)
            .notification((notification) => {
                if(notification.data.group == state.currentGroup.id){
                    store.commit('updateNotifications', notification)
                    toastr.info(notification.data.user+' '+notification.data.action, '' , 
                    {
                        progressBar: true,
                        showMethod:'slideDown',
                        hideMethod:'slideUp',
                        positionClass: 'toast-bottom-right',
                        timeOut: 5000
                    })
                }
            });
    },
    updateCurrentGroup (state, currentGroup) {
      state.currentGroup = currentGroup
      Echo.join('chatroom.'+store.state.currentGroup.id)
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
                if(store.state.currentUser.id == e.message.user_id || //add the message you type
                    store.state.currentChannel == 'channel'+e.message.channel_id || //add the message in current channel
                    store.state.currentChannel == 'user'+e.message.user_id && // add the message
                    store.state.currentUser.id == e.message.to_user_id){      // to the private channel
                    store.commit('toggleIsMessageSending')
                    store.commit('updateMessages', e.message)
                    store.commit('toggleIsMessageSending')
                }
            })
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
    },
    removeChannel (state, channelId) {
        state.currentGroup.channels = state.currentGroup.channels.filter(c => c.id != channelId)
    },
    addUser(state, user){
        state.currentGroup.users.push(user)
    },
    removeUser(state, userId) {
        state.currentGroup.users = state.currentGroup.users.filter(u => u.id != userId)
    }
  }
})

const app = new Vue({
    el: '#app',
    store,
    router,
    data:{
    },
    computed:{
        currentGroup(){
            return store.state.currentGroup
        }
    },
    created(){
    },
    mounted(){
        axios.get('/init/' + groupId).then(response => {
            store.commit('assignMessages', response.data.messages)
            store.commit('updateCurrentUser', response.data.user)
            store.commit('updateCurrentGroup', response.data.group)
            store.commit('assignNotifications', response.data.notifications)
            if(response.data.group.channels.length){
                store.commit('updateCurrentChannel', 'channel'+response.data.group.channels[0].id)
                store.commit('updateChannelDescription', response.data.group.channels[0].description)
                store.commit('updateTitle', response.data.group.channels[0].name)
            }
            store.commit('toggleIsDataStillFetching')
        })
    },
})

