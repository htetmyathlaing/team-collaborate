<template>
    <div class="modal fade mt-5 mm-text" id="createChannelModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title mx-auto">ခေါင်းစဉ်ခွဲအသစ်တစ်ခု ဖန်တီးမည်</h5>
	        	<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button> -->
	      		</div>
	      		<div class="modal-body">
        			<div class="form-group row">
						<label for="inputName" class="col-sm-3 col-form-label">အမည်</label>
					    <div class="col-sm-9">
					      	<input type="text" class="form-control" id="inputName" placeholder="ခေါင်းစဉ်ခွဲအမည် ထည့်သွင်းပါ။" v-model="name" @keydown.enter="create" required autofocus>
					      	<span class="invalid-feedback mm-text" role="alert">
                                <strong>အမည်ကို ရိုက်ထည့်ပေးရမည်။</strong>
                            </span>
					    </div>
					</div>
					<div class="form-group row">
					    <label for="inputDescription" class="col-sm-3 col-form-label">အချက်အလက်</label>
					    <div class="col-sm-9">
					      	<input type="text" class="form-control" id="inputDescription" placeholder="ဤခေါင်းစဉ်ခွဲနှင့် ပတ်သက်သော အကြောင်းအရာဖော်ပြချက်ထည့်ပါ။"v-model="description" @keydown.enter="create" >
					      	<span class="invalid-feedback mm-text" role="alert">
                                <strong>ခေါင်းစဉ်ခွဲနှင့်ပတ်သက်သော​ဖော်ပြချက် ထည့်ပေးရမည်။</strong>
                            </span>
					    </div>
					</div>
					<div v-show="isChannelCreating" class='container'>
			            <div class='loader'>
			                <div class='loader-text mm-text'></div>
			            </div>
			        </div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancel" :disabled="isChannelCreating">မလုပ်တော့ပါ</button>
	        		<button type="button" class="btn btn-primary" @click="create" :disabled="isChannelCreating">ဖန်တီးမည်</button>
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
        		isChannelCreating: false
        	}
        },
        methods:{
        	create(){
        		if(this.name == ''){
        			$('#inputName').removeClass('is-valid')
        			$('#inputName').addClass('is-invalid');
        		}
        		else{
        			$('#inputName').removeClass('is-invalid')
        			$('#inputName').addClass('is-valid');
        		}

        		if(this.description == ''){
        			$('#inputDescription').removeClass('is-valid')
        			$('#inputDescription').addClass('is-invalid');
        		}
        		else{
        			$('#inputDescription').removeClass('is-invalid')
        			$('#inputDescription').addClass('is-valid');
        		}

        		if(this.name  && this.description){
        			$('#inputName,#inputDescription').removeClass('is-invalid')
        			$('#inputName,#inputDescription').addClass('is-valid')
        			this.isChannelCreating = true

        			axios.post('/channels', {
                        name: this.name,
                        description: this.description,
                        group_id: this.$store.state.currentGroup.id
                    }).then(response => {
                        this.$store.commit('updateCurrentGroup', response.data)
                  		this.isChannelCreating = false
                  		this.name = ''
        				this.description = ''
        				$('#inputName,#inputDescription').removeClass('is-valid')
                  		$('#createChannelModal').modal("hide")

                    	this.$store.commit('updateCurrentChannel', 'channel'+this.$store.state.currentGroup.channels[(this.$store.state.currentGroup.channels).length-1].id)

                    	this.$store.commit('updateTitle', this.$store.state.currentGroup.channels[(this.$store.state.currentGroup.channels).length-1].name)

                    	this.$store.commit('updateChannelDescription', 
                                this.$store.state.currentGroup.channels[(this.$store.state.currentGroup.channels).length-1].description)
                    	
                    	this.$store.commit('assignMessages', [])

		                $('.list-item').attr("class","list-item")
		     
                    }) 
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
	    content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည်";
	    font-weight: bold;
	    font-style: italic;
	    color: #28a745;
	    animation-name: loading-text;
	    animation-duration: 1s;
	    animation-iteration-count: infinite;
	}

	 @keyframes loading-text {
	    0% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည်";
	    }
	    10% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည် .";
	    }
	    20% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည် . .";
	    }
	    30% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည် . . . ";
	    }
	    40% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည် . . . .";
	    }
	    50% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည် . . . . .";
	    }
	    60% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည် . . . . . .";
	    }
	    70% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည် . . . . . . .";
	    }
	    80% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည် . . . . . . . .";
	    }
	    90% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည် . . . . . . . . .";
	    }
	    100% {
	      content: "ခေါင်းစဉ်ခွဲကို ဖန်တီးနေသည် . . . . . . . . . .";
	    }
	}
</style>
