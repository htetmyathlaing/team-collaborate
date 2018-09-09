<template>
    <div class="modal fade mt-5" id="addMemberModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title mx-auto">အဖွဲ့ဝင်အသစ် ပေါင်းထည့်ရန်</h5>
	      		</div>
	      		<div class="modal-body">
	        		<input type="text" class="form-control" id="inputEmail" placeholder="Email ရိုက်ထည့်ပါ" v-model="email" @keydown.enter="add" required autofocus>
	        		<span class="invalid-feedback" role="alert">
                		<strong>{{ feedback }}</strong>
            		</span>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancel">မလုပ်တော့ပါ</button>
	        		<button type="button" class="btn btn-primary" @click="add">ပေါင်းထည့်မည်</button>
	      		</div>
	    	</div>
	  	</div>
	</div>
</template>

<script>
    export default {
        data(){
        	return {
        		email: '',
        		isMemberAdding: false,
        		feedback: 'Email လိပ်စာကို ရိုက်ထည့်ပေးရမည်။'
        	}
        },
        methods:{
        	add(){
        		if(this.email == '')
        			$('#inputEmail').toggleClass('is-invalid')
        		if(this.email){
        			$('#inputEmail').removeClass('is-invalid')
        			$('#inputEmail').addClass('is-valid')
        			this.isMemberAdding = true

        		axios.post('/users', {
                        email: this.email,
                        group_id: this.$store.state.currentGroup.id
                    }).then(response => {
                       	if(response.data == 'not found'){
                       		$('#inputEmail').toggleClass('is-invalid')
                       		this.feedback = 'သင်ထည့်သွင်းသော Email ြဖင့် အသုံးပြုသူကို ရှာမတွေ့ပါ။'
                       	}
                        else if(response.data == 'exit'){
                            $('#inputEmail').toggleClass('is-invalid')
                            this.feedback = 'သင်ထည့်သွင်းသော Email ြဖင့် အသုံးပြုသူသည် အဖွဲ့တွင် ပါဝင်ပြီးဖြစ်သည်။'
                        }
                       	else{
	                  		$('#inputEmail').removeClass('is-valid')
	                  		this.$store.commit('addUser', response.data)
	                  		this.$store.commit('updateTitle', response.data.name)
		                    this.$store.commit('updateCurrentChannel', 'user'+response.data.id)

		                    this.$store.commit('updateChannelDescription', 'This is private chat.')

		                    axios.get('/getmessages/'+this.$store.state.currentChannel).then(response => {
		                            this.$store.commit('assignMessages', response.data.messages)
		                            this.isMemberAdding = false
		                        }) 
	                  		$('#addMemberModal').modal("hide")
                            this.email = ''
		                	$('.list-item').attr("class","list-item")
                       	}
                    }) 
        		}
        	},
            cancel(){
                this.email = ''
                $('#inputEmail').removeClass('is-invalid')
            }
        }
    }
</script>
<style scoped>
	
</style>
