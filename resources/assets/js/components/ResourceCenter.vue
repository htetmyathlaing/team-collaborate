<template>
    <div class="col">
    	<div class="m-3">
    		<h4>Resource Center</h4>
    	</div>
        <div class="container">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item" @click="toggleActive">
                    <router-link to="/resource-center/notes" class="nav-link active">Notes</router-link>
                </li>
                <li class="nav-item"  @click="toggleActive">
                    <router-link to="/resource-center/files" class="nav-link">Files</router-link>
                </li>
                <li class="nav-item"  @click="toggleActive">
                    <router-link to="/resource-center/videos" class="nav-link">Videos</router-link>
                </li>
                <li class="nav-item"  @click="toggleActive">
                    <router-link to="/resource-center/extras" class="nav-link">Extras</router-link>
                </li>
            </ul>
            <!-- <keep-alive>
                <component v-bind:is="currentTabComponent"  class="mt-3"></component>
            </keep-alive> -->
            <keep-alive>
                <router-view></router-view>
            </keep-alive>
        </div>      
    </div>
</template>

<script>
    export default {
        data(){
            return {

            }
        },
        methods:{
            toggleActive(event){
                $('.nav-link').removeClass('active');
                $(event.target).addClass('active');
            }
        },
        created(){
        	
        }
    }
</script>
<style scoped>
	
</style>
