import Vue from 'vue';

/**
 * Creat the EventBus
 * Everything about data will be controlled via this EventBus
 */
export const EventBus = new Vue({
        data:{
                messages:[],
                activeUsers:[],
                currentUser: '',
                users:[],
                channels: [],
                currentGroup: '',
                currentChannel: '',
                title: '#general',
                isMessageSending: false
        }
});