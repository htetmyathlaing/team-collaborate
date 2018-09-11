<template>
    <div class="modal fade mt-5 mm-text" id="createGroupModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title mx-auto">အဖွဲ့အသစ်တစ်ခု ဖန်တီးမည်</h5>
	        	<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button> -->
	      		</div>
	      		<div class="modal-body">
        			<div class="form-group row">
						<label for="inputName" class="col-sm-3 col-form-label">အမည်</label>
					    <div class="col-sm-9">
					      	<input type="text" class="form-control" id="inputName" placeholder="အဖွဲ့အမည် ထည့်သွင်းပါ။" v-model="name"  @keydown.enter="create" required autofocus>
					      	<span class="invalid-feedback" role="alert">
                                <strong>အမည်ကို ရိုက်ထည့်ပေးရမည်။</strong>
                            </span>
					    </div>
					</div>
					<div class="form-group row">
					    <label for="inputDescription" class="col-sm-3 col-form-label">ဖော်ပြချက်</label>
					    <div class="col-sm-9">
					      	<input type="text" class="form-control" id="inputDescription" placeholder="ဤအဖွဲ့နှင့် ပတ်သက်သော အကြောင်းအရာဖော်ပြချက်ထည့်ပါ။"v-model="description"  @keydown.enter="create">
					      	<span class="invalid-feedback" role="alert">
                                <strong>အဖွဲ့နှင့်ပတ်သက်သော​ဖော်ပြချက် ထည့်ပေးရမည်။</strong>
                            </span>
					    </div>
					</div>
					<div v-show="isGroupCreating" class='container  mm-text'>
			            <div class='loader'>
			                <div class='loader-text'></div>
			            </div>
			        </div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancel" :disabled="isGroupCreating">မလုပ်တော့ပါ</button>
	        		<button type="button" class="btn btn-primary" @click="create" :disabled="isGroupCreating">ဖန်တီးမည်</button>
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
        		isGroupCreating: false
        	}
        },
        methods:{
        	create(){
        		if(this.name == '')
        			$('#inputName').toggleClass('is-invalid');
        		if(this.description == '')
        			$('#inputDescription').toggleClass('is-invalid');
        		if(this.name  && this.description){
        			$('#inputName #inputDescription').removeClass('is-invalid')
        			$('#inputName #inputDescription').addClass('is-valid')
        			this.isGroupCreating = true

        			axios.post('/groups', {
                        name: this.name,
                        description: this.description
                    }).then(response => {
                        console.log(response.data)
                        $('#inputName #inputDescription').removeClass('is-valid')
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
	    content: "အဖွဲ့ကို ဖန်တီးနေသည်";
	    font-weight: bold;
	    font-style: italic;
	    color: #28a745;
	    animation-name: loading-text;
	    animation-duration: 1s;
	    animation-iteration-count: infinite;
	}

	 @keyframes loading-text {
	    0% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည်";
	    }
	    10% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည် .";
	    }
	    20% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည် . .";
	    }
	    30% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . ";
	    }
	    40% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . .";
	    }
	    50% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . .";
	    }
	    60% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . . .";
	    }
	    70% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . . . .";
	    }
	    80% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . . . . .";
	    }
	    90% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . . . . . .";
	    }
	    100% {
	      content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . . . . . . .";
	    }
	}
</style>
