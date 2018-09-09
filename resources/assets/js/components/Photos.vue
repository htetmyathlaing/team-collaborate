<template>
    <div class="container">
        <button v-show="!viewing"
        	type="button"
            class="btn btn-success btn-circle m-3"
            data-toggle="modal"
            data-placement="right" 
            title="ဓာတ်ပုံအသစ်တင်ရန်"
            @click="choosing=true">
            <span class="fas fa-plus"></span>
        </button>

    	 <!-- Upload File -->
        <div v-show="choosing" class="form-group row mm-text">
			<label for="inputFile" class="col-sm-2 col-form-label text-right">ဖိုင်ရွေးရန်</label>
			<div class="col-sm-3">
				<input type="file" 
					class="form-control-file" 
					id="inputFile"
					accept="image/*"
					ref="file"
					@change="processFile">
				<span class="invalid-feedback" role="alert">
                    <strong>ဖိုင်ဆိုဒ် 100MB ထက်ကျော်လွန်၍ မရပါ။ </strong>
                </span> 
        		<span v-show="uploading" class='uploading-text'></span>
			</div>
			<a class="btn btn-success text-white col-sm-2 align-middle"
            	@click="upload">
            	ရှေ့ဆက်ရန်
        	</a>
        	<a class="btn btn-secondary text-white col-sm-2 ml-3"
            	@click="cancle">
            	မလုပ်တော့ပါ
        	</a>
		</div>

		<!-- List Files -->
	    <ul v-show="!viewing" 
	    	class="list-group scroll-view" 
	    	@mouseleave="mouseOutOfLists">
	    	<p v-if="!files.length">မည်သည့်ဖိုင်မျှတင်ထားခြင်းမရှိသေးပါ။ ဖိုင်အသစ်များ တင်နိုင်ပါသည်။</p>
	    	<transition-group name="list">
				<li v-for="(item,index) in files" 
					:key="index"
					:data-id="item.id"
					class="list-group-item list-group-item-action list-group-item-info" 
					@mouseenter="mouseOverList"
					@click="view">
					<div class="row" :data-id="item.id">
						<span class="ml-3 col-8" :data-id="item.id">{{ item.file_title }}</span>
						<span class="col-2 text-muted">Uploaded by - {{ item.user.name }}</span>
						<div class="ml-auto delete-button mr-3" :data-id="item.id">
	            			<span class="fas fa-lg fa-trash-alt text-danger ml-3"
	            				:data-id="item.id"
								data-toggle="modal" 
                            	data-target="#deleteFileModal"
	    						data-placement="top" 
	            				title="ဖျက်ရန်"
	            				@click="select"></span>
						</div>
					</div>
				</li>
			</transition-group>
		</ul>

		<!-- View Files -->
		<div v-show="viewing" class="card mt-3">
			<span class="far fa-2x fa-arrow-alt-circle-left m-3 back-arrow" 
				@click="viewing=false">
			</span>
  			<div class="card-body scroll-view">
  				<img ref="img" src="" width="100%" />
  			</div>
		</div>

		<!-- Delete Files -->
		<div class="modal fade mt-5" id="deleteFileModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title mx-auto">ဖျက်မှာသေချာပြီလား?</h5>
		      		</div>
		      		<div class="modal-body">
						ဤမှတ်စုကို ဖျက်ပါလိမ့်မည်။
						
				        <div v-show="deleting" class='deleting-text'></div>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="deleting">မလုပ်တောပါ</button>
		        		<button type="button" class="btn btn-danger" @click="deleteFile" :disabled="deleting">ဖျက်မည်</button>
		      		</div>
		    	</div>
		  	</div>
		</div>
    </div>
</template>

<script>
    export default {
        data(){
        	return{
        		choosing: false,
        		viewing: false,
        		uploading: false,
        		deleting: false,
        		file: '',
        		files: [],
        		selectedId: ''
        	}
        },
        mounted(){
    		axios.get('/getfiles/'+ this.$store.state.currentGroup.id+'/image').then(response => {
        		this.files = response.data
        	})
        },
        methods:{
        	processFile(){
        		if(this.$refs.file.files[0].size > 104857600){
        			$('#inputFile').addClass('is-invalid')
        			return
        		}
	 	 		this.file = this.$refs.file.files[0]
        	},
        	upload(){
        		if(!this.file){
        			$('#inputFile').addClass('is-invalid')
        			return
        		}
        		if(this.file.size > 104857600){
        			$('#inputFile').addClass('is-invalid')
        			return
        		}
        		this.uploading = true
        		let formData = new FormData();
        		formData.append('file', this.file);
        		formData.append('group_id', this.$store.state.currentGroup.id);
        		axios.post('/files', 
        			formData,
        			{
    					headers: {
        					'Content-Type': 'multipart/form-data'
        				}
    				}).then(response => { 
    					if(response.data == 'false'){
    						$('#inputFile').addClass('is-invalid')
    						return
    					}
    					this.files.unshift(response.data)
        				this.uploading = false
        				this.choosing = false
        				this.file = ''
	            }) 
        	},
        	cancle(){
        		this.choosing = false
        		$('#inputFile').removeClass('is-invalid')
        	},	
        	select(event){
        		this.selectedId = event.target.dataset['id']
        	},
        	view(){
        		this.viewing = true
        		this.selectedId = event.target.dataset['id']
        		axios.get('/files/'+ this.selectedId).then(response => {
        			//  this.$refs.title.innerHTML = this.selectedId
	        		this.$refs.img.src = response.data
	        	})
        	},
        	deleteFile(){
        		this.deleting = true
        		axios.delete('/files/' + this.selectedId).then(response => {
        			this.files = this.files.filter(n => n.id != this.selectedId)
        			this.selectedId = ''
	        		this.deleting = false
	        		this.viewing=false
              		$('#deleteFileModal').modal("hide") 
        		}) 
        	},
        	mouseOverList: function(event){
        		$(".delete-button").css('display','none')
        		event.target.firstChild.children[2].style.display="block"
        	},
        	mouseOutOfLists: function(event){
        		$(".delete-button").css('display','none')
        	}
        }
    }
