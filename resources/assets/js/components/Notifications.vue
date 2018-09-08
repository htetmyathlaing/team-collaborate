<template>
    <li class="nav-item dropdown  mr-3">
        <a class="nav-link" role="button" data-toggle="dropdown">
            <span class="far fa-lg fa-bell" @click="isShowed = false"></span>
            <span v-show="isShowed" class="badge badge-danger">9</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
    	   <h6 class="dropdown-header">Notifications</h6>
    	   <div v-for="(notification,index) in notifications">
    	        <div class="dropdown-item border-top">
    	        	<p>Mg Mg posted new vide file in Resource Center</p>
    	        </div>
    	   </div>
        </div>
    </li>
</template>

<script>
    export default {
    	data(){
    		return {
    			isShowed: true
    		}
    	},
        computed:{
        	notifications(){
        		return [1,2,3,4,5,6,7,8,9,10,]
        	}
        }
    }
</script>
<style scoped>
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
