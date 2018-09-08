<template>
    <div class="col-4 border-left">
        <div class="container">
        	<div class="row">
                <h3 class="mx-auto m-3">Details</h3>
                <div class="col-12">
                    <hr>
                </div>

                <content-placeholders :rounded="true" v-show="isDataStillFetching">
                    <content-placeholders-text :lines="2" class="mt-3" />
                    <content-placeholders-text :lines="2" class="mt-4" />
                    <content-placeholders-text :lines="2" class="mt-4" />
                </content-placeholders>   
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
        	isDataStillFetching(){
        		return this.$store.state.isDataStillFetching
        	}
        }
    }
</script>
<style scoped>
	
</style>