</script>
<style scoped>
	.back-arrow:hover{
		cursor: pointer;
		color: #007bff;
		transform: scale(1.01, 1.01);
        transition: transform .1s;
        transform: translateX(-1px);
	}
	.scroll-view{
        overflow-y: scroll;
        height: 70vh;
        font-family: 'Raleway';
    }
    .delete-button{
    	display: block;
    }
    .list-group-item{
    	margin-top: 3px;
    }
    .list-group-item:hover{
    	cursor: pointer;
    }
    .list-complete-item {
	    transition: all 0.5s;
	}
	.list-enter-active, .list-leave-active {
	   transition: all 0.5s;
	}
	.list-enter, .list-leave-to{
	   opacity: 0;
	   transform: translateX(5px);
	}
	.uploading-text:after {
	    content: "ဖိုင်ကို တင်နေသည်";
	    font-weight: bold;
	    font-style: italic;
	    color: #28a745;
	    animation-name: saving-text;
	    animation-duration: 1s;
	    animation-iteration-count: infinite;
	}

	 @keyframes saving-text {
	    0% {
	      content: "ဖိုင်ကို တင်နေသည်";
	    }
	    10% {
	      content: "ဖိုင်ကို တင်နေသည် .";
	    }
	    20% {
	      content: "ဖိုင်ကို တင်နေသည် . .";
	    }
	    30% {
	      content: "ဖိုင်ကို တင်နေသည် . . . ";
	    }
	    40% {
	      content: "ဖိုင်ကို တင်နေသည် . . . .";
	    }
	    50% {
	      content: "ဖိုင်ကို တင်နေသည် . . . . .";
	    }
	    60% {
	      content: "ဖိုင်ကို တင်နေသည် . . . . . .";
	    }
	    70% {
	      content: "ဖိုင်ကို တင်နေသည် . . . . . . .";
	    }
	    80% {
	      content: "ဖိုင်ကို တင်နေသည် . . . . . . . .";
	    }
	    90% {
	      content: "ဖိုင်ကို တင်နေသည် . . . . . . . . .";
	    }
	    100% {
	      content: "ဖိုင်ကို တင်နေသည် . . . . . . . . . .";
	    }
	}

	.deleting-text:after {
	    content: "ဖိုင်ကို ဖျက်နေသည်";
	    font-weight: bold;
	    font-style: italic;
	    color: red;
	    animation-name: deleting-text;
	    animation-duration: 1s;
	    animation-iteration-count: infinite;
	}

	 @keyframes deleting-text {
	    0% {
	      content: "ဖိုင်ကို ဖျက်နေသည်";
	    }
	    10% {
	      content: "ဖိုင်ကို ဖျက်နေသည် .";
	    }
	    20% {
	      content: "ဖိုင်ကို ဖျက်နေသည် . .";
	    }
	    30% {
	      content: "ဖိုင်ကို ဖျက်နေသည် . . . ";
	    }
	    40% {
	      content: "ဖိုင်ကို ဖျက်နေသည် . . . .";
	    }
	    50% {
	      content: "ဖိုင်ကို ဖျက်နေသည် . . . . .";
	    }
	    60% {
	      content: "ဖိုင်ကို ဖျက်နေသည် . . . . . .";
	    }
	    70% {
	      content: "ဖိုင်ကို ဖျက်နေသည် . . . . . . .";
	    }
	    80% {
	      content: "ဖိုင်ကို ဖျက်နေသည် . . . . . . . .";
	    }
	    90% {
	      content: "ဖိုင်ကို ဖျက်နေသည် . . . . . . . . .";
	    }
	    100% {
	      content: "ဖိုင်ကို ဖျက်နေသည် . . . . . . . . . .";
	    }
	}
</style>
