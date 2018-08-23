<template>
    <div class="modal fade mt-5" id="createGroupModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title mx-auto">Create a new Group</h5>
	        	<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button> -->
	      		</div>
	      		<div class="modal-body">
        			<div class="form-group row">
						<label for="inputName" class="col-sm-2 col-form-label">Name</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control" id="inputName" placeholder="Name" v-model="name" required autofocus>
					      	<span v-show="isNameValid" class="invalid-feedback" role="alert">
                                <strong>Name must be enter.</strong>
                            </span>
					    </div>
					</div>
					<div class="form-group row">
					    <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control" id="inputDescription" placeholder="Description in short"v-model="description" >
					      	<span v-show="isDescriptionValid" class="invalid-feedback" role="alert">
                                <strong>Description must be subscribe.</strong>
                            </span>
					    </div>
					</div>
					<div v-show="isChannelCreating" class='container'>
			            <div class='loader'>
			                <div class='loader-text'></div>
			            </div>
			        </div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancel" :disabled="isDisable">Cancel</button>
	        		<button type="button" class="btn btn-primary" @click="create">Create</button>
	      		</div>
	    	</div>
	  	</div>
	</div>
</template>

<script>
    export default {
        data(){
        	return {
        		name: '',
        		description: '',
        		isChannelCreating: false,
        		isNameValid: true,
        		isDescriptionValid: true,
        		isDisable: false
        	}
        },
        methods:{
        	create(){
        		if(this.name == '')
        			$('#inputName').toggleClass('is-invalid');
        		if(this.description == '')
        			$('#inputDescription').toggleClass('is-invalid');
        		if(this.name  && this.description){
        			$('input').removeClass('is-invalid')
        			$('input').addClass('is-valid')
        			this.isDisable = true
        			this.isChannelCreating = true
        		}
        	},
        	cancel(){
        		this.name = ''
        		this.description = ''
        	}
        }
    }
</script>
<style scoped>
	.container {
        font-family: Helvetica;
        padding: 1px;
        margin-bottom: 5px;
    }

  	.loader-text:after {
	    content: "Creating Channel";
	    font-weight: bold;
	    font-style: italic;
	    animation-name: loading-text;
	    animation-duration: 1s;
	    animation-iteration-count: infinite;
	}

	 @keyframes loading-text {
	    0% {
	      content: "Creating Channel";
	    }
	    10% {
	      content: "Creating Channel .";
	    }
	    20% {
	      content: "Creating Channel . .";
	    }
	    30% {
	      content: "Creating Channel . . . ";
	    }
	    40% {
	      content: "Creating Channel . . . .";
	    }
	    50% {
	      content: "Creating Channel . . . . .";
	    }
	    60% {
	      content: "Creating Channel . . . . . .";
	    }
	    70% {
	      content: "Creating Channel . . . . . . .";
	    }
	    80% {
	      content: "Creating Channel . . . . . . . .";
	    }
	    90% {
	      content: "Creating Channel . . . . . . . . .";
	    }
	    100% {
	      content: "Creating Channel . . . . . . . . . .";
	    }
	}
</style>
