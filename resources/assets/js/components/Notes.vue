<template>
    <div class="container mm-text">
    	<!-- <a v-show="!viewing"
    		class="btn btn-success m-3"
    		data-toggle="modal"
    		data-placement="top" 
            title="မှတ်စုအသစ်ရေးရန်"
            @click="titling=true">
    		<span class="fas fa-plus text-white"></span>
        </a> -->
        <button v-show="!viewing"
        	type="button"
            class="btn btn-success btn-circle m-3"
            data-toggle="modal"
            data-placement="right" 
            title="မှတ်စုအသစ်ရေးရန်"
            @click="titling=true">
            <span class="fas fa-plus"></span>
        </button>

		<!-- Editor -->
    	<div v-show="writing" class="mt-3">
	    	<editor id="editor"  :init="{
		    	plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
		  		toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
		  		height: 400,}" v-model="content">
		  	</editor>
	    	<button class="btn btn-secondary ml-auto" :disabled="saving" @click="cancel">မလုပ်တော့ပါ</button>
		  	<button class="btn btn-success m-2" :disabled="saving" @click="save">သိမ်းမည်</button>
		  	
			<span v-show="saving" class='saving-text ml-3'></span>
    	</div>

    	 <!-- Create Title -->
        <div v-show="titling && !viewing && !editing &&!writing" class="form-group row">
			<label for="inputTitle" class="col-sm-2 col-form-label text-right">ခေါင်းစဉ်</label>
			<div class="col-sm-5">
				<input type="text" 
					class="form-control" 
					id="inputTitle" 
					placeholder="ခေါင်းစဉ်ရေးပါ" 
					v-model="title" 
					required autofocus
					@keydown.enter="startEdit" >
				<span class="invalid-feedback" role="alert">
                    <strong>ခေါင်းစဉ်ရေးရပါမည်။</strong>
                </span>
			</div>
			<a class="btn btn-success text-white col-sm-2"
            	@click="startEdit">
            	ရှေ့ဆက်ရန်
        	</a>
        	<a class="btn btn-secondary text-white col-sm-2 ml-3"
            	@click="titling=false">
            	မလုပ်တော့ပါ
        	</a>
		</div>

    	<!-- List Notes -->
	    <ul v-show="!titling && !writing && !viewing && !editing" 
	    	class="list-group scroll-view" 
	    	@mouseleave="mouseOutOfLists">
	    	<p v-if="!notes.length">မှတ်စုများ မရှိသေးပါ။ မှတ်စုများ စတင်ရေးသားနိုင်ပါသည်။</p>
	    	<transition-group name="list">
				<li v-for="(item,index) in notes" 
					:key="index"
					:data-id="item.id"
					class="list-group-item list-group-item-action list-group-item-info" 
					@mouseenter="mouseOverList"
					@click="view">
					<div class="row" :data-id="item.id">
						<span class="ml-3" :data-id="item.id">{{ item.title }}</span>
						<div class="ml-auto edit-buttons mr-3" :data-id="item.id">
							<span class="fas fa-lg fa-edit text-success ml-auto mt-2"
								:data-id="item.id"
								data-toggle="modal"
	    						data-placement="top" 
	            				title="ပြင်ဆင်ရန်"
	            				@click="edit"></span>
	            			<span class="fas fa-lg fa-trash-alt text-danger ml-3"
	            				:data-id="item.id"
								data-toggle="modal" 
                            	data-target="#deleteNoteModal"
	    						data-placement="top" 
	            				title="ဖျက်ရန်"
	            				@click="select"></span>
						</div>
					</div>
				</li>
			</transition-group>
		</ul>

		<!-- View Notes -->
		<div v-show="viewing & !editing" class="card mt-3">
			<div class="card-header">
				<div class="row">
					<span class="far fa-2x fa-arrow-alt-circle-left ml-3 mt-2 back-arrow" 
					@click="viewing=false; content=''; title=''"></span>
    				<span class="card-title mx-auto">{{ title }}</span>
    				<span class="fas fa-lg fa-edit ml-auto mr-3 mt-2 view-edit"
						data-toggle="modal"
	    				data-placement="top" 
	            		title="ပြင်ဆင်ရန်"
	            		@click="edit"></span>	
				</div>
			</div>
  			<div class="card-body scroll-view" v-html="content"></div>
		</div>

		<!-- Delete Notes -->
		<div class="modal fade mt-5" id="deleteNoteModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
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
		        		<button type="button" class="btn btn-danger" @click="deleteNote" :disabled="deleting">ဖျက်မည်</button>
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
        		titling: false,
        		writing: false,
        		editing: false,
        		viewing: false,
        		saving: false,
        		deleting: false,
        		title: '',
        		content: '',
        		notes: [],
        		selectedId: ''
        	}
        },
        mounted(){
        	axios.get('/getnotes/'+this.$store.state.currentGroup.id).then(response => {
        		this.notes = Object.keys(response.data).map(function(key) {
  					return {id: Number(key), title: response.data[key]};
				})
        	})
        },
        methods:{
        	save(){
        		// remove unnecessary html tags
        		// this.content.slice(44, this.content.length-16)
        		
        		if(this.editing){
        			this.saving = true
        			axios.put('/notes/' + this.selectedId, {
	                   content: this.content,
	               	}).then(response => {
	                	this.content = ''
	                	this.viewing = false
        				this.writing = false
        				this.titling = false
        				this.editing = false
	                	this.saving = false
	            	}) 
        			return
        		}
        		this.saving = true
        		axios.post('/notes', {
	                   title: this.title,
	                   content: this.content,
	                   group_id: this.$store.state.currentGroup.id
	               	}).then(response => {
	                	this.notes.unshift(response.data)
	                	this.saving = false
	                	this.writing = false
	                	this.titling = false
	                	this.content = ''
	                	this.title = ''
	            }) 
        	},
        	startEdit(){
        		if(!this.title){
        			$('#inputTitle').toggleClass('is-invalid')
        			return
        		}
        		$('#inputName').removeClass('is-invalid')
        		this.titling = false
        		this.writing = true
        	},
        	cancel(){
	        	this.writing = false
        		this.viewing = false 
        		this.editing = false
	        	this.title=''
	        	this.content = ''
        	},
        	select: function(event){
        		this.selectedId = event.target.dataset['id']
        	},
        	edit: function(event){
        		axios.get('/notes/'+ this.selectedId).then(response => {
	        		this.content = response.data.content
	        		this.editing = true
        			this.writing = true
	        	})
        	},
        	view: function(event){
        		this.viewing = true
        		this.selectedId = event.target.dataset['id']
        		this.title = this.notes.find(n => n.id == this.selectedId).title
        		axios.get('/notes/'+ this.selectedId).then(response => {
	        			this.content = response.data.content
	        			this.selectedId = response.data.id
	        	})
        	},
        	deleteNote: function(event){
        		this.deleting = true
        		axios.delete('/notes/' + this.selectedId).then(response => {
        			this.notes = this.notes.filter(n => n.id != this.selectedId)
        			this.selectedId = ''
        			this.title=''
	        		this.content = ''
	        		this.writing = false
	        		this.viewing = false
	        		this.editing = false
	        		this.titling = false
	        		this.deleting = false
              		$('#deleteNoteModal').modal("hide") 
        		}) 
        	},
        	mouseOverList: function(event){
        		$(".edit-buttons").css('display','none')
        		event.target.firstChild.children[1].style.display="block"
        	},
        	mouseOutOfLists: function(event){
        		$(".edit-buttons").css('display','none')
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
	.view-edit:hover{
		cursor: pointer;
		color: #28a745;
		transform: scale(1.01, 1.01);
        transition: transform .1s;
        transform: translateY(-1px);
	}
	.scroll-view{
        overflow-y: scroll;
        height: 70vh;
        font-family: 'Raleway';
    }
    .edit-buttons{
    	display: none;
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
	.saving-text:after {
	    content: "မှတ်စုကိုသိမ်းနေသည်";
	    font-weight: bold;
	    font-style: italic;
	    color: #28a745;
	    animation-name: saving-text;
	    animation-duration: 1s;
	    animation-iteration-count: infinite;
	}

	 @keyframes saving-text {
	    0% {
	      content: "မှတ်စုကိုသိမ်းနေသည်";
	    }
	    10% {
	      content: "မှတ်စုကိုသိမ်းနေသည် .";
	    }
	    20% {
	      content: "မှတ်စုကိုသိမ်းနေသည် . .";
	    }
	    30% {
	      content: "မှတ်စုကိုသိမ်းနေသည် . . . ";
	    }
	    40% {
	      content: "မှတ်စုကိုသိမ်းနေသည် . . . .";
	    }
	    50% {
	      content: "မှတ်စုကိုသိမ်းနေသည် . . . . .";
	    }
	    60% {
	      content: "မှတ်စုကိုသိမ်းနေသည် . . . . . .";
	    }
	    70% {
	      content: "မှတ်စုကိုသိမ်းနေသည် . . . . . . .";
	    }
	    80% {
	      content: "မှတ်စုကိုသိမ်းနေသည် . . . . . . . .";
	    }
	    90% {
	      content: "မှတ်စုကိုသိမ်းနေသည် . . . . . . . . .";
	    }
	    100% {
	      content: "မှတ်စုကိုသိမ်းနေသည် . . . . . . . . . .";
	    }
	}

	.deleting-text:after {
	    content: "မှတ်စုကို ဖျက်နေသည်";
	    font-weight: bold;
	    font-style: italic;
	    color: red;
	    animation-name: deleting-text;
	    animation-duration: 1s;
	    animation-iteration-count: infinite;
	}

	 @keyframes deleting-text {
	    0% {
	      content: "မှတ်စုကို ဖျက်နေသည်";
	    }
	    10% {
	      content: "မှတ်စုကို ဖျက်နေသည် .";
	    }
	    20% {
	      content: "မှတ်စုကို ဖျက်နေသည် . .";
	    }
	    30% {
	      content: "မှတ်စုကို ဖျက်နေသည် . . . ";
	    }
	    40% {
	      content: "မှတ်စုကို ဖျက်နေသည် . . . .";
	    }
	    50% {
	      content: "မှတ်စုကို ဖျက်နေသည် . . . . .";
	    }
	    60% {
	      content: "မှတ်စုကို ဖျက်နေသည် . . . . . .";
	    }
	    70% {
	      content: "မှတ်စုကို ဖျက်နေသည် . . . . . . .";
	    }
	    80% {
	      content: "မှတ်စုကို ဖျက်နေသည် . . . . . . . .";
	    }
	    90% {
	      content: "မှတ်စုကို ဖျက်နေသည် . . . . . . . . .";
	    }
	    100% {
	      content: "မှတ်စုကို ဖျက်နေသည် . . . . . . . . . .";
	    }
	}
</style>
