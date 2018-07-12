
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));
Vue.component('left-colum', require('./components/LeftColum.vue'));
Vue.component('right-colum', require('./components/RightColum.vue'));
Vue.component('chatroom-details', require('./components/ChatRoomDetails.vue'));
Vue.component('announcement', require('./components/Announcement.vue'));
Vue.component('notification', require('./components/Notification.vue'));

/**
 * Import the EventBus
 * Everything about data is now controlled via EventBus
 */
import { EventBus } from './event-bus.js';

const app = new Vue({
    el: '#app',
    data:{
    },
    created: function(){
    	axios.get('/init').then(response => {
    		EventBus.messages = response.data.messages
            EventBus.currentUser = response.data.user[0]
            EventBus.users = response.data.group.users
            EventBus.channels = response.data.group.channels
            EventBus.currentChannel = 'channel'+response.data.group.channels[0].id
    	})

        Echo.join('chatroom')
            .here((users) => {
                EventBus.activeUsers = users
                console.log(users)
            }).
            joining((user) => {
                EventBus.activeUsers.push(user)
                console.log(user.name + " join the chat.")
            }).
            leaving((user) => {
                EventBus.activeUsers.filter(u => u != user)
            })
            .listen('MessagePosted', (e) => {
                EventBus.messages.push(e.message)
        })
    },
    mounted(){
        console.log(EventBus)
    }
});

EventBus.$on('channel-change', function(data){
    /**
    * IF currentChannel and new requested channel are the same,
    * do nothing.
    */
    if(EventBus.currentChannel != data.id){
        EventBus.title = data.title
        EventBus.currentChannel = data.data_id
        axios.get('/getmessages/'+data.data_id).then(response => {
            EventBus.messages =response.data.messages
        })
    }
});
EventBus.$on('messagesent', function(message){
    EventBus.is_message_sending = true
    axios.post('/messages', message).then(response => {
        EventBus.messages.push(response.data)
        EventBus.is_message_sending = false
    })
});

