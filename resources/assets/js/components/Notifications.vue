<template>
    <li class="nav-item dropdown mr-3">
        <a class="nav-link" 
            role="button" 
            data-toggle="dropdown"
            data-placement="left" 
            title="သတိပေးချက်များ"
            @click="seenNotification">
            <span class="far fa-lg fa-bell"></span>
            <span v-show="isNotified" class="badge badge-danger">{{ unreadNotifications }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
    	   <h6 class="dropdown-header">Notifications</h6>
    	   <div v-for="(notification,index) in notifications">
    	        <div class="dropdown-item border-top">
    	        	<p>{{ notification.data.user }}&nbsp;{{ notification.data.action }}</p>
    	        </div>
    	   </div>
        </div>
    </li>
</template>

<script>

    export default {
    	data(){
    		return {
    			isNotified: true
    		}
    	},
        computed:{
        	notifications(){
        		return this.$store.state.notifications
        	},
            unreadNotifications(){
                this.isNotified = true
                let n = this.$store.state.notifications.filter(n => n.read_at == null).length
                if(!n)
                    this.isNotified = false
                return n
            }
        },
        methods:{
            seenNotification(){
                this.isNotified = false
                axios.put('/notifications', {
                }).then(response => {
                    this.$store.commit('assignNotifications', response.data)
                })
            }
        }
       
    }
</script>
<style scoped>
    .nav-link:hover > span:hover{
        cursor: pointer;
    }
	.dropdown-menu{
		overflow-y: scroll;
		max-height: 50vh;
		width: 20em !important;
	}
	.dropdown-item{
		white-space: normal !important;
	}
	.badge{
		transform: translate(10px, -30px);
        position: absolute;
	}
</style>
