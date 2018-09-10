 <template>
    <div class="container">
    	<div class="row">
    		<div class="m-2">
    			<img src="../../../../public/img/img_avatar1.png" alt="Avartar">
    		</div>
    		<div class="col-10">
    			<span class="text-primary">{{ message.user.name }}</span>
    			<span class="text-muted">{{ message.created_at }}</span>
    			<br/>
    			<p>{{ message.message }}</p>
    		</div>
    	</div>
	</div>
</template>

<script>
    export default {
        props: ['message'],
    }
</script>
<style scoped>
	img{
		height: 3em;
		width: 3em;
	}
	.text-muted{
		font-family: sans-serif !important;
	}
</style>
