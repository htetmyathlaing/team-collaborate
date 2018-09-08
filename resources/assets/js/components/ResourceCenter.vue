<template>
    <div class="col">
    	<div class="container">
            <div class="row">
                <h4 class="mx-auto m-3">Resource Center</h4>
                <div class="col-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item" @click="toggleActive">
                            <router-link to="/resource-center/notes" class="nav-link active">Notes</router-link>
                        </li>
                        <li class="nav-item"  @click="toggleActive">
                            <router-link to="/resource-center/photos" class="nav-link">Photos</router-link>
                        </li>
                        <li class="nav-item"  @click="toggleActive">
                            <router-link to="/resource-center/videos" class="nav-link">Videos</router-link>
                        </li>
                    </ul>
                    <keep-alive>
                        <router-view></router-view>
                    </keep-alive>
                </div>      
            </div>
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
