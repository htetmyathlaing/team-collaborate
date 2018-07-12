<template>
    <div class="dropdown">
    	<a class="text-info" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @click="test">
            <span class="far fa-lg fa-bell"></span><span v-show="!isLooked" class="badge badge-light">4</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right mt-3">
            <span class="dropdown-item" href="#">{{ notification }}</span>
            <span class="dropdown-item" href="#">Another action</span>
            <span class="dropdown-item" href="#">Something else here</span>
        </div>
    </div>
</template>

<script>
	import { EventBus } from './../event-bus.js'
    export default {
        data(){
        	return {
                isLooked: false
        	}
        },
        methods:{
        	test(){
        		EventBus.$emit('test')
                this.isLooked = true
        	}
        },
        computed:{
        	notification(){
        		return EventBus.notification
        	}
        }
    }
</script>
<style scoped>
	
</style>
